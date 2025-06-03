<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\EmailUserSendLog;
use App\Models\EmailZgradaSendLog;

class EmailObavestenjaLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'email_obavestenja_tip_id',
        'subject',
        'message',
        'attachments',
        'status',
        'error'
    ];

    public function zgrade(): HasMany
    {
        return $this->HasMany(EmailZgradaSendLog::class, 'email_log_id');
    }

    public function stanari(): HasMany
    {
        return $this->HasMany(EmailUserSendLog::class, 'email_log_id');
    }

    public function tip()
    {
        return $this->belongsTo(EmailObavestenjaTip::class, 'email_obavestenja_tip_id');
    }

    /**
     * Log email obavestenje i loguje stanare i zgrade kojima je poslato
     * 
     * @param array $email_log
     * @param array $stanari_ids
     * @param array $zgrade
     * @return void
     */
    public static function log($email_log, $stanari_ids, $zgrade){
        $log = new EmailObavestenjaLog();
        $log->email_obavestenja_tip_id = $email_log['email_obavestenja_tip_id'];
        $log->subject = $email_log['subject'];
        $log->message = $email_log['message'];
        $log->attachments = $email_log['attachments'] ?? null;
        $log->save();
        
        foreach($stanari_ids as $stanar_id){
            EmailUserSendLog::create([
                'email_log_id' => $log->id,
                'email_obavestenja_tip_id' => $email_log['email_obavestenja_tip_id'],
                'user_id' => $stanar_id
            ]);
        }

        foreach($zgrade as $zgrada){
            EmailZgradaSendLog::create([
                'email_log_id' => $log->id,
                'email_obavestenja_tip_id' => $email_log['email_obavestenja_tip_id'],
                'zgrada_id' => $zgrada
            ]);
        }
    }
}
