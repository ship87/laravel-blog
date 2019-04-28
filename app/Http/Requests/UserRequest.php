<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Traits\Requests\PreviousPageTrait;
use App\Traits\Requests\JsonApiTrait;

class UserRequest extends FormRequest
{
    use PreviousPageTrait;

    use JsonApiTrait;

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
        $id = $this->id;
        if (empty($id)) {
            $id = $this->route('user');
        }

        return [
            'name' => 'required',
            'email' => 'required|unique:users'.($id ? ',email,'.$id : ''),
        ];
    }

    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    protected function validationData()
    {
        $jsonApiRequest = $this->validationDataJsonApiRequest('users');

        if ($jsonApiRequest !== null) {
            return $jsonApiRequest;
        }

        $this->filterPreviousPage();

        return parent::validationData();
    }
}
