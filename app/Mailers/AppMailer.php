<?php

namespace App\Mailers;
use Illuminate\Contracts\Mail\Mailer;
use App\User;

class AppMailer{

    protected $mailer;

    protected $from ='admin@yanbu.com';

    protected $to;

    protected $view;

    protected $data = [];

    public function __construct(Mailer $mailer){
        $this->mailer = $mailer;
    }

    public function sendConfirmationEmail(User $user){
        $this->to = $user->email;
        $this->view = 'emails.confirmationEmail';
        $this->data = compact('user');

        $this->deliver();
    }

    public function passwordResetEmail(User $user){
        $userData = $user;
        $this->to = $user->email;
        $this->view = 'emails.passwordResetEmail';
        $this->data = compact('userData');

        $this->deliver();
    }

    public function contactUsEmail($data){
        // echo $data['email'];
        // pr($data); exit;
        $this->to = $data['email'];
        $this->view = 'emails.contactUsEmail';
        $this->data = compact('data');

        $this->deliver();
    }

    public function deliver(){
        $this->mailer->send($this->view, $this->data, function($message){
            $message->from($this->from, 'Admin')
                    ->to($this->to);
        });
    }
}
