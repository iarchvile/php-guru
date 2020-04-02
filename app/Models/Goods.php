<?php

namespace App\Models;

use App\Events\SaveGoodsEvent;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Goods
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property float $price
 * @property array $photo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Goods newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Goods newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Goods query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Goods whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Goods whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Goods whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Goods whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Goods wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Goods wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Goods whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Goods extends Model
{

    const GOODS_PER_PAGE = 10;

    protected $hidden = ['created_at'];

    protected $fillable = [
        'name',
        'description',
        'photo',
        'photos',
        'price',
    ];

    protected $dispatchesEvents = [
        'saved' => SaveGoodsEvent::class,
    ];

    protected $casts = [
        'photos' => 'array',
        'created_at' => 'data',
    ];
}
