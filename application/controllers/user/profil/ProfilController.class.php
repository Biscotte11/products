<?php

class ProfilController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP GET
    	 */

        if (empty($_SESSION) == true) {
          $http->redirectTo('/');
        }

        $userModel = new UserModel();
        $profile = $userModel->getOneUser($_SESSION['user']['Id']);

        $orderModel = new OrderModel();
        $orders = $orderModel->getAllOrdersByUser($_SESSION['user']['Id']);

        return [
            "profile"=>$profile,
            "orders"=>$orders
        ];

    }


    public function httpPostMethod(Http $http, array $formFields)
    {

        $userModel = new UserModel();
        $userModel->changeUserProfile($_POST, $_SESSION['user']['id']);

        $http->redirectTo('user/profil');

    }
}
