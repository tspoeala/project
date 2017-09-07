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
        $filterDates = $request->getQuery();
        $params = $this->getCheckedFilters($filterDates);
        list($perPage, $currentPage, $totalPages, $previous, $next) = $this->pagination(
            $request,
            $productRepository->countProductsFiltered($params)
        );
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
        $request->writeToSession('query', $request->giveTheQuery());
        $viewParameters['products'] = $products;
        $request->removeFromSession('errors');
        $characteristicRepository = AppContainer::get('characteristicsRepository');
        $characteristics = $characteristicRepository->join2tablesLike('c.name', 'cp.value', 'characteristics c',
            'products_characteristics cp', 'c.id', 'cp.characteristic_id');
        sort($characteristics);
        $viewParameters['characteristics'] = $characteristics;
        return Response::view('index', $viewParameters);
    }

    public function getCheckedFilters($filterDates)
    {
        $params = [];
        if (!empty($filterDates['price'])) {
            $params['arrayPrices'] = $this->getArrayPrices($filterDates);
        }
        if (!empty($filterDates['nrArzatoare'])) {
            $params['nrArzatoare'] = $filterDates['nrArzatoare'];
        }
        if (!empty($filterDates['alimentarePlita'])) {
            $params['alimentarePlita'] = $filterDates['alimentarePlita'];
        }
        if (!empty($filterDates['culori'])) {
            $params['culori'] = $filterDates['culori'];
        }
        if (!empty($filterDates['aprindereElectrica'])) {
            $params['aprindereElectrica'] = $filterDates['aprindereElectrica'];
        }
        return $params;
    }

    public function getArrayPrices($filterDates)
    {
        $arrayPrices = [];
        $prices = $filterDates['price'];
        foreach ($prices as $key => $price) {
            $explode = explode('-', $price);
            $result = [0 => $explode[0], 1 => $explode[1]];
            $arrayPrices[$key] = $result;
        }
        return $arrayPrices;
    }
}