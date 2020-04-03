<?php


namespace App\Services\OAuth\Repositories;


use Illuminate\Config\Repository;
use Illuminate\Http\Request;

/**
 * Class VkOAuthRepository
 * @package App\Services\OAuth\Repositories
 * @link https://vk.com/dev/authcode_flow_user
 */
class VkOAuthRepository implements OAuthRepositoryInterface
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
     * @var integer
     */
    public $user_id;
    /**
     * @var string
     */
    public $expires_in;
    /**
     * @var string API version
     */
    public $v = '5.103';
    /**
     * @var string
     */
    public $user_email;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->client_id = config('oauth.vk.client_id');
        $this->client_secret = config('oauth.vk.client_secret');
        $this->redirect_uri = config('app.url').'/vk/callback';
        $this->scope = config('oauth.vk.scope');
    }

    public function auth()
    {
        $this->request->session()->put('state', $state = \Str::random(40));

        $query = http_build_query(
            [
                'client_id' => $this->client_id,
                'redirect_uri' => $this->redirect_uri,
                'response_type' => 'code',
                'display' => 'page',
                'scope' => $this->scope,
                'state' => $state,
            ]);

        return redirect('https://oauth.vk.com/authorize?'.$query);
    }

    public function callback()
    {
        $state = $this->request->session()->pull('state');

        try {
            throw_unless(strlen($state) > 0 && $state === $this->request->state,
                \InvalidArgumentException::class);
        } catch (\Throwable $e) {
        }

        $response = \Http::asForm()->post('https://oauth.vk.com/access_token',
            [
                'client_id' => $this->client_id,
                'client_secret' => $this->client_secret,
                'redirect_uri' => $this->redirect_uri,
                'code' => $this->request->code,
            ])->json();

        if (isset($response['error'])) {
            return $response;
        }

        $this->access_token = $response['access_token'];
        $this->user_id = $response['user_id'];
        $this->expires_in = $response['expires_in'];
        $this->user_email = $response['email'];

        return $this->info();
    }

    public function info()
    {
        $response = \Http::get('https://api.vk.com/method/users.get', [
            'access_token' => $this->access_token,
            'user_ids' => $this->user_id,
            'fields' => 'photo_id, verified, sex, bdate, city, country, home_town, has_photo, photo_50, photo_100, photo_200_orig, photo_200, photo_400_orig, photo_max, photo_max_orig, online, domain, has_mobile, contacts, site, education, universities, schools, status, last_seen, followers_count, common_count, occupation, nickname, relatives, relation, personal, connections, exports, activities, interests, music, movies, tv, books, games, about, quotes, can_post, can_see_all_posts, can_see_audio, can_write_private_message, can_send_friend_request, is_favorite, is_hidden_from_feed, timezone, screen_name, maiden_name, crop_photo, is_friend, friend_status, career, military, blacklisted, blacklisted_by_me, can_be_invited_group',
            'v' => $this->v
        ]);

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
