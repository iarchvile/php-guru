<?php

namespace Tests\Feature;

use App\Models\Goods;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class APITest extends TestCase
{

    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        factory(Goods::class, 100)->create();
    }

    /**
     * @group api
     */
    public function testIndexTest()
    {
        $response = $this->getJson('/api/goods/');
        $response->assertStatus(200);
        $response->assertJsonPath('meta.total', 100);

        $data = [
            'name',
            'price',
            'name,desc',
            'name,asc',
            'price,desc',
            'price,asc'
        ];

        foreach ($data as $k) {
            $response = $this->getJson("/api/goods?order={$k}");
            $response->assertStatus(200);
            $response->assertJsonPath('meta.total', 100);
        }


        $data = [
            'foo',
            'bar',
            'baz',
        ];

        foreach ($data as $k) {
            $response = $this->getJson("/api/goods?order={$k}");
            $response->assertStatus(422);
        }

    }

    /**
     * @group api
     */
    public function testShowTest()
    {

        $data = [
            'description',
            'photos',
            'description,photos',
            'photos,description'
        ];

        foreach ($data as $k) {
            $response = $this->getJson("/api/goods/10?fields={$k}");
            $response->assertStatus(200);
            $response->assertJsonPath('data.id', 10);
        }

        $data = [
            'foo',
            'bar',
            'baz',
        ];

        foreach ($data as $k) {
            $response = $this->getJson("/api/goods/10?fields={$k}");
            $response->assertStatus(422);
        }

    }

    /**
     * @group api
     */
    public function testCreateTest()
    {
        $response = $this->postJson("/api/goods/", [
            'name' => 'foo',
            'description' => 'bar',
            'photos' => ['http://ya.ru?1', 'http://ya.ru?2', 'http://ya.ru?3'],
            'price' => 0.1
        ]);

        $response->assertStatus(200);
        $response->assertJsonPath('id', 101);

    }
}
