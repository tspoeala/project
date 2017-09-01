<?php

namespace Src\Validator;


class ValidatorRegister
{
    private $errors = [];


    public function validatePasswords($formData)
    {
        if ($formData['password'] != $formData['password_confirmation']) {
            $this->errors['password'] = "Pass should match!";
        }
    }

    public function validateFirstname($formData)
    {
        if (!ctype_alpha($formData['first_name'])) {
            $this->errors['first_name'] = "Firstname should contain only letters!";
        }
    }

    public function validateLastname($formData)
    {
        if (!ctype_alpha($formData['last_name'])) {
            $this->errors['last_name'] = "Lastname should contain only letters!";
        }
    }

    public function validateDisplayname($formData)
    {
        if (!preg_match('/^[A-Za-z0-9]+$/', $formData['display_name'])) {
            $this->errors['display_name'] = "Username should contain letters, numbers and _ or - !";
        }
    }

    public function validateEmail($formData)
    {
        if (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Email should have a form!";
        }
    }

    public function validate($formData)
    {
        $this->validatePasswords($formData);

        $this->validateFirstname($formData);

        $this->validateLastname($formData);

        $this->validateDisplayname($formData);

        $this->validateEmail($formData);

        return $this->errors;
    }
}

