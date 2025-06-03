<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailObavestenjaUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'email_obavestenja_tip_id',
        'user_id'
    ];

    public static function userPrimaEmail($user_id, $tip_id)
    {
        return EmailObavestenjaUser::where('user_id', $user_id)
            ->where('email_obavestenja_tip_id', $tip_id)
            ->exists();
    }
}
