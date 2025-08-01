<?php

return [
    'secure' => 'Неверная подпись. Обновите страницу и повторите запрос',
    'positiveNumber' => 'Значение поля <b>:attribute</b> должно быть больше нуля',
    'notNegativeNumber' => 'Поле <b>:attribute</b> не должно быть отрицательным числом',
    'invalidPhoneNumber' => 'Поле <b>:attribute</b> должно быть валидным номером',
    'subdomain' => 'Поле <b>:attribute</b> должно содержать только английские буквы. Максимальная длина: 20 символов',
    'selectAtLeastOneItem' => 'Выберите хотя бы один элемент',

    'in' => 'Поле <b>:attribute</b>. Допустимые значения: :values',
    'email' => 'Поле <b>:attribute</b> должно быть валидным Email',
    'string' => 'Поле <b>:attribute</b> должно быть строкой',
    'integer' => 'Поле <b>:attribute</b> должно быть целым числом',
    'required' => 'Поле <b>:attribute</b> обязательно для заполнения',
    'confirmed' => 'Введенные пароли не совпадают',
    'digits' => 'Поле <b>:attribute</b> должно содержать :digits цифр',
    'date' => 'Поле <b>:attribute</b> должно быть датой',
    'uuid' => 'Поле <b>:attribute</b> должно валидным UUID',

    'min' => [
        'numeric' => 'Мин значение поля <b>:attribute</b>: :min',
    ],
    'max' => [
        'string' => 'Максимальная длина поля <b>:attribute</b>: :max симв.',
        'file' => 'Максимальный размер файла не должен превышать :max кБ.',
    ],

    'custom' => [
        'firstname' => [
            'required' => 'Введите корректное имя',
        ],
    ],

    // File uploading
    'image' => '<b>:attribute</b> должен быть картинкой',
    'mimes' => '<b>:attribute</b> должен быть одним из указанных типов: :values.',
];
