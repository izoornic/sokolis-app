<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailZgradaSendLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'email_log_id',
        'email_obavestenja_tip_id',
        'zgrada_id',
        'comment',
    ];
}
