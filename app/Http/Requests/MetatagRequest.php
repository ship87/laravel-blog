<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use App\Traits\Requests\PreviousPageTrait;
use App\Traits\Requests\JsonApiTrait;

class MetatagRequest extends FormRequest
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
			'page_id.name' => [
				'required',
				Rule::unique('metatags')->where(function ($query) use($this->page_id,$this->name) {
					return $query->where('page_id', $this->page_id)->where('name', $this->name);
				}),
			]
		];
	}

	/**
	 * Get data to be validated from the request.
	 *
	 * @return array
	 */
	protected function validationData()
	{
		$jsonApiRequest = $this->validationDataJsonApiRequest('metatags');

		if ($jsonApiRequest !== null) {
			return $jsonApiRequest;
		}

		$this->filterPreviousPage();

		return parent::validationData();
	}
}
