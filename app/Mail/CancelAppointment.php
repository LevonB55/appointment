<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Auth;

class CancelAppointment extends Mailable
{
    use Queueable, SerializesModels;

    public $textarea;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($textarea)
    {
        $this->textarea = $textarea;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(Auth::user()->email)
                    ->subject('Appointment Cancellation')
                    ->markdown('emails.appointment.cancel');
    }
}
