<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Stranica;
use App\Models\UserStanIndex;
use App\Models\Stan;
use App\Models\Zgrada;
use App\Models\UpravnikZgradaIndex;

use Auth;

use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasMany;

//use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_tipId',
        'tel',
        'adresa',
        'sediste',
        'zip',
        'mb',
        'pib',
        'tr',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

     /**
     * Lista stranica i ruta za kreiranje menija
     * u zavisnosti od uloge koju korisnik ima
     *
     * @return void
     */
    public static function userPozicijeList()
    {
        return Stranica::select('stranicas.stranica_naziv', 'stranicas.route_name')
            ->join('user_stranica_prikazs', 'user_stranica_prikazs.stranica_Id', '=', 'stranicas.id')
            ->join('users', 'user_stranica_prikazs.user_tip_Id', '=', 'users.user_tipId')
            ->where([
                'stranicas.show_in_menu' => 1,
                'users.id' => Auth::user()->id,
            ])
            ->orderBy('stranicas.menu_order')
            ->pluck('stranica_naziv', 'route_name');
    }

    /**
     * Setuje idjeve u sesiju
     *
     * @return void
     */
    public static function getMyZgradeStanove()
    {
        $stanovi = UserStanIndex::select('stanId')
            ->where('userId', '=', Auth::user()->id)
            ->pluck('stanId');

        $zgrade = Stan::distinct('zgradaId')
            ->whereIn('id', $stanovi)
            ->pluck('zgradaId');
        
            session(['stanovi' => $stanovi, 'zgrade' => $zgrade]);
    }

    
    public function zgrade(): HasManyThrough
    {
        return $this->hasManyThrough(
            Zgrada::class,
            UpravnikZgradaIndex::class,
            'userId',
            'id',
            'id',
            'zgradaId'
        );
    }


    public function stanoviDetalji(): HasManyThrough
    {
        return $this->hasManyThrough(
            Stan::class,
            UserStanIndex::class,
            'userId',
            'id',
            'id',
            'stanId'
        );
    }

    public function stanovi(): HasMany
    {
        return $this->HasMany(UserStanIndex::class, 'userId');
    }

    public function emailObavestenja()
    {
        return $this->belongsToMany(EmailObavestenjaUser::class, 'email_obavestenja_users', 'user_id', 'email_obavestenja_tip_id')->withTimestamps();
    }

    /**
     * Get sve email obavestenja korisnika.
     * Iz nepoynatioh razloga ova funkcija ne radi?!?
     */
    /* public function emailObavestenja() : HasManyThrought
    {
        return $this->hasManyThrough(
            EmailObavestenjaTip::class, 
            EmailObavestenjaUser::class,
            'user_id',
            'id',
            'id',
            'email_obavestenje_tip_id'
        );
    } */

}
