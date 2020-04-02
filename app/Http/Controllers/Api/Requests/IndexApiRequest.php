<?php

namespace App\Http\Controllers\Api\Requests;

use App\Http\Requests\ApiRequest;

class IndexApiRequest extends ApiRequest
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
            'order' => ['regex:'.self::PATTERN_FOR_ORDER],
            'fields' => ['regex:'.self::PATTERN_FOR_FIELDS],
            'per_page' => 'numeric|min:3|max:100',
        ];
    }

    /**
     * @return array
     */
    public function getApiData()
    {
        $data = $this->request->all();

        if (isset($data['order'])) {
            $data['order'] = explode(',', $data['order']);
        }

        $this->makeFields($data, self::PATTERN_FOR_FIELDS, self::DEFAULT_FIELDS_FOR_INDEX);

        return $data;
    }
}
