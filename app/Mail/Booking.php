<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Booking extends Mailable
{
    use Queueable, SerializesModels;

    protected $firstname;
    protected $lastname;
    protected $email;
    protected $contactno;
    protected $message;

    protected $booking;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request, $booking = null)
    {
        $this->firstname = $request['firstname'] ?? '';
        $this->lastname  = $request['lastname'] ?? '';
        $this->email     = $request['email'] ?? '';
        $this->contactno = $request['contact_no'] ?? '';
        $this->message   = $request['message'] ?? '';
        $this->booking   = $booking;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->email, $this->firstname . ' ' . $this->lastname)
                    ->replyTo($this->email, $this->firstname . ' ' . $this->lastname)
                    ->subject('Booking Inquiry')
                    ->markdown('mail.booking.book', [
                        'greeting'  => 'Good Day!',
                        'name'      => $this->firstname . ' ' . $this->lastname,
                        'email'     => $this->email,
                        'contactno' => $this->contactno,
                        'message'   => $this->message,
                        'booking'   => $this->booking,
                    ]);
    }
}
