<?php

namespace App\Actions\Zgrada;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

use App\Models\EmailObavestenjaUser;
use App\Models\ServisZgradaIndex;
use App\Models\User;
use App\Mail\ObavestenjeStanarima;

/**
 * Email obaveštenja za korisnike sa ulogom "servis održavanja".
 * Servis dobija mejl za svaku novu prijavu kvara i svaki komentar
 * u zgradama koje održava, ako to nije isključio u profilu.
 */
class ServisNotifikacije
{
    public const TIP_NOVA_PRIJAVA  = 'Nova prijava kvara';
    public const TIP_NOVI_KOMENTAR = 'Novi komentar';

    /**
     * ID tipa email obaveštenja iz kategorije namenjene servisu.
     */
    private static function tipId(string $naziv)
    {
        return DB::table('email_obavestenja_tips as t')
            ->join('email_obavestenja_kategorijas as k', 'k.id', '=', 't.email_obavestenja_kategorija_id')
            ->where('k.for_user_tip', User::TIP_SERVIS)
            ->where('t.naziv', $naziv)
            ->value('t.id');
    }

    /**
     * Email adrese servisera zaduženih za zgradu, koji primaju dati tip obaveštenja.
     *
     * @param int $zgradaId
     * @param string $tip_naziv
     * @param int|null $osim_userId - autor akcije ne dobija mejl o sopstvenoj akciji
     */
    private static function primaoci($zgradaId, string $tip_naziv, $osim_userId = null)
    {
        $servisIds = ServisZgradaIndex::where('zgradaId', $zgradaId)->pluck('userId');

        if ($osim_userId) {
            $servisIds = $servisIds->reject(fn($id) => $id == $osim_userId);
        }

        if ($servisIds->isEmpty()) return collect();

        $tip_id = self::tipId($tip_naziv);

        if ($tip_id) {
            $servisIds = $servisIds->filter(
                fn($id) => EmailObavestenjaUser::userPrimaEmail($id, $tip_id)
            );
        }

        if ($servisIds->isEmpty()) return collect();

        return User::whereIn('id', $servisIds)->pluck('email');
    }

    /**
     * Slanje mejla svim serviserima zgrade.
     */
    private static function posalji($adrese, string $subject, string $message, string $link)
    {
        foreach ($adrese as $email) {
            Mail::to($email)->send(
                new ObavestenjeStanarima($subject, ['text' => $message], [], $link)
            );
        }
    }

    /**
     * Nova prijava kvara u zgradi koju servis održava.
     */
    public static function novaPrijava($zgradaId, $tiketId, $zgrada_naziv, $stan_br, $vrsta_kvara, $prioritet, $opis)
    {
        $adrese = self::primaoci($zgradaId, self::TIP_NOVA_PRIJAVA);
        if ($adrese->isEmpty()) return;

        $subject = 'Nova prijava kvara – ' . $zgrada_naziv;

        $message = implode('', [
            '<p><strong>Nova prijava kvara je podneta.</strong></p>',
            '<p>',
            '<strong>Prijava br:</strong> #' . $tiketId . '<br>',
            '<strong>Zgrada:</strong> ' . e($zgrada_naziv) . '<br>',
            '<strong>Stan:</strong> ' . e($stan_br) . '<br>',
            '<strong>Vrsta kvara:</strong> ' . e($vrsta_kvara ?? '–') . '<br>',
            '<strong>Prioritet:</strong> ' . e($prioritet ?? '–') . '<br>',
            '<strong>Opis:</strong> ' . e($opis),
            '</p>',
        ]);

        self::posalji($adrese, $subject, $message, 'kvar-pregled?tid=' . $tiketId);
    }

    /**
     * Novi komentar na prijavi kvara u zgradi koju servis održava.
     */
    public static function noviKomentar($zgradaId, $tiketId, $autor_id, $autor_ime, $komentar)
    {
        $adrese = self::primaoci($zgradaId, self::TIP_NOVI_KOMENTAR, $autor_id);
        if ($adrese->isEmpty()) return;

        $subject = 'Novi komentar na prijavi kvara #' . $tiketId;

        $message = implode('', [
            '<p><strong>Dodat je novi komentar na prijavu kvara.</strong></p>',
            '<p>',
            '<strong>Prijava br:</strong> #' . $tiketId . '<br>',
            '<strong>Komentar napisao:</strong> ' . e($autor_ime) . '<br>',
            '<strong>Komentar:</strong> ' . e($komentar),
            '</p>',
        ]);

        self::posalji($adrese, $subject, $message, 'kvar-pregled?tid=' . $tiketId);
    }
}
