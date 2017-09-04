<?php

namespace Src\Controllers;

use App\Response;
use App\Request;

class GeneralController
{
    protected $titlePage = [];

    protected function redirect($route)
    {
        $response = new Response();

        $response->redirect($route);
    }

    protected function checkUserAccess(Request $request)
    {
        if (empty($request->getSession()["user"])) {

            $this->redirect('login');
        }
    }

    /**
     * @param $password
     * @return bool|string
     */
    public function encryptPassword($password)
    {
        return md5($password);
    }

    protected function getTitle($title="Im awesome!")
    {
        return $title;
    }

    /**
     * @param Request $request
     * @param $total
     * @return array
     */
    protected function pagination(Request $request, $total)
    {
        $perPage = 6;
        $totalPages = ceil($total / $perPage);
        $currentPage = 1;
        $query = $request->getQuery();
        if (!empty($query['page'])) {
            $currentPage = intval($query['page']);
            if ($currentPage <= 0 || $currentPage > $totalPages) {
                $currentPage = 1;
            }
        }

        $previous = 1;
        $next = $totalPages;
        if ($currentPage > 1) {
            $previous = $currentPage - 1;
        }
        if ($currentPage < $totalPages) {
            $next = $currentPage + 1;
        }
        return array($perPage, $currentPage, $totalPages, $previous, $next);
    }

    public function configPagination($perPage,$currentPage,$totalPages,$previous,$next)
    {
        $viewParameters['perPage'] = $perPage;
        $viewParameters['currentPage'] = $currentPage;
        $viewParameters['totalPages'] = $totalPages;
        $viewParameters['previous'] = $previous;
        $viewParameters['next'] = $next;
        return $viewParameters;

    }

}
