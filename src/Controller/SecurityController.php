<?php

namespace Src\Controllers;

use App\AppContainer;
use App\Request;
use App\Response;
use Src\Repository\UserRepository;
use Src\Validator\ValidatorRegister;
use Src\Validator\ValidatorLogin;

class SecurityController extends GeneralController
{

    public function login(Request $request)
    {
        if (isset($request->getSession()["user"])) {
            $this->redirect('tableUsers');
        }
        $viewParameters = $request->getSession();
        $viewParameters['pageTitle'] = $this->getTitle("Login");
        return Response::view('login', $viewParameters);
    }

    public function logout(Request $request)
    {
        $request->removeFromSession('email');
        $request->removeFromSession('user');
        $request->removeFromSession('id');
        $this->checkUserAccess($request);
    }

    public function register(Request $request)
    {
        $request->writeToSession('pageTitle', "Register");
        if (isset($request->getSession()["user"])) {
            $this->redirect('tableUsers');
        }
        $response = Response::view('users', $request->getSession());
        if ($request->keyExistsInSession('success')) {
            $request->removeFromSession('formData');
        }
        $request->removeFromSession('errors');
        $request->removeFromSession('success');

        return $response;
    }

    public function insertUserIntoTable($userData)
    {
        AppContainer::get('userRepository')->insertIntoTable([
            'firstname' => $userData['first_name'],
            'lastname' => $userData['last_name'],
            'username' => $userData['display_name'],
            'email' => $userData['email'],
            'password' => $this->encryptPassword($userData['password']),

        ]);
    }

    public function saveUser(Request $request)//saveUser
    {
        $userData = $request->getFormData();
        $errors = (new ValidatorRegister())->validate($userData);
        if (!empty($errors)) {
            $request->writeToSession('errors', $errors);
            $request->writeToSession('formData', $userData);
        } else {
            $this->insertUserIntoTable($userData);
            $request->removeFromSession('errors');
            $request->writeToSession('success', 'User registered!');
        }
        $this->redirect('register');
    }

    public function signIn(Request $request)
    {
        $userData = $request->getFormData();
        $email = $userData['email'];
        /** @var UserRepository $userRepository */
        $userRepository = AppContainer::get('userRepository');
        $errors = (new ValidatorLogin())->validate($userData);
        if (!empty($errors)) {
            $request->writeToSession('errors', $errors);
        }
        $result = $userRepository->selectByFieldFromTable('email', $email);
        if (empty($result)) {
            $request->writeToSession('errors', [" Nu se gasesc in baza de date!"]);
            $this->checkUserAccess($request);
        }
        $user = reset($result);
        $request->writeToSession('email', $email);
        $password = $this->encryptPassword($userData['password']);
        if ($user->password == $password) {
            $request->removeFromSession('errors');
            $request->writeToSession('user', $user);
            $this->redirect('');
        }
        $request->writeToSession('errors', [" Wrong password!"]);
        $this->checkUserAccess($request);
    }

}