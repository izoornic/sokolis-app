<?php

namespace App\Actions\Zgrada;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

use App\Models\EmailObavestenjaUser;
use App\Models\EmailObavestenjaLog;
use App\Models\Zgrada;
use App\Models\User;

use App\Mail\ObavestenjeStanarima;

/**
 * Klasa za slanje email obaveštenja stanarima
 */
class EmailStanarimaSender
{
    /**
     * Slanje email obaveštenja stanarima 
     * @param string $subject - naslov emaila
     * @param string $message_p - sadržaj emaila
     * @param array $files - lista fajlova koji se šalju kao prilog
     * @param array $zgrade - niz ID zgrada na koje se obaveštenje odnosi
     * @param int $tip_id - ID tipa obaveštenja filtrira koji stanar dobija email
     * @param string|null $button_link - link za dugme u emailu (opciono)
     * @return void
     */
    public static function send($subject, $message_p, $files, $zgrade, $tip_id, $button_link = null)
    {
        
        $attacments = [];
        $email_adrese = Zgrada::emailAdreseStanara($zgrade, $tip_id);
        if(count($files)){
            foreach($files as $file_attacment){
                if(Storage::disk('mail_attachments')->putFileAs('', $file_attacment['file_to_up'], $file_attacment['original_name']) ){
                    array_push($attacments, [
                        'origin' => 'upload',
                        'originalName' => $file_attacment['original_name'],
                        'hashName' => $file_attacment['hashName'],
                        'file' =>  Storage::disk('mail_attachments')->path($file_attacment['original_name']),
                        'mime' => $file_attacment['file_to_up']->getMimeType(),
                        'options' => ['mime' => $file_attacment['file_to_up']->getMimeType()]
                    ]);
                }
            }
        }
       
        $message = ['text' => $message_p];
        
        Mail::to('office@stanari-sokolis.rs')
        ->bcc($email_adrese['bcc_adrese'])
        ->send(new ObavestenjeStanarima($subject, $message, $attacments, $button_link));

        //log email
        $email_log = [
            'email_obavestenja_tip_id' => $tip_id,
            'subject' => $subject,
            'message' => $message_p,
            'attachments' => (count($attacments)) ? json_encode($attacments) : null
        ];
        EmailObavestenjaLog::log($email_log, $email_adrese['stanari'], $zgrade);
    }

    public static function sendToSingleUser($subject, $message_p, $user_id, $tip_id, $button_link = null)
    {
        if(EmailObavestenjaUser::userPrimaEmail($user_id, $tip_id)) {
            $email_adresa = User::find($user_id)->email;
            $zgrada = array_unique(User::find($user_id)->stanoviDetalji->pluck('zgradaId')->toArray());
        } else {
            return; // User does not want to receive this type of email
        }

        $message = ['text' => $message_p];
        Mail::to($email_adresa)
            ->send(new ObavestenjeStanarima($subject, $message, [], $button_link));
        
        //log email
        $email_log = [
            'email_obavestenja_tip_id' => $tip_id,
            'subject' => $subject,
            'message' => $message_p,
            'attachments' => null
        ];
        // Log the email for the specific user and building
        // Assuming $zgrada is an array of building IDs
        EmailObavestenjaLog::log($email_log, [$user_id], [$zgrada[0]]);
    }

}