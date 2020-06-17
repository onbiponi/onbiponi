<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
		$user = User::find($this->route('user'));

		//return $comment && $this->user()->can('update', $comment);
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
			'photo' => 'nullable|sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
			'email' => 'sometimes|required|email|unique:users,email,'.$this->route('user'),
			'password_old' => 'sometimes|required',
			'password' => ['sometimes', 'required', 'min:6', 'regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/', 'different:password_old', 'confirmed'],
			/*minimum 6 characters and at least one number and one characters; note: minimum 6 characters in regex too. */
			'start_date' => 'sometimes|required|date|after:tomorrow',
			'finish_date' => 'sometimes|required|date|after:start_date'
		];
    }
	
	/**
	 * Get the error messages for the defined validation rules.
	 *
	 * @return array
	 */
	public function messages()
	{
		$messages = [
			'same'    => 'The :attribute and :other must match.',
			'size'    => 'The :attribute must be exactly :size.',
			'between' => 'The :attribute value :input is not between :min - :max.',
			'in'      => 'The :attribute must be one of the following types: :values',
			'email.required' => 'We need to know your e-mail address!',
			'required' => 'The :attribute field is required.',
			'credit_card_number' => 'required_if:payment_type,cc',
			'password.regex' => 'Password must contain at least one letter and one number.',
			'password.min' => 'Password must at least 6 characters long.'
		];
		return $messages;
	}
	
	/**
	 * Get custom attributes for validator errors.
	 *
	 * @return array
	 */
	public function attributes()
	{
		return [
			'email' => 'email address',
		];
	}
}
