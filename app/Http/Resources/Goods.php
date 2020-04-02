<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Goods extends JsonResource
{

    public function toArray($request)
    {
        $photos = $this->photos ?? null;

        if (isset($photos)) {
            array_unshift($photos, $this->photo);
        };

        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'photo' => $this->photos ? null : $this->photo,
            'photos' => $photos,
            'created_at' => $this->created_at,
        ];

        $data = collect($data)->filter()->all();

        return $data;
    }
}
