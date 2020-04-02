<?php


namespace App\Services\Goods\Repositories;


use App\Models\Goods;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

;

interface GoodsRepositoryInterface
{
    /**
     * @param  array  $data
     *
     * @return LengthAwarePaginator
     */
    public function getAll(array $data) :LengthAwarePaginator;

    /**
     * @param  int  $id
     * @param  array  $data
     *
     * @return Goods
     */
    public function find(int $id, array $data) :Goods;

    /**
     * @param  array  $data
     *
     * @return int
     */
    public function createFromArray(array $data) : int;

    /**
     * @param array $data
     * @param Goods $good
     * @return mixed
     */
    public function updateFromArray(array $data, Goods $good);
}
