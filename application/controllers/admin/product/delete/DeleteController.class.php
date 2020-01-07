<?php

class DeleteController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {

      if(empty($_SESSION) == true || $_SESSION['user']['role'] !== "admin" ) {
            $http->redirectTo('/');
          }

        $id = $_GET['id'];
        $url = 'application/www/images/beers/';

        $beerModel = new BeersModel();
        $beer = $beerModel->getOneBeer($id);

        if (file_exists ( $url.$oneBeer['Photo'])) {
             //unlink($url.$beer['Photo']);
        }

        $beerModel->deleteBeer($id);

        $http->redirectTo('/admin');


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
