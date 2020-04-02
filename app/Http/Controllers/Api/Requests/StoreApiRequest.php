<?php

namespace App\Http\Controllers\Api\Requests;

use App\Http\Requests\ApiRequest;
use App\Models\Goods;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class StoreApiRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:200',
            'description' => 'max:1000',
            'price' => 'numeric|gt:0|max:999999999.99',
            'photos' => 'array|min:1|max:3',
            'photos.*' => 'url',
        ];
    }

    /**
     * @return array
     */
    public function getApiData()
    {
        $data = $this->request->all();

        if (isset($data['photos'])) {
            $data['photo'] = array_shift($data['photos']);
        }

        return $data;
    }

    /**
     * @param Validator $validator
     */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['status' => 422], 422));
    }

}
