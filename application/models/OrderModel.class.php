<?php
class OrderModel {

  public function saveOrder($orders, $userId, $totalAmount) {
    $database = new Database();
    $sql = "INSERT INTO `orders` (User_Id, CreationTimestamp) VALUES ( ?, NOW() )";

    $values = [ $userId ];

    $orderId = $database->executeSql($sql, $values);

    foreach($orders as $order) {
      $sql = "INSERT INTO orderline (Quantity_ordered	,Product_Id, Order_Id, PriceEach) VALUES (?, ?, ?, ?)";
      $values = [ $order->quantity, $order->beerId, $orderId, $order->safePrice ];
      $database->executeSql($sql, $values);
    }


    $sql = "UPDATE `orders` SET TotalAmount=?, TaxAmount=?, TaxRate=? WHERE id= ?";

    $taxRate = 20;
    $taxAmount = $totalAmount * $taxRate;


    $database->executeSql($sql, [ $totalAmount, $taxAmount, $taxRate, $orderId  ]);
  }

  public function getAllOrdersByUser($userId) {
    $database = new Database();
    $sql = "SELECT * FROM orders WHERE User_Id=?";
    return $database->query($sql, [ $userId ]);
  }

  public function getAllOrderDetail($id) {
  $database = new Database();

  $sql = "SELECT orderline.Id, Quantity_ordered, PriceEach, Name, Photo
      FROM
        orderline
      INNER join
        beers
      ON
        orderline.Product_Id = beers.Id
      WHERE Order_Id= ? ";

  return $database->query($sql, [$id]);
}

  public function getAllOrders() {
    $database = new Database();
    $sql = 'SELECT * FROM orders';
  return $database->query($sql);
  }

  //public function getUserDetails($userId) {
  //  $database = new Database();
  //  $sql = "SELECT  FirstName, LastName, Email, Product_Id, Quantity_ordered
  //  FROM users
  //  INNER JOIN orders ON users.Id = orders.User_Id
  //  INNER JOIN orderline ON orders.Id = orderline.Order_Id
  //  WHERE Order_Id=?";

  //  return $database->queryOne($sql, [$userId]);
  //}

  public function getUserAdminOrderInfo($id) {
    $database = new Database();

    $sql = "SELECT User_Id FROM orders WHERE Id = ?";

    $user = $database->queryOne($sql, [$id]);

    $sql2 = "SELECT * FROM users WHERE Id = ?";

    return  $database->queryOne($sql2, [ $user['User_Id'] ]);

  }

  public function getTotalAmount($id) {
      $database = new Database();

      $sql = "SELECT TotalAmount FROM orders WHERE Id = ?";

      return $database->queryOne($sql, [$id]);
    }
}
?>
