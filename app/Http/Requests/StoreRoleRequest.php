<?php

namespace App\Http\Requests;

use App\Models\Role;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreRoleRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('role-add'), redirect()->route('unauthorized'));

        return true;
    }

    public function rules()
    {
        return [
            'name'         => [
                'required',
            ],
        ];
    }
}
