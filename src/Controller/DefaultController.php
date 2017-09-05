<?php

namespace Src\Controllers;

use App\AppContainer;
use App\Request;
use App\Response;

class DefaultController extends GeneralController
{
    public function index(Request $request)
    {
        $productRepository = AppContainer::get('productRepository');
        $filterDates = $request->getFormData();
        //unset($filterDates['submit']);
        $params = $this->getCheckedFilters($filterDates);
        list($perPage, $currentPage, $totalPages, $previous, $next) = $this->pagination(
            $request,
            $productRepository->countProductsFiltered($params)
        );
//        list($perPage, $currentPage, $totalPages, $previous, $next) = $this->pagination(
//            $request,
//            $productRepository->countAll()
//        );
        $viewParameters = array_merge($request->getSession(), $this->configPagination($perPage, $currentPage, $totalPages,
            $previous, $next, $this->getTitle("iMAG"), '/iMAG'));
        if (isset($request->getSession()['user'])) {
            $viewParameters['esteLogat'] = 'Este Logat!';
        }
        $offset = $perPage * ($currentPage - 1);
        $products = $productRepository->getProductsFiltered($params, $offset, $perPage);
        $viewParameters['filterDates'] = $filterDates;
        $viewParameters['query'] = $request->giveTheQuery();
        $request->writeToSession('uri', Request::uri());
        $viewParameters['method'] = Request::method();
        //$request->writeToSession('query', $request->giveTheQuery());
        $viewParameters['query'] = $request->giveTheQuery();
        //$offset = $perPage * ($currentPage - 1);
        // $products = $productRepository->getSubsetOrderBy($offset, $perPage);
        $viewParameters['products'] = $products;
        $request->removeFromSession('errors');
        $characteristicRepository = AppContainer::get('characteristicsRepository');
        $characteristics = $characteristicRepository->join2tablesLike('c.name', 'cp.value', 'characteristics c',
            'products_characteristics cp', 'c.id', 'cp.characteristic_id');
        sort($characteristics);
        $viewParameters['characteristics'] = $characteristics;
        return Response::view('index', $viewParameters);
    }

//    public function filters(Request $request)
//    {
//        $productRepository = AppContainer::get('productRepository');
//        $filterDates = $request->getFormData();
//        unset($filterDates['submit']);
////        if (empty($filterDates)) {
////            $this->redirect('');
////        }
//
//        $params = $this->getCheckedFilters($filterDates);
//        list($perPage, $currentPage, $totalPages, $previous, $next) = $this->pagination(
//            $request,
//            $productRepository->countProductsFiltered($params)
//        );
//
//        $viewParameters = array_merge($request->getSession(), $this->configPagination($perPage, $currentPage, $totalPages,
//            $previous, $next, $this->getTitle("Filtrare produse"), '/iMAG'));
//        $offset = $perPage * ($currentPage - 1);
//        $products = $productRepository->getProductsFiltered($params, $offset, $perPage);
//        $viewParameters['filterDates'] = $filterDates;
//        $viewParameters['method'] = Request::method();
//        $viewParameters['query'] = $request->giveTheQuery();
//        $viewParameters['products'] = $products;
//        $characteristicRepository = AppContainer::get('characteristicsRepository');
//        $characteristics = $characteristicRepository->join2tablesLike('c.name', 'cp.value', 'characteristics c',
//            'products_characteristics cp', 'c.id', 'cp.characteristic_id');
//        sort($characteristics);
//        $viewParameters['characteristics'] = $characteristics;
//        return Response::view('filters_products', $viewParameters);//trebuie schimbat cu index
//    }

    public function getCheckedFilters($filterDates)
    {
        $params = [];
        if (!empty($filterDates['price'])) {
            $arrayPrices = [];
            $prices = $filterDates['price'];
            foreach ($prices as $key => $price) {
                $explode = explode('-', $price);
                $result = [0 => $explode[0], 1 => $explode[1]];
                $arrayPrices[$key] = $result;
            }
            $params['arrayPrices'] = $arrayPrices;
        }
        if (!empty($filterDates['nrArzatoare'])) {
            $nrArzatoare = $filterDates['nrArzatoare'];
            $params['nrArzatoare'] = $nrArzatoare;
        }
        if (!empty($filterDates['alimentarePlita'])) {
            $alimentarePlita = $filterDates['alimentarePlita'];
            $params['alimentarePlita'] = $alimentarePlita;
        }
        if (!empty($filterDates['culoare'])) {
            $culori = $filterDates['culoare'];
            $params['culori'] = $culori;
        }
        if (!empty($filterDates['aprindereElectrica'])) {
            $aprindereElectrica = $filterDates['aprindereElectrica'];
            $params['aprindereElectrica'] = $aprindereElectrica;
        }
        return $params;
    }
}