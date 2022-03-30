<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Tour extends Mailable
{
    use Queueable, SerializesModels;

    protected $firstname;
    protected $lastname;
    protected $email;
    protected $contactno;
    protected $message;

    protected $tour;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request, $tour = null)
    {
        $this->firstname = $request['firstname'] ?? '';
        $this->lastname  = $request['lastname'] ?? '';
        $this->email     = $request['email'] ?? '';
        $this->contactno = $request['contact_no'] ?? '';
        $this->message   = $request['message'] ?? '';
        $this->tour      = $tour;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->from($this->email, $this->firstname . ' ' . $this->lastname)
                    ->replyTo($this->email, $this->firstname . ' ' . $this->lastname);
        
        if ($this->tour) {
            $mail->subject('Tour Booking Inquiry')
                ->markdown('mail.tour.book', [
                'greeting'  => 'Good Day!',
                'name'      => $this->firstname . ' ' . $this->lastname,
                'email'     => $this->email,
                'contactno' => $this->contactno,
                'message'   => $this->message,
                'tour'      => $this->tour,
            ]);
        } else {
            $mail->subject('Tour Inquiry')
                ->markdown('mail.tour.inquire', [
                'greeting'  => 'Good Day!',
                'name'      => $this->firstname . ' ' . $this->lastname,
                'email'     => $this->email,
                'contactno' => $this->contactno,
                'message'   => $this->message,
            ]);
        }

        return $mail;
    }
}
