<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\EmailObavestenjaUser;
use App\Models\UpravnikZgradaIndex;
use App\Models\UserStanIndex;
use App\Models\User;

class Zgrada extends Model
{
    use HasFactory;

    /**
     * Get the comments for the blog post.
     */
    public function stanovi(): HasMany
    {
        return $this->hasMany(Stan::class, 'zgradaId');
    }

    public static function zgradeUpravnika()
    {
       return UpravnikZgradaIndex::select('zgradas.id', 'zgradas.naziv')
            ->leftJoin('zgradas', 'zgradas.id', '=', 'upravnik_zgrada_indices.zgradaId')
            ->where('upravnik_zgrada_indices.userId', '=', auth()->user()->id)
            ->pluck('zgradas.naziv', 'zgradas.id');
    }

    /**
     * Vraca e-mail adrese stanara koji su čekirali tip obaveštenja za izabrane zgrade
     * 
     * @param array $zgrade
     * @param int $tip_obavestenja
     * @return array
     */
    public static function emailAdreseStanara($zgrade, $tip_obavestenja = 0){
        $stanovi=[];
        foreach($zgrade as $zgrada){
            $stanovi_p = Zgrada::find($zgrada)->stanovi->pluck('id');
            $stanovi = array_merge($stanovi, $stanovi_p->toArray());
        }
        $stanari = UserStanIndex::whereIn('stanId', $stanovi)->groupBy('userId')->pluck('userId');
        if($tip_obavestenja > 0){
            $stanari = EmailObavestenjaUser::whereIn('user_id', $stanari)->where('email_obavestenja_tip_id', $tip_obavestenja)->groupBy('user_id')->pluck('user_id');
        }
        $bcc_adrese = User::whereIn('id', $stanari)->groupBy('email')->pluck('email');
        
        return ['bcc_adrese' => $bcc_adrese, 'stanari' => $stanari];
    }
}
