<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Promo extends Mailable
{
    use Queueable, SerializesModels;

    protected $firstname;
    protected $lastname;
    protected $email;
    protected $contactno;
    protected $message;

    protected $promo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request, $promo = null)
    {
        $this->firstname = $request['firstname'] ?? '';
        $this->lastname  = $request['lastname'] ?? '';
        $this->email     = $request['email'] ?? '';
        $this->contactno = $request['contact_no'] ?? '';
        $this->message   = $request['message'] ?? '';
        $this->promo     = $promo;
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

        if ($this->promo) {
            $mail->subject('Promo Booking Inquiry')
                 ->markdown('mail.promo.book', [
                     'greeting'  => 'Good Day!',
                     'name'      => $this->firstname . ' ' . $this->lastname,
                     'email'     => $this->email,
                     'contactno' => $this->contactno,
                     'message'   => $this->message,
                     'promo'     => $this->promo,
                 ]);
        } else {
            $mail->subject('Promo Inquiry')
                 ->markdown('mail.promo.inquire', [
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
