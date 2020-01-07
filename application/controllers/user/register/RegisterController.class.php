<?php

class RegisterController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
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
      //var_dump($_POST);
      $users = new UserModel();

      $dataUsers = $users->addUser($_POST);

      //ou j'aurais ou faire juste : $users->addUser($_POST); 


      $http->redirectTo('/user/login');

    	/*
    	 * Méthode appelée en cas de requête HTTP POST
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $formFields contient l'équivalent de $_POST en PHP natif.
    	 */


    }
}
