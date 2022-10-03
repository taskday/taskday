<?php

namespace Taskday\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Taskday\Models\Entry;

class StoreEntryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Entry::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'content' => 'nullable',
            'board_id' => 'required',
            'fields' => 'nullable'
        ];
    }
}
