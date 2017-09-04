<?php

namespace Src\Controllers;

use Src\Repository\ProductRepository;
use Src\Validator\ValidatorProduct;
use App\AppContainer;
use App\Request;
use App\Response;

class ProductController extends GeneralController
{
    public function addProduct(Request $request)
    {
        $id = $request->getSession()["user"]->id;
        $productData = $request->getFormData();
        $viewParameters = $request->getSession();
        $productData['title'] = trim($productData['title']);
        $productData['price'] = trim($productData['price']);
        $productData['description'] = trim($productData['description']);
        $errors = (new ValidatorProduct())->validate($productData, $request);
        $viewParameters['errors'] = $errors;
        if (empty($errors)) {
            $request->removeFromSession('productData');
            $image = $request->getFilesData('photo')["name"];
            $request->writeToSession('image', $image);
            AppContainer::get('productRepository')->insertIntoTable([
                'id_user' => $id,
                'title' => $productData['title'],
                'price' => $productData['price'],
                'description' => strip_tags($productData['description']),
                'photo' => $image,

            ]);
            $characteristics = $productData['characteristic'];
            $value = $productData['value'];
            $productId = AppContainer::get('productRepository')
                ->selectColumnFromTable('id_produs', 'title', $productData['title'])[0]['id_produs'];

            foreach ($characteristics as $key => $characteristicId) {
                AppContainer::get('productCharacteristicsRepository')->insertIntoTable([
                    'product_id' => $productId,
                    'characteristic_id' => $characteristicId,
                    'value' => ucfirst($value[$key]),
                ]);
            }
        } else {
            $request->writeToSession('errors', $errors);
            $request->writeToSession('productData', $productData);
        }
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
        if (!empty($request->getSession()["product"])) {
            $productData = $request->getFormData();
            $viewParameters = $request->getSession();
            $productData['title'] = trim($productData['title']);
            $productData['price'] = trim($productData['price']);
            $productData['description'] = trim($productData['description']);
            $pos = strpos(Request::uri(), "updateProduct");
            $photo = $request->getFilesData('photo')['name'];
            if ($photo != null || $pos != false) {
                $errors = (new ValidatorProduct())->validate($productData, $request);
            }
            if ($photo == null && $pos != false) {
                $photo = $request->getSession()['product']->photo;
                $errors = (new ValidatorProduct())->validateUpdate($productData, $request);
            }

            if (empty($errors)) {
                AppContainer::get('productRepository')->updateTable($id, [
                    'id_user' => $idUser,
                    'title' => $productData['title'],
                    'price' => $productData['price'],
                    'description' => strip_tags($productData['description']),
                    'photo' => $photo,

                ]);

                $request->removeFromSession('errors');
                if (strcmp($request->getSession()['uri'], 'iMAG/view') == 0) {
                    $this->redirect('view?' . $request->getSession()['query']);
                }
                if (strcmp($request->getSession()['uri'], 'iMAG') == 0) {
                    $this->redirect('?' . $request->getSession()['query']);
                }


                $request->removeFromSession('query');
                $image = $request->getFilesData('photo')["name"];
                $viewParameters['image'] = $image;

            } else {
                $request->writeToSession('errors', $errors);
                $request->writeToSession('formData', $productData);
                $this->redirect('updateProduct?id=' . $id);
            }

            $this->checkUserAccess($request);
        }
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
        $productCharacteristicsRepository = AppContainer::get('productCharacteristicsRepository');
        $characteristics = $productCharacteristicsRepository->join3tables('characteristics.name', 'products_characteristics.value',
            'characteristics', 'products_characteristics', 'products', 'characteristics.id',
            'products_characteristics.characteristic_id', 'products_characteristics.product_id', 'products.id_produs', 'id_produs', $productId);
        $viewParameters['characteristics'] = $characteristics;
        $userOfProduct = AppContainer::get('productRepository')->join2tables('users.username', 'users.firstname', 'users', 'products', 'users.id',
            'products.id_user', 'id_produs', $productId)[0];
        $viewParameters['userOfProduct'] = $userOfProduct;

        return Response::view('view_product', $viewParameters);
    }

    public function searchProduct(Request $request)
    {
        $viewParameters = $request->getSession();
        $titleProductSearch = $request->getQuery()['name'];
        $viewParameters['titleProductSearch'] = $titleProductSearch;
        /** @var ProductRepository $productRepo */
        $productRepo = AppContainer::get('productRepository');
        $products = $productRepo->selectByFieldLikeFromTable('title', "$titleProductSearch%");
        $viewParameters['products'] = $products;
        $viewParameters['pageTitle'] = $this->getTitle("Search Product");
        return Response::view('search_product', $viewParameters);
    }
}