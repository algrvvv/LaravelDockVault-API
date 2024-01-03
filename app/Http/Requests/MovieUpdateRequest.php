<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MovieUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $method = $this->method();

        if($method === "PUT"){
            return [
                "title"      => ['required', 'string', 'min:3', 'unique:movies'],
                "genre"      => ['required', 'string'],
                "production" => ['required', 'string', 'min:3'],
                "country"    => ['required', 'string'],
                "duration"   => ['required', 'integer'],
                "year"       => ['required', 'date']
            ];
        } else {
            return [
                "title"      => ['sometimes', 'required', 'string', 'min:3', 'unique:movies'],
                "genre"      => ['sometimes', 'required', 'string'],
                "production" => ['sometimes', 'required', 'string', 'min:3'],
                "country"    => ['sometimes', 'required', 'string'],
                "duration"   => ['sometimes', 'required', 'integer'],
                "year"       => ['sometimes', 'required', 'date']
            ];
        }
    }
}
