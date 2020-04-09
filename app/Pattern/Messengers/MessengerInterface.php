<?php


namespace App\Pattern\Messengers;


interface MessengerInterface
{
    /**
     * @param  string  $message
     *
     * @return string
     */
    public function send(string $message) :string;
}