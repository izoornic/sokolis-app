-- ============================================================================
--  Prevođenje postojećeg korisnika u ulogu "servis održavanja" (user_tipId = 4)
--  i dodela zgrada koje održava.
--
--  PREDUSLOV: pokrenuta migracija 2026_08_13_070000_create_servis_odrzavanja_uloga
--             (kreira tabelu servis_zgrada_indices, ulogu i email tipove).
--
--  Korisnik se prvo napravi kroz aplikaciju (registracija) ili ručno u tabeli
--  users, pa se ovom skriptom prevede u servis i dodele mu se zgrade.
-- ============================================================================

--  1) POPUNITI: email korisnika i ID-jeve zgrada koje održava
SET @email = 'servis@skayvortex.rs';
SET @zgrade = '1,2,3,4,5';           -- lista ID-jeva zgrada, razdvojena zarezima

SET @uid = (SELECT id FROM users WHERE email = @email);


--  2) Uloga
UPDATE users SET user_tipId = 4 WHERE id = @uid;


--  3) Dodeljene zgrade
INSERT INTO servis_zgrada_indices (userId, zgradaId, created_at, updated_at)
SELECT @uid, z.id, NOW(), NOW()
FROM zgradas z
WHERE FIND_IN_SET(z.id, @zgrade)
  AND NOT EXISTS (
      SELECT 1 FROM servis_zgrada_indices s
      WHERE s.userId = @uid AND s.zgradaId = z.id
  );


--  4) Podrazumevano uključena email obaveštenja za servis
--     (bez ovoga korisnik NE dobija mejlove - lista u profilu bi bila prazna)
INSERT INTO email_obavestenja_users (user_id, email_obavestenja_tip_id, created_at, updated_at)
SELECT @uid, t.id, NOW(), NOW()
FROM email_obavestenja_tips t
JOIN email_obavestenja_kategorijas k ON k.id = t.email_obavestenja_kategorija_id
WHERE k.for_user_tip = 4
  AND NOT EXISTS (
      SELECT 1 FROM email_obavestenja_users u
      WHERE u.user_id = @uid AND u.email_obavestenja_tip_id = t.id
  );


--  5) Zatečene prijave se označavaju kao pregledane
--     (bez ovoga bi serviseru sve stare prijave u njegovim zgradama bile "NOVO";
--      od sada mu se kao nove prikazuju samo prijave koje stignu posle uključivanja)
INSERT INTO kvar_tiket_upravnik_views
    (kvar_tiketId, userId, prvi_pregled, poslednji_pregled, broj_pregleda, created_at, updated_at)
SELECT kt.id, @uid, NOW(), NOW(), 1, NOW(), NOW()
FROM kvar_tikets kt
JOIN servis_zgrada_indices s ON s.zgradaId = kt.zgradaId AND s.userId = @uid
WHERE NOT EXISTS (
    SELECT 1 FROM kvar_tiket_upravnik_views v
    WHERE v.kvar_tiketId = kt.id AND v.userId = @uid
);

--     Isto i za komentare - stari komentari se ne broje kao neviđeni
INSERT INTO kvar_komentar_user_views
    (kvar_tiketId, userId, broj_vidjenih, created_at, updated_at)
SELECT kt.id, @uid, kt.tiket_br_komentara, NOW(), NOW()
FROM kvar_tikets kt
JOIN servis_zgrada_indices s ON s.zgradaId = kt.zgradaId AND s.userId = @uid
WHERE NOT EXISTS (
    SELECT 1 FROM kvar_komentar_user_views v
    WHERE v.kvar_tiketId = kt.id AND v.userId = @uid
);


-- ---------------------------------------------------------------------------
--  PROVERA
-- ---------------------------------------------------------------------------

-- SELECT u.id, u.name, u.email, u.user_tipId,
--        (SELECT COUNT(*) FROM servis_zgrada_indices s WHERE s.userId = u.id) AS zgrada,
--        (SELECT COUNT(*) FROM kvar_tiket_upravnik_views v WHERE v.userId = u.id) AS pregledani_tiketi,
--        (SELECT COUNT(*) FROM email_obavestenja_users e
--           JOIN email_obavestenja_tips t ON t.id = e.email_obavestenja_tip_id
--           JOIN email_obavestenja_kategorijas k ON k.id = t.email_obavestenja_kategorija_id
--          WHERE e.user_id = u.id AND k.for_user_tip = 4) AS email_obavestenja
-- FROM users u WHERE u.id = @uid;
