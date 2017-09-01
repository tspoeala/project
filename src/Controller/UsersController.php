<?php

namespace Src\Controllers;

use App\AppContainer;
use App\Request;
use App\Response;


class UsersController extends GeneralController
{

    public function tableUsers(Request $request)
    {
        $this->checkUserAccess($request);
        $userRepository = AppContainer::get('userRepository');
        list($perPage, $currentPage, $totalPages, $previous, $next) = $this->pagination(
            $request,
            $userRepository->countAll()
        );
        $viewParameters = array_merge($request->getSession(),$this->configPagination($perPage,$currentPage,$totalPages,
            $previous,$next));
        $viewParameters['pageURL'] = '/iMAG/tableUsers';
        $viewParameters['pageTitle'] = 'Users';
        $users = $userRepository->getSubset($perPage * ($currentPage - 1), $perPage);
        $viewParameters['users'] = $users;
        $viewParameters['query'] = $request->giveTheQuery();
        $request->writeToSession('query', $request->giveTheQuery());

        return Response::view('table_with_users', $viewParameters);
    }

    public function viewUser(Request $request)
    {
        $request->writeToSession('pageTitle', "View User");
        if (!empty($request->getSession()["user"])) {
            $id = $request->getQuery()['id'];
            $userRepository = AppContainer::get('userRepository');
            if (!preg_match('/^[0-9]+$/', $id)) {
                $request->writeToSession('errors', ["Id-ul nu este nr !"]);
                $this->redirect('tableUsers');

            }
            $request->removeFromSession('errors');
            $productRepository = AppContainer::get('productRepository');

            list($perPage, $currentPage, $totalPages, $previous, $next) = $this->pagination(
                $request,
                $productRepository->countAllWhereCondition('id_user', $id)
            );
            $viewParameters = array_merge($request->getSession(),$this->configPagination($perPage,$currentPage,$totalPages,
                $previous,$next));
            $viewParameters['pageURL'] = '/iMAG/view?id=' . $id;
            $viewParameters['query'] = $request->giveTheQuery();

            $products = $productRepository->getSubsetCondition('id_user', $id, $perPage * ($currentPage - 1), $perPage);

            $viewParameters['products'] = $products;
            $characteristicsRepository = AppContainer::get('characteristicsRepository');
            $characteristics = $characteristicsRepository->selectAllFromTable();
            $request->writeToSession('characteristics', $characteristics);

            $users = $userRepository->selectByFieldFromTable('id', $id);
            if (!empty($users)) {
                $user = $users[0];
                $viewParameters['userById'] = $user;
                $request->writeToSession('uri', Request::uri());
                $request->writeToSession('query', $request->giveTheQuery());
                return Response::view('view_user', $viewParameters);
            }
            $request->writeToSession('errors', ["Id-ul nu se gaseste in baza de date !"]);

            $this->redirect('tableUsers');
        }
        $this->checkUserAccess($request);
    }

    public function deleteUser(Request $request)
    {
        if (!empty($request->getSession()["user"])) {
            $id = $request->getQuery()['id'];
            $userRepository = AppContainer::get('userRepository');
            $userRepository->deleteFromTable('id', $id);
            $this->redirect('tableUsers?' . $request->getSession()['query']);
        }
        $this->checkUserAccess($request);
    }

    public function updateUser(Request $request)
    {
        if (!empty($request->getSession()["user"])) {
            $id = $request->getQuery()['id'];
            $request->writeToSession('id', $id);
            $request->writeToSession('pageTitle', "Update User");
            $userRepository = AppContainer::get('userRepository');
            if (!preg_match('/^[0-9]+$/', $id)) {
                $request->writeToSession('errors', ["Id-ul nu este numar!"]);
                $this->redirect('tableUsers');
            }
            $request->removeFromSession('errors');
            $users = $userRepository->selectByFieldFromTable('id', $id);
            if (!empty($users)) {
                $userById = $users[0];
                $array = $request->getSession();
                $array['userById'] = $userById;
                return Response::view('update_user', $array);
            }
            $request->writeToSession('errors', ["Id - ul nu este in baza de date"]);
            $this->redirect('tableUsers');
        }
        $this->checkUserAccess($request);
    }

    public function saveUser(Request $request)
    {
        if (!empty($request->getSession()["user"])) {

            $userData = $request->getFormData();

            AppContainer::get('userRepository')->updateTable($request->getSession()['id'], [
                'firstname' => $userData['firstname'],
                'lastname' => $userData['lastname'],
                'username' => $userData['username'],
                'email' => $userData['email']

            ]);
            $this->redirect('tableUsers?' . $request->getSession()['query']);
        }
        $this->checkUserAccess($request);
    }
}