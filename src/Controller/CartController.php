<?php

namespace Src\Controllers;

use App\AppContainer;
use App\Request;
use Src\Repository\ProductRepository;
use App\Response;

class CartController
{
    public function add(Request $request)
    {
        if (!isset($request->getFormData()['id'])) {
            return;
        }
        $id = $request->getFormData()['id'];
        $cart = [];
        $user = $request->getSession()['user'];
        if (isset($request->getSession()['cart'])) {
            $cart = $request->getSession()['cart'];
        }
        if (!in_array($id, $cart)) {
            $cart[] = $id;
        }
        $request->writeToSession('cart', $cart);
        $array['products'] = $cart;
        $array['totalProducts'] = count($cart);
        $array['user'] = $user;
        $request->writeToSession('totalProducts', count($cart));
        echo json_encode($array);
    }

    public function removeFromCart(Request $request)
    {
        $id = $request->getFormData()['id'];
        $totalPrice = 0;
        $cart = $request->getSession()['cart'];
        foreach (array_keys($cart, $id) as $key) {
            unset($cart[$key]);
        }
        $request->writeToSession('cart', $cart);
        $request->writeToSession('totalProducts', count($cart));
        $productRepo = AppContainer::get('productRepository');
        foreach ($cart as $idCart) {
            $product = $productRepo->selectByFieldFromTable('id_produs', $idCart)[0];
            $totalPrice += $product->price;
        }
        $request->writeToSession('totalPrice', $totalPrice);
        $array['totalPrice'] = $totalPrice;
        $array['products'] = $cart;
        $array['totalProducts'] = count($cart);
        echo json_encode($array);
    }

    public function viewCart(Request $request)
    {
        $viewParameters = $request->getSession();
        $viewParameters['pageTitle'] = 'View Cart';
        if (array_key_exists('cart', $viewParameters)) {
            $cart = $viewParameters['cart'];
        }
        /** @var ProductRepository $productRepo */
        $productRepo = AppContainer::get('productRepository');
        $products = [];
        if (!empty($cart)) {
            foreach ($cart as $idCart) {
                $product = $productRepo->selectByFieldFromTable('id_produs', $idCart)[0];
                $products[] = $product;
            }
            $viewParameters['products'] = $products;
        }
        return Response::view('view_cart', $viewParameters);
    }
}