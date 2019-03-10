<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Traits\Requests\PreviousPageTrait;
use App\Traits\Requests\FilterRelationsTrait;
use App\Traits\Requests\JsonApiTrait;

class RoleRequest extends FormRequest
{
    use PreviousPageTrait;

    use FilterRelationsTrait;

    use JsonApiTrait;

    protected $filterRelations = [
        'permissions',
    ];

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
            $id = $this->route('role');
        }

        return [
            'title' => 'required|unique:roles'.($id ? ',title,'.$id : ''),
        ];
    }

    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    protected function validationData()
    {
        $jsonApiRequest = $this->validationDataJsonApiRequest('posts');

        if ($jsonApiRequest !== null) {
            return $jsonApiRequest;
        }

        $this->filterPreviousPage();

        $this->filterRelations();

        return parent::validationData();
    }
}
