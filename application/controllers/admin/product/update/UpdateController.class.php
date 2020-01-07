<?php

class UpdateController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {

      if(empty($_SESSION) == true || array_key_exists('user', $_SESSION)== false || $_SESSION['user']['role'] !== "admin" ) {
              $http->redirectTo('/');
          }


      $id = $_GET['id'];
    

      $beerModel = new BeersModel();
      $oneBeer = $beerModel->getOneBeer($id);

      return [
        'oneBeer'=>$oneBeer
      ];


      //$beerModel = new BeersModel();

      //$updates = $beerModel->updateBeer($_GET);

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
      $url = 'application/www/images/beers/';
      $fileName = $_FILES['beer_pict']['name'];
      $id = $_POST['beerId'];

      $beerModel = new BeersModel();
      $oneBeer = $beerModel->getOneBeer($id);

      //var_dump($oneBeer);
      //var_dump($_POST);
      //var_dump($_FILES);

      if ($_FILES['beer_pict']['size'] > 0 ) {
            $http->moveUploadedFile('beer_pict', '/images/beers');
            //unlink($url.$oneBeer['Photo']);
        } else {
            $fileName = $oneBeer['Photo'];
        };

      $beerModel->updateBeer($id, $_POST, $fileName);
      $http->redirectTo('/admin');



      return [
        'oneBeer'=>$oneBeer
      ];

    	/*
    	 * Méthode appelée en cas de requête HTTP POST
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $formFields contient l'équivalent de $_POST en PHP natif.
    	 */


    }
}
