<?php

class UserModel {
   public function addUser($post) {

        $hashPassword = $this->hashPassword($post['password']);

        $database = new Database();
        $database->executeSql('INSERT INTO
								users(Email, Password, FirstName, LastName, Role, Address, City, Zip)
							   VALUES
							   (?, ?, ?, ?, "users", ?, ?, ?)',

								[
									$post['email'],
									$hashPassword,
									$post['firstname'],
									$post['lastname'],
                  $post['adresse'],
                  $post['ville'],
                  $post['zip']
								]);

    }


    private function hashPassword($password) {
       $salt = '$2y$11$'.substr(bin2hex(openssl_random_pseudo_bytes(32)), 0, 22);

       return crypt($password, $salt);
   }


    private function verifyPassword($password, $hashedPassword) {
      return crypt($password, $hashedPassword) == $hashedPassword;
 }


    public function connectUser($post) {
           $database = new Database();

   		     $user = $database->queryOne('SELECT * FROM Users WHERE Email =?', [ $post['email'] ]);

   		//var_dump($user);

           if( $user !== false && $this->verifyPassword($post['password'], $user['Password']) == true ) {
           $_SESSION['user']['id'] = $user['Id'];
   			   $_SESSION['user']['email'] = $user['Email'];
   		     $_SESSION['user']['firstname'] = $user['FirstName'];
   			   $_SESSION['user']['lastname'] = $user['LastName'];
           $_SESSION['user']['role'] = $user['Role'];
       	}

        //var_dump($_SESSION);
       }


       public function getAllUsers() {
         $database = new Database();

         $sql = 'SELECT * FROM users';

         return $database->query($sql, []);
       }


       public function changeUserRole($id, $role)
    {
         $database = new Database();

         $sql = 'UPDATE users SET role=? WHERE Id=?';
         $database->executeSql($sql, [$role, $id]);
    }


       public function deleteUser($id) {

          $database = new Database();
          $sql = 'DELETE FROM users WHERE Id= ?';

          $database->executeSql($sql, [$id]);
         }


      public function getOneUser($id) {
        $database = new Database();
        $sql = 'SELECT * FROM users WHERE Id= ?';

        return $database->queryOne($sql, [$id]);
      }


      public function changeUserProfile($post, $id) {
        $database = new Database();
        $sql = 'UPDATE users SET FirstName=?, LastName=?, Email=?, Address=?, City=?, Zip=? WHERE Id = ?';

        $database->executeSql($sql,
                              [$post['firstname'],
                              $post['lastname'],
                              $post['email'],
                              $post['address'],
                              $post['city'],
                              $post['zip'],
                              $id]);
      }
}
