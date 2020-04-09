<?php


namespace App\Pattern;


use App\Pattern\Messengers\EmailMessenger;
use App\Pattern\Messengers\SmsMessenger;

class AppMessenger
{

    private $messenger;

    public function toEmail()
    {
        $this->messenger = new EmailMessenger();

        return $this;
    }

    public function toSms()
    {
        $this->messenger = new SmsMessenger();

        return $this;
    }

    public function send($message)
    {
        return $this->messenger->send($message);
    }

}