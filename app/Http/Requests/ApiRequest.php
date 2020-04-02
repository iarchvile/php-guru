<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiRequest extends FormRequest
{
    const DEFAULT_FIELDS_FOR_INDEX = ['name', 'photo', 'created_at'];
    const DEFAULT_FIELDS_FOR_SHOW = ['name', 'price', 'photo'];

    const PATTERN_FOR_ORDER = '/^(name|price)(,asc|,desc)?$/i';
    const PATTERN_FOR_FIELDS = '/(id|description|photos|price)+/i';

    /**
     * @return array
     */
    public function getApiData()
    {
        return $this->request->all();
    }

    /**
     * @param $data
     * @param  string  $patternFields
     * @param  array  $defaultFields
     */
    public function makeFields(&$data, string $patternFields, array $defaultFields) :void
    {
        if (isset($data['fields'])) {
            preg_match_all($patternFields, $data['fields'], $matches);
            $data['fields'] = array_merge($defaultFields, $matches[1]);
        } else {
            $data['fields'] = $defaultFields;
        }
    }

}
