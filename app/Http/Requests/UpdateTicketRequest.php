<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\TicketStatus;

class UpdateTicketRequest extends FormRequest
{
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
            'title'       => ['string', 'max:255'],
            'discription' => ['string'],
            'status'      => ['string', Rule::in(array_column(TicketStatus::cases(), 'value'))],
            'attachment'  => ['sometimes', 'file', 'mimes:jpg,jpeg,png,pdf'],
        ];
    }
}
