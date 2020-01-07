<?php

class BeersModel {
  public function getAllBeers() {

    $database = new Database();

    $sql = 'SELECT * FROM beers';

    return $database->query($sql, []);


  }


  public function getOneBeer($id) {
    $database = new Database();

    $sql = 'SELECT
    *
    FROM beers
    WHERE Id=?';

    return $database->queryOne($sql, [$id]);
  }



  public function addBeer($post, $name) {
    $database = new Database();

    $sql = 'INSERT INTO beers (Name, Photo, Description, QuantityInStock, BuyPrice, SalePrice) VALUES (?, ?, ?, ?, ?, ?)';

    $database->executeSql($sql, [ $post['name'],$name, $post['description'], $post['quantity'], $post['buyprice'], $post['saleprice'] ]);

  }

  //$quantity = intval($_POST['quantity']);
  //$buyPrice = intval($_POST['buyprice']);
  //$salePrice = intval($_POST['saleprice']);


  public function updateBeer($id, $post, $photo) {
    //var_dump($id);
    //var_dump($post);
    //var_dump($photo);

    $database = new Database();
    $sql = 'UPDATE beers SET Name=?, Photo=?, Description=?, QuantityInStock=?, BuyPrice=?, SalePrice=?
    WHERE Id = ?'
    ;

    $database->executeSql($sql,[ $post['name'], $photo, $post['description'], intval($post['quantity']), floatval($post['buyprice']), floatval($post['saleprice']), $id ]);

  }

    public function deleteBeer($id) {

       $database = new Database();

       $sql = 'DELETE FROM beers WHERE Id=?';

       $database->executeSql($sql, [ $id ]);


   }

}
