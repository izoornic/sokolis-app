<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Support\Facades\Log;
use App\Events\EmailSendTest;

class LogSentMessage
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(MessageSent $event): void
    {
        // Log the message details
        /* Log::info('Email sent:', [
            'subject' => $event->message->getSubject(),
            'to' => $event->message->getTo(),
            'from' => $event->message->getFrom(),
        ]); */
    }
}
