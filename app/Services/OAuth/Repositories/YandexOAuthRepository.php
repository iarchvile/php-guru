<?php


namespace App\Services\OAuth\Repositories;


use Illuminate\Config\Repository;
use Illuminate\Http\Request;

class YandexOAuthRepository implements OAuthRepositoryInterface
{
    /**
     * @var Request
     */
    private $request;
    /**
     * @var Repository
     */
    private $client_id;
    /**
     * @var Repository
     */
    private $client_secret;
    /**
     * @var Repository
     */
    private $redirect_uri;
    /**
     * @var Repository
     */
    private $scope;
    /**
     * @var string
     */
    public $access_token;
    /**
     * @var string
     */
    public $refresh_token;
    /**
     * @var string
     */
    public $expires_in;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->client_id = config('oauth.yandex.client_id');
        $this->client_secret = config('oauth.yandex.client_secret');
        $this->redirect_uri = config('app.url').'/yandex/callback';
        $this->scope = config('oauth.yandex.scope');
    }

    public function auth()
    {
        $this->request->session()->put('state', $state = \Str::random(40));

        $query = http_build_query(
            [
                'client_id' => $this->client_id,
                'redirect_uri' => $this->redirect_uri,
                'response_type' => 'code',
                'scope' => $this->scope,
                'state' => $state,
            ]);

        return redirect('https://oauth.yandex.ru/authorize?'.$query);
    }

    public function callback()
    {
        $state = $this->request->session()->pull('state');

        try {
            throw_unless(strlen($state) > 0 && $state === $this->request->state,
                \InvalidArgumentException::class);
        } catch (\Throwable $e) {
        }

        $response = \Http::asForm()->post('https://oauth.yandex.ru/token',
            [
                'grant_type' => 'authorization_code',
                'client_id' => $this->client_id,
                'client_secret' => $this->client_secret,
                'redirect_uri' => $this->redirect_uri,
                'code' => $this->request->code,
            ])->json();

        if (isset($response['error'])) {
            return $response;
        }

        $this->access_token = $response['access_token'];
        $this->refresh_token = $response['refresh_token'];
        $this->expires_in = $response['expires_in'];

        return $this->info();
    }

    public function info()
    {
        $response = \Http::withToken($this->access_token)
            ->get('https://login.yandex.ru/info');

        if ($response->ok()) {
            return $response->json();
        }

        return [
            'response' => [
                'status' => $response->toPsrResponse()->getReasonPhrase(),
                'statusCode' => $response->status(),
            ],
        ];
    }

}
