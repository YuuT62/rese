<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CSVRequest extends FormRequest
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
            'csv_file' => ['required','file','mimes:csv'],
        ];
    }

    public function messages(){
        return[
            'csv_file.required' => "ファイルが選択されていません。",
            'csv_file.file' => '画像ファイルを追加してください',
            'csv_file.mimes' => 'アップロードできる画像ファイルの拡張子は「csv」のみです',
        ];
    }
}
