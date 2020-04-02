<?php


namespace App\Services\Goods\Repositories;


use App\Models\Goods;
use App\Services\Cache\CacheManagerInterface;
use App\Services\Cache\CacheTags;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Exceptions\HttpResponseException;

class EloquentGoodsRepository implements GoodsRepositoryInterface
{

    /**
     * @var CacheManagerInterface
     */
    private CacheManagerInterface $cacheManager;

    public function __construct(CacheManagerInterface $cacheManager)
    {
        $this->cacheManager = $cacheManager;
    }

    /**
     * @inheritDoc
     */
    public function getAll(array $data) :LengthAwarePaginator
    {
        return \Cache::tags(CacheTags::INDEX)
            ->rememberForever($this->cacheManager
                ->publicCacheKey(), function () use ($data) {
                $collection = Goods::select($data['fields']);

                if (isset($data['order'])) {
                    $collection->orderBy($data['order'][0], $data['order'][1] ?? 'asc');
                }

                $perPage = $data['per_page'] ?? Goods::GOODS_PER_PAGE;

                $response = $collection->paginate($perPage);

                if (isset($data['page']) && ($data['page'] > $response->lastPage())) {
                    throw new HttpResponseException(response()->json(['status' => 422], 422));
                }

                return $response;
            });
    }

    /**
     * @inheritDoc
     */
    public function find(int $id, array $columns) :Goods
    {
        return \Cache::tags(CacheTags::SHOW)
            ->rememberForever($this->cacheManager
                ->publicCacheKey(), function () use ($id, $columns) {
                return Goods::findOrFail($id, $columns);
            });
    }

    /**
     * @inheritDoc
     */
    public function createFromArray(array $data) :int
    {
        return (new Goods())->create($data)->id;
    }

    /**
     * @inheritDoc
     */
    public function updateFromArray(array $data, Goods $good)
    {
        return $good->update($data);
    }
}
