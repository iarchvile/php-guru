<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Requests\ShowApiRequest;
use App\Http\Controllers\Api\Requests\StoreApiRequest;
use App\Http\Controllers\Api\Requests\UpdateApiRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\Requests\IndexApiRequest;
use App\Http\Resources\Goods as GoodsResource;
use App\Http\Resources\GoodsCollection;
use App\Models\Goods;
use App\Services\Goods\GoodsService;

class GoodsController extends Controller
{

    /**
     * @param  IndexApiRequest  $request
     * @param  GoodsService  $goodsService
     *
     * @return GoodsCollection
     */
    public function index(IndexApiRequest $request, GoodsService $goodsService)
    {
        $data = $request->getApiData();

        return new GoodsCollection($goodsService->getAll($data));
    }

    /**
     * @param  ShowApiRequest  $request
     * @param  GoodsService  $goodsService
     * @param $id
     *
     * @return GoodsResource
     */
    public function show(ShowApiRequest $request, GoodsService $goodsService, $id)
    {
        $data = $request->getApiData();

        return new GoodsResource($goodsService->find($id, $data['fields']));
    }

    /**
     * @param  StoreApiRequest  $request
     * @param  GoodsService  $goodsService
     *
     * @return array
     */
    public function store(StoreApiRequest $request, GoodsService $goodsService)
    {
        $data = $request->getApiData();

        return [
            'id' => $goodsService->storeGoods($data),
            'status' => 200,
        ];
    }

    /**
     * @param  UpdateApiRequest  $request
     * @param  GoodsService  $goodsService
     * @param  Goods  $good
     *
     * @return array
     */
    public function update(UpdateApiRequest $request, GoodsService $goodsService, Goods $good)
    {
        $data = $request->getApiData();

        $goodsService->updateGoods($data, $good);

        return [
            'id' => $good->id,
            'status' => 200,
        ];
    }

}
