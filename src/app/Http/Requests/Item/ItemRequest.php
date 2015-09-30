<?php namespace PCI\Http\Requests\Item;

use PCI\Http\Requests\Request;

/**
 * Class ItemRequest
 * @package PCI\Http\Requests\Item
 * @author Alejandro Granadillo <slayerfat@gmail.com>
 * @link https://github.com/slayerfat/sistemaPCI Repositorio en linea.
 */
class ItemRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'item_type_id'    => 'required|numeric',
            'maker_id'        => 'required|numeric',
            'sub_category_id' => 'required|numeric',
            'asoc'            => 'regex:/^[abc]+$/',
            'priority'        => 'numeric|between:1,100',
            'desc'            => 'required|string|between:3,255',
            'stock'           => 'required|numeric|min:0',
            'minimum'         => 'required|numeric|min:0',
        ];
    }
}
