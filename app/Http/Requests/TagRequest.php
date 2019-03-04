<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Traits\Requests\PreviousPageTrait;
use App\Traits\Requests\JsonApiTrait;

class TagRequest extends FormRequest
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
        return [
            'title' => 'required|unique:tags'.($this->id ? ',title,'.$this->id : ''),
        ];
    }

	/**
	 * Get data to be validated from the request.
	 *
	 * @return array
	 */
	protected function validationData()
	{
		$jsonApiRequest = $this->validationDataJsonApiRequest('tags');

		if ($jsonApiRequest !== null) {
			return $jsonApiRequest;
		}

		$this->filterPreviousPage();

		return parent::validationData();
	}
}
