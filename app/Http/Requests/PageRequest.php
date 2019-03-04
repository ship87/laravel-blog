<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Traits\Requests\FilterRelationsTrait;
use App\Traits\Requests\PreviousPageTrait;
use App\Traits\Requests\JsonApiTrait;

class PageRequest extends FormRequest
{
    use PreviousPageTrait;

    use FilterRelationsTrait;

    use JsonApiTrait;

    protected $filterRelations = [
        'seotitle',
        'seodescription',
        'seokeywords',
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
        $rules = [
            'title' => 'required',
            'slug' => 'required|unique:posts'.($this->id ? ',slug,'.$this->id : ''),
            'content' => 'required',
        ];

        $isJsonApi = $this->isJsonApiRequest();

        if (config('app.comment_google_recaptcha') && ! $isJsonApi) {
            $rules['g-recaptcha-response'] = 'required|recaptcha';
        }

        return $rules;
    }

    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    protected function validationData()
    {
        $jsonApiRequest = $this->validationDataJsonApiRequest('pages');

        if ($jsonApiRequest !== null) {
            return $jsonApiRequest;
        }

        $this->filterPreviousPage();

        $this->filterRelations();

        return parent::validationData();
    }
}
