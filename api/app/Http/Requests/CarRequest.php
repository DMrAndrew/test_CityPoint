<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class CarRequest extends FormRequest
{
    protected $field = 'data';
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
        $rules = [
            $this->field => [
                'RegNumber' => 'required|string|regex:/^[a-zA-Z0-9]+$/|size:6',
                'VIN' => 'required|digits:17',
                'Model' => 'sometimes|nullable|string|max:200',
                'Brand' => 'sometimes|nullable|string|max:200',
            ]
        ];

        return array_merge([$this->field => 'required'], Arr::dot($rules));
    }

    public function messages()
    {
        $messages = [
            $this->field => [
                'required' => 'Данные должны быть представлены в поле '.$this->field,
                'RegNumber' => [
                    'required' => 'Гос. номер обязателен',
                    'regex' => 'Гос. номер может состоять только из латинских букв и цифр',
                    'size' => 'Гос. номер должен состоять из 6 символов',
                ],
                'VIN' => [
                    'required' => 'VIN номер обязателен',
                    'digits' => 'VIN номер должен состоять из 17 цифр',
                ],
                'Model' => [
                    'string' => 'Модель должна быть строкой',
                    'max' => 'Максимальная длина модели авто 200 символов',
                ],
                'Brand' => [
                    'string' => 'Марка должна быть строкой',
                    'max' => 'Максимальная длина марки авто 200 символов',
                ]
            ]
        ];
        return array_merge(parent::messages(), Arr::dot($messages));
    }

    public function validated()
    {
        return parent::validated()[$this->field];
    }

}
