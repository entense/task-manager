<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class BaseRequest extends FormRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $json = [
            'success' => false,
            'message' => 'Validation errors',
            'data' => $validator->errors()
        ];

        throw new HttpResponseException(response()->json($json, Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
