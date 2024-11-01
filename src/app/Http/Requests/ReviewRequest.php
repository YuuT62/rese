<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'score' => ['required'],
            'comment' => ['max:400'],
            'review_img' => ['image','mimes:png,jpg,jpeg'],
        ];
    }

    public function messages(){
        return[
            'score.required' => '評価は必ず入力してください',
            'comment.max' => '口コミの最高文字数は400文字です',
            'review_img.image' => '画像ファイルを追加してください',
            'review_img.mimes' => 'アップロードできる画像ファイルの拡張子は「jpg」、「png」のみです',
        ];
    }
}
