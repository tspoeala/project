<?php

namespace Src\Validator;

class Validator
{
    private $errors = [];


    public function validate($formData)
    {
        if ($formData['password'] != $formData['password_confirmation']) {
            $this->errors['password'] = "Pass should match!";
        }

        if (!ctype_alpha($formData['first_name'])) {
            $this->errors['first_name'] = "Firstname should contain only letters!";
        }
        if (!ctype_alpha($formData['last_name'])) {
            $this->errors['last_name'] = "Lastname should contain only letters!";
        }

        if (!preg_match('/^[A-Za-z0-9]+$/', $formData['display_name'])) {
            $this->errors['display_name'] = "Username should contain letters, numbers and _ or - !";
        }
        if (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = "Email should have a form!";
        }

        return $this->errors;
    }
}
