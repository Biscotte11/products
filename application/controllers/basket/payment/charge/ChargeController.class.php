<?php

class ChargeController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP GET
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
    	 */

    }

    public function httpPostMethod(Http $http, array $formFields)
    {

        //var_dump($_POST);
        $orders = json_decode($_POST['orders']);
        //var_dump($orders);

        $totalAmount = 0;

        $beerModel = new BeersModel();

        foreach($orders as $order) {
            $oneBeer = $beerModel->getOneBeer($order->beerId);

            $order->safePrice = $oneBeer['SalePrice'];
            $totalAmount += ($order->safePrice*$order->quantity);
        }

        var_dump($orders);
        var_dump($totalAmount);
        $orderModel = new OrderModel();
        $orderModel->saveOrder($orders, $_SESSION['user']['id'], $totalAmount);

    }
}
