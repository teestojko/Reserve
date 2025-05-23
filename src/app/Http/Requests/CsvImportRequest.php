<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CsvImportRequest extends FormRequest
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
            'csv_file' => 'required|file|mimes:csv,txt',
        ];
    }

    public function messages()
    {
        return [
            'csv_file.required' => 'CSVファイルは必須です。',
            'csv_file.file' => 'アップロードされたファイルは無効です。再度ファイルを選択してください。',
            'csv_file.mimes' => 'CSVまたはテキストファイルのみが許可されています。',
        ];
    }
}


