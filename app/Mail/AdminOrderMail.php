<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $adminMailDetails;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($adminMailDetails)
    {
        $this->adminMailDetails = $adminMailDetails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Booking has been Placed.')
                    ->view('emails.adminMailDetails');
    }
}
