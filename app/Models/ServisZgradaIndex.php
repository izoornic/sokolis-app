<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServisZgradaIndex extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'userId',
        'zgradaId',
    ];

    /**
     * Da li servis održava zadatu zgradu.
     */
    public static function odrzavaZgradu($userId, $zgradaId)
    {
        return ServisZgradaIndex::where('userId', $userId)
            ->where('zgradaId', $zgradaId)
            ->exists();
    }
}
