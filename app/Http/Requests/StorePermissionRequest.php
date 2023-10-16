<?php

namespace App\Http\Requests;


use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StorePermissionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('permission-add'), redirect()->route('unauthorized'));

        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
            ],
        ];
    }
}
