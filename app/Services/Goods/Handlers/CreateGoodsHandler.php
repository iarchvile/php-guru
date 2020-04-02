<?php


namespace App\Services\Goods\Handlers;


use App\Models\Goods;
use App\Services\Goods\Repositories\GoodsRepositoryInterface;

class CreateGoodsHandler
{
    private GoodsRepositoryInterface $goodsRepository;

    public function __construct(GoodsRepositoryInterface $goodsRepository)
    {
        $this->goodsRepository = $goodsRepository;
    }

    public function handle(array $data)
    {
        return $this->goodsRepository->createFromArray($data);
    }
}