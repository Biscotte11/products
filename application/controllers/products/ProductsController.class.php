<?php

class ProductsController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {

      $beerModel = new BeersModel();

      $beers = $beerModel->getAllBeers();


      //var_dump($beers);

      return [
            "beers"=>$beers
        ];
    	/*
    	 * Méthode appelée en cas de requête HTTP GET
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
    	 */

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
