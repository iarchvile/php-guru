<?php


namespace App\Services\Goods;


use App\Models\Goods;
use App\Services\Goods\Handlers\CreateGoodsHandler;
use App\Services\Goods\Repositories\GoodsRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GoodsService
{
    /**
     * @var GoodsRepositoryInterface
     */
    private GoodsRepositoryInterface $goodsRepository;
    /**
     * @var CreateGoodsHandler
     */
    private CreateGoodsHandler $createGoodsHandler;

    public function __construct(
        CreateGoodsHandler $createGoodsHandler,
        GoodsRepositoryInterface $goodsRepository)
    {
        $this->goodsRepository = $goodsRepository;
        $this->createGoodsHandler = $createGoodsHandler;
    }

    /**
     * @param  array  $data
     *
     * @return LengthAwarePaginator
     */
    public function getAll(array $data) :LengthAwarePaginator
    {
        return $this->goodsRepository->getAll($data);
    }

    /**
     * @param  int  $id
     * @param  array  $data
     *
     * @return Goods
     */
    public function find(int $id, array $data) :Goods
    {
        return $this->goodsRepository->find($id, $data);
    }

    /**
     * @param  array  $data
     *
     * @return int
     */
    public function storeGoods(array $data): int
    {
        return $this->createGoodsHandler->handle($data);
    }

    /**
     * @param  array  $data
     * @param  int  $id
     *
     * @return mixed
     */
    public function updateGoods(array $data, Goods $good)
    {
        return $this->goodsRepository->updateFromArray($data, $good);
    }
}
