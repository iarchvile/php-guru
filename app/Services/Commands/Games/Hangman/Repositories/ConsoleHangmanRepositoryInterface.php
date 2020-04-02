<?php
namespace App\Services\Commands\Games\Hangman\Repositories;

use Illuminate\Console\Command;

interface ConsoleHangmanRepositoryInterface
{
    /**
     * @param  Command  $command
     *
     * @return mixed
     */
    public function boot(Command $command);
}