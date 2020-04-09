<?php


namespace App\Pattern\Messengers;


class EmailMessenger implements MessengerInterface
{
    /**
     * @param  string  $message
     *
     * @return string
     */
    public function send(string $message) :string
    {
        return 'Message sending from '.__CLASS__;
    }
}