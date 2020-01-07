<?php

class DetailsController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP GET
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
    	 */
     if(empty($_SESSION) == true || $_SESSION['user']['role'] !== "admin" ) {
           $http->redirectTo('/');
       }

       $id= $_GET['id'];

       $orderModel = new OrderModel() ;
       $orderdetail = $orderModel->getAllOrderDetail($id);
       
       $user = $orderModel->getUserAdminOrderInfo($id);
       $order = $orderModel->getTotalAmount($id);
       $totalAmount = $order['TotalAmount'];
       //var_dump($orderdetail);
      // var_dump($user);
      // var_dump($totalAmount);

       return [
                   "user"=>$user,
                   'orderdetail'=>$orderdetail,
                   'totalAmount'=>$totalAmount
               ];

    }

    public function httpPostMethod(Http $http, array $formFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP POST
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $formFields contient l'équivalent de $_POST en PHP natif.
    	 */


    }
}
