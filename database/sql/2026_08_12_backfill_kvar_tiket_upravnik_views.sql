-- ============================================================================
--  Backfill: sve postojece prijave kvarova (tikete) oznaci kao vec pregledane
--            od strane upravnika koji su zaduzeni za tu zgradu.
--
--  Razlog: praćenje pregleda tiketa je uvedeno naknadno, pa bi bez ovoga svi
--          stari tiketi bili prikazani kao NOVO / Nepregledano.
--
--  PREDUSLOV: prvo pokrenuti `php artisan migrate` (kreira tabelu
--             kvar_tiket_upravnik_views), pa tek onda ovu skriptu.
--
--  Skripta je bezbedna za ponovno pokretanje (NOT EXISTS + unique indeks),
--  i ne dira tikete koje je upravnik u medjuvremenu stvarno otvorio.
-- ============================================================================

SET @backfill_ts = NOW();

INSERT INTO kvar_tiket_upravnik_views
    (kvar_tiketId, userId, prvi_pregled, poslednji_pregled, broj_pregleda, created_at, updated_at)
SELECT DISTINCT
    kt.id,
    uzi.userId,
    @backfill_ts,
    @backfill_ts,
    1,
    @backfill_ts,
    @backfill_ts
FROM kvar_tikets kt
JOIN upravnik_zgrada_indices uzi ON uzi.zgradaId = kt.zgradaId
WHERE NOT EXISTS (
    SELECT 1
    FROM kvar_tiket_upravnik_views v
    WHERE v.kvar_tiketId = kt.id
      AND v.userId = uzi.userId
);


-- ---------------------------------------------------------------------------
--  PROVERA (posle izvrsavanja gore navedenog INSERT-a)
-- ---------------------------------------------------------------------------

-- 1) Koliko je redova upisano ukupno:
-- SELECT COUNT(*) AS ukupno_pregleda FROM kvar_tiket_upravnik_views;

-- 2) Mora da vrati 0 redova - nema vise otvorenog tiketa koji je
--    nepregledan za upravnika zaduzenog za tu zgradu:
-- SELECT uzi.userId, kt.zgradaId, COUNT(*) AS nepregledani
-- FROM kvar_tikets kt
-- JOIN upravnik_zgrada_indices uzi ON uzi.zgradaId = kt.zgradaId
-- LEFT JOIN kvar_tiket_upravnik_views v
--        ON v.kvar_tiketId = kt.id AND v.userId = uzi.userId
-- WHERE kt.tiket_statusId < 3
--   AND v.prvi_pregled IS NULL
-- GROUP BY uzi.userId, kt.zgradaId;


-- ---------------------------------------------------------------------------
--  POVRATAK UNAZAD (samo ako je potrebno ponistiti backfill)
--  Brise iskljucivo redove nastale backfill-om - stvarni pregledi upravnika
--  imaju poslednji_pregled razlicit od prvi_pregled ili broj_pregleda <> 1,
--  zato se dodatno oslanjamo na tacan trenutak upisa (zameniti datumom ispod).
-- ---------------------------------------------------------------------------

-- DELETE FROM kvar_tiket_upravnik_views
-- WHERE prvi_pregled = poslednji_pregled
--   AND broj_pregleda = 1
--   AND created_at = 'YYYY-MM-DD HH:MM:SS';  -- vrednost @backfill_ts iz ovog pokretanja
