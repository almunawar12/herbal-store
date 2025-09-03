<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'address' => ['required', 'min:5', 'max:255'],
            'district' => 'required',
            'province' => 'required',
            'postal_code' => 'required',
            'phone' => 'required',
        ];
    }

    /**
     * Get the custom error messages for the validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'address.required' => 'Alamat harus diisi lengkap',
            'address.min' => 'Alamat harus diisi lengkap',
            'district.required' => 'Kecamatan harus diisi',
            'province.required' => 'Provinsi harus diisi',
            'postal_code.required' => 'Kode pos harus diisi',
        ];
    }
}
