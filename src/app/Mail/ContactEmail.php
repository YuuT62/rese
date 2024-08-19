<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $reservation=$this->reservation;
        return $this->to($reservation->user->email)
                    ->subject('【Rese】予約当日のお知らせ')
                    ->view('mail.contact_email',compact('reservation'))
                    ->text('mail.contact_email_text',compact('reservation'));
    }
}
