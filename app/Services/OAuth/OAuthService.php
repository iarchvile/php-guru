<?php

namespace App\Services\OAuth;

use App\Services\OAuth\Repositories\OAuthRepositoryInterface;

class OAuthService
{
    /**
     * @var OAuthRepositoryInterface
     */
    private $repository;

    public function __construct(OAuthRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
}
