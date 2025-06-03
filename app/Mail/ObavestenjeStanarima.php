<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Support\Facades\Storage;

class ObavestenjeStanarima extends Mailable
{
    use Queueable, SerializesModels;
    
    public $subject='';
    public $message;
    public $attacments;
    public $sorce;
    public $button_link;
    /**
     * Create a new message instance.
     *  public string $subject,
     *  public string $message,
     */
    public function __construct(
        $subject, $message, $attachments, $button_link = null
    )
    {
        $this->subject = $subject;
        $this->message = $message;
        $this->attachments = $attachments;
        $this->button_link = $button_link;
        $this->sorce=env('IMAGE_MANIPILATION');
    }
       
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        if($this->button_link){
            return new Content(
                view: 'emails.novi-sadrzaj-na-sajtu',
                text: 'emails.novi-sadrzaj-na-sajtu-text',
                with : ['message_html' => $this->message['text'], 'message_txt' => $this->stripHtml($this->message['text']), 'button_link' => $this->button_link]
            );
        }else{
            return new Content(
                view: 'emails.obavestenje-stanarima',
                text: 'emails.obavestenje-stanarima-text',
                with : ['message_html' => $this->message['text'], 'message_txt' => $this->stripHtml($this->message['text'])]
            );
        }
    }

    private function stripHtml($html)
    {
        //$html = preg_replace('/<p[^>]*>/si', ' \n ', $html);
        return strval(preg_replace('/<[^>]*>/', ' ', $html));
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
