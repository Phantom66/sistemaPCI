<?php namespace PCI\Http\Requests\Aux;

class SubCategoryRequest extends AbstractAuxRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'desc' => 'required|string|max:255|unique:sub_categories'
        ];
    }
}