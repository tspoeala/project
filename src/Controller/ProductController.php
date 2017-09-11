<?php

namespace Src\Controllers;

use Src\Repository\ProductCharacteristicsRepository;
use Src\Repository\ProductRepository;
use Src\Validator\ValidatorProduct;
use App\AppContainer;
use App\Request;
use App\Response;

class ProductController extends GeneralController
{
    public function trimProductData($productData)
    {
        $productData['title'] = trim($productData['title']);
        $productData['price'] = trim($productData['price']);
        $productData['description'] = trim($productData['description']);
        return $productData;
    }

    public function insertProductIntoTable($id, $productData, $image)
    {
        AppContainer::get('productRepository')->insertIntoTable([
            'id_user' => $id,
            'title' => $productData['title'],
            'price' => $productData['price'],
            'description' => strip_tags($productData['description']),
            'photo' => $image,
        ]);
    }

    public function insertCharacteristics($characteristics, $value, $productId)
    {
        foreach ($characteristics as $key => $characteristicId) {
            AppContainer::get('productCharacteristicsRepository')->insertIntoTable([
                'product_id' => $productId,
                'characteristic_id' => $characteristicId,
                'value' => ucfirst($value[$key]),
            ]);
        }
    }

    public function updateProductIntoTable($id, $idUser, $productData, $photo)
    {
        AppContainer::get('productRepository')->updateTable($id, [
            'id_user' => $idUser,
            'title' => $productData['title'],
            'price' => $productData['price'],
            'description' => strip_tags($productData['description']),
            'photo' => $photo,

        ]);
    }

    public function getErrorsInSession($request, $errors, $productData, $path)
    {
        if (!empty($errors)) {
            /** @var Request $request */
            $request->writeToSession('errors', $errors);
            $request->writeToSession('productData', $productData);
            $this->redirect($path);
        }
        $request->removeFromSession('productData');
        $request->removeFromSession('errors');
    }

    public function addProduct(Request $request)
    {
        $id = $request->getSession()["user"]->id;
        $productData = $this->trimProductData($request->getFormData());
        $viewParameters = $request->getSession();
        $errors = (new ValidatorProduct())->validate($productData, $request);
        $viewParameters['errors'] = $errors;
        $this->getErrorsInSession($request, $errors, $productData, 'view?id=' . $id);
        $image = $request->getFilesData('photo')["name"];
        $request->writeToSession('image', $image);
        $this->insertProductIntoTable($id, $productData, $image);
        $characteristics = $productData['characteristic'];
        $value = $productData['value'];
        $productId = AppContainer::get('productRepository')
            ->selectColumnFromTable('id_produs', 'title', $productData['title'])[0]['id_produs'];
        $this->insertCharacteristics($characteristics, $value, $productId);
        $products = AppContainer::get('productRepository')->selectByFieldFromTable('id_user', $id);
        $viewParameters['products'] = $products;
        $this->redirect('view?id=' . $id);
    }

    public function updateProduct(Request $request)
    {
        $id = $request->getQuery();
        if (!preg_match('/^[0-9]+$/', $id['id'])) {
            $request->writeToSession('errors', ["Id-ul nu este numar!"]);
            $this->redirect('tableUsers');
        }
        $product = AppContainer::get('productRepository')->selectByFieldFromTable('id_produs', $id['id'])[0];
        if (empty($product)) {
            $request->writeToSession('errors', ["Id - ul nu este in baza de date"]);
            $this->redirect('tableUsers');
        }
        $viewParameters = $request->getSession();
        $viewParameters['product'] = $product;
        $request->writeToSession('product', $product);
        $viewParameters['pageTitle'] = $this->getTitle("Update Product");
        $this->checkUserAccess($request);
        return Response::view('update_product', $viewParameters);
    }

    public function saveProduct(Request $request)
    {
        $idUser = $request->getSession()["user"]->id;
        $id = $request->getSession()['product']->id_produs;
        $photo = null;
        if (!empty($request->getSession()["product"])) {
            $productData = $this->trimProductData($request->getFormData());
            $viewParameters = $request->getSession();
            $photo = $request->getFilesData('photo')['name'];
        }
        if ($photo == null) {
            $photo = $request->getSession()['product']->photo;
            $errors = (new ValidatorProduct())->validateUpdate($productData, $request);
        } else {
            $errors = (new ValidatorProduct())->validate($productData, $request);
        }
        $this->getErrorsInSession($request, $errors, $productData, 'updateProduct?id=' . $id);
        $this->updateProductIntoTable($id, $idUser, $productData, $photo);
        if (strcmp($request->getSession()['uri'], 'iMAG/view') == 0) {
            $this->redirect('view?' . $request->getSession()['query']);
        } else if (strcmp($request->getSession()['uri'], 'iMAG') == 0) {
            $this->redirect('?' . $request->getSession()['query']);
        } else {
            $this->redirect('search?' . $request->getSession()['query']);
        }
        $request->removeFromSession('query');
        $image = $request->getFilesData('photo')["name"];
        $viewParameters['image'] = $image;
        $this->checkUserAccess($request);
    }

    public function viewProduct(Request $request)
    {
        $productId = $request->getQuery()['id'];
        $viewParameters = $request->getSession();
        $viewParameters['pageTitle'] = $this->getTitle("View Product");
        if (!preg_match('/^[0-9]+$/', $productId)) {
            $request->writeToSession('errors', ["Id-ul nu este numar!"]);
            $this->redirect('');
        }
        $product = (AppContainer::get('productRepository')->selectByFieldFromTable('id_produs', $productId))[0];
        if (empty($product)) {
            $request->writeToSession('errors', ["Id-ul nu se gaseste in baza de date !"]);
            $this->redirect('');
        }
        $viewParameters['product'] = $product;
        /**
         * @var ProductCharacteristicsRepository $productCharacteristicsRepository
         */
        $productCharacteristicsRepository = AppContainer::get('productCharacteristicsRepository');
        $characteristics = $productCharacteristicsRepository->getCharacteristics($productId);
        $viewParameters['characteristics'] = $characteristics;
        $userOfProduct = AppContainer::get('productRepository')->getUserOfProduct($productId);
        $viewParameters['userOfProduct'] = $userOfProduct;
        return Response::view('view_product', $viewParameters);
    }

    public function searchProduct(Request $request)
    {
        /** @var ProductRepository $productRepo */
        $productRepo = AppContainer::get('productRepository');
        $titleProductSearch = $request->getQuery()['name'];
        list($perPage, $currentPage, $totalPages, $previous, $next, $offset) = $this->pagination(
            $request,
            $productRepo->countSelectByFieldLikeFromTable('title', "$titleProductSearch%")
        );
        $viewParameters = array_merge($request->getSession(), $this->configPagination($perPage, $currentPage, $totalPages,
            $previous, $next, $this->getTitle("iMAG"), '/iMAG/search?name=' . $titleProductSearch));
        $viewParameters['titleProductSearch'] = $titleProductSearch;
        if (isset($request->getSession()['user'])) {
            $viewParameters['esteLogat'] = 'Este Logat!';
        }
        $request->writeToSession('uri', Request::uri());
        $request->writeToSession('query', $request->giveTheQuery());
        $products = $productRepo->selectByFieldLikeFromTable('title', "$titleProductSearch%", $offset, $perPage);
        $viewParameters['products'] = $products;
        $viewParameters['pageTitle'] = $this->getTitle("Search Product");
        return Response::view('search_product', $viewParameters);
    }
}