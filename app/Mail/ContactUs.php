<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUs extends Mailable
{
    use Queueable, SerializesModels;

    protected $firstname;
    protected $lastname;
    protected $email;
    protected $contactno;
    protected $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->firstname = $request['firstname'] ?? '';
        $this->lastname  = $request['lastname'] ?? '';
        $this->email     = $request['email'] ?? '';
        $this->contactno = $request['contact_no'] ?? '';
        $this->message   = $request['message'] ?? '';
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

        $mail->subject('Website - Contact Us')
             ->markdown('mail.contactus', [
                 'greeting'  => 'Good Day!',
                 'name'      => $this->firstname . ' ' . $this->lastname,
                 'email'     => $this->email,
                 'contactno' => $this->contactno,
                 'message'   => $this->message,
             ]);

        return $mail;
    }
}
