<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\OAuth\Repositories\OAuthRepositoryInterface;

class OAuthController extends Controller
{

    /**
     * @var OAuthRepositoryInterface
     */
    private $repository;

    public function __construct(OAuthRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function auth()
    {
        return $this->repository->auth();

        /**
         * ID: 9ccfc57977f342d2b29d82d21cc335e9
         * Пароль:  5eb40741c04943709a6674caf4acbfbd
         * Callback URL: http://php-guru.ru.local/yandex/callback
         *
         * https://oauth.yandex.ru/client/9ccfc57977f342d2b29d82d21cc335e9/info
         */

        /*        $response = Http::asForm()->post('https://oauth.yandex.ru/token', [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => '1:iXXeOqWPbrWG8LcI:moNwIEYWPbau-SlsZ31WzLi_vgeWbLrQtyet3GpgQMMkBhYXVvnP:P2mTZRQDXH2gwxZ--qxCWA',
                    'client_id' => '9ccfc57977f342d2b29d82d21cc335e9',
                    'client_secret' => '5eb40741c04943709a6674caf4acbfbd',
                    'scope' => 'login:email login:birthday login:info',
                ]);


                return json_decode((string) $response->body(), true);

        $query = http_build_query([
            'client_id' => config('oauth.yandex.client_id.'),
            'redirect_uri' => config('app.url').'/yandex/callback',
            'response_type' => 'code',
            'scope' => 'login:email login:birthday login:info',
            'state' => $state,
        ]);

        return redirect('https://oauth.yandex.ru/authorize?'.$query);*/
    }

    public function callback()
    {
        return $this->repository->callback();
    }
}
