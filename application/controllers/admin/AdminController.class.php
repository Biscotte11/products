<?php

class AdminController
{
  public function httpGetMethod(Http $http, array $queryFields)
  {

    if(empty($_SESSION) == true || $_SESSION['user']['role'] !== "admin" ) {
          $http->redirectTo('/');
      }

    $beerModel = new BeersModel();

    $beers = $beerModel->getAllBeers();

    //var_dump($beers);

    $usersAdmin = new UserModel();

    $utilisateurs = $usersAdmin->getAllUsers();


    //var_dump($utilisateurs);
    //var_dump($beers);

    return [
          "beers"=>$beers,
          "utilisateurs"=>$utilisateurs
      ];


    	/*
    	 * Méthode appelée en cas de requête HTTP GET
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
    	 */

        //$test = "je suis un test";

        //return [
                  //  'test'=>$test
              //  ];
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
