<?php

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketBookedMail extends Mailable
{
    use Queueable, SerializesModels;
    public $tickets;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $tickets)
    {
        $this->tickets = $tickets;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->from(env('MAIL_USERNAME'))
            ->markdown('mails.booked-tickets')
            ->subject(trans('Mail notification'));
    }
}
