<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationResultRequest extends FormRequest
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
            'reservation' => ['required','after:now'],
            'num-result' => 'required'
        ];
    }

    public function messages()
    {
    return [
        'reservation.required' => '予約時間を入力してください',
        'reservation.after' => '現在時刻以降の予約時間を入力してください',
        'num-result.required' => '予約人数を入力してください',
        ];
    }
}
