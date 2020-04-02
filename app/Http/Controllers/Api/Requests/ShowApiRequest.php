<?php

namespace App\Http\Controllers\Api\Requests;

use App\Http\Requests\ApiRequest;

class ShowApiRequest extends ApiRequest
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
            'fields' => ['regex:'.self::PATTERN_FOR_FIELDS],
        ];
    }

    /**
     * @return array
     */
    public function getApiData()
    {
        $data = $this->request->all();

        $this->makeFields($data, self::PATTERN_FOR_FIELDS, self::DEFAULT_FIELDS_FOR_SHOW);

        return $data;
    }
}
