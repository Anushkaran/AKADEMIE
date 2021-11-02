<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ResourceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Auth::guard('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules  =  [
            'name'   => 'required|string|max:200',
            'type'   => 'required|integer|in:1,2',
            'access' => $this->getRuleForAccess(),
            'file'   => $this->getRuleForFile(),
        ];

        if ($this->method() === "PUT")
        {
            unset($rules['type'],$rules['file']);

        }

        return $rules;
    }

    private function getRuleForFile()
    {
        $type = (int)$this->input('type');

        if ($type === 1){
            return 'required|mimetypes:application/pdf|max:3000';
        }

        if ($type === 2)
        {
            return 'required|mimes:ppt,pptx,docx,doc|max:3000';
        }

        return  '';
    }

    private function getRuleForAccess()
    {
        $type = (int)$this->input('type');

        if ($type === 1){
            return 'required|integer|in:1,2';
        }

        if ($type === 2)
        {
            return 'required|integer|in:2';
        }

        return  '';
    }
}
