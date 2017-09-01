<?php


namespace Src\Validator;


class ValidatorLogin
{
    private $errors = [];

    public function validateEmail($formData)
    {
        if (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Email is incorrect!";
        }
    }

    public function validatePassword($formData)
    {
        if (empty($formData['password'])) {
            $this->errors['password'] = "Empty password!";
        }
    }

    public function validate($formData)
    {
        $this->validateEmail($formData);

        $this->validatePassword($formData);

        return $this->errors;
    }
}