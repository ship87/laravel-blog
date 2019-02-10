<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Traits\FilterRelationsTrait;
use App\Traits\PreviousPageTrait;

class PostRequest extends FormRequest
{
    use PreviousPageTrait;

    use FilterRelationsTrait;

    protected $filterRelations = [
        'seotitle',
        'seodescription',
        'seokeywords',
        'categories',
        'tags',
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
        return [//
        ];
    }

    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    protected function validationData()
    {
        $this->filterPreviousPage();

        $this->filterRelations();

        return parent::validationData();
    }
}
