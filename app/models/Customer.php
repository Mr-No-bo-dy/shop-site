<?php 
   namespace app\models;
   
   use app\vendor\BaseModel;

   class Customer extends BaseModel
   {
      protected $dataBaseName = 'shop_db';
      public $table = 'customers';
      public $primaryKey = 'id_customer';
      public $fields = ['id_customer', 'id_status', 'first_name', 'last_name', 'phone', 'email', 'login'];

      // Add customer into DB
      public function saveCustomer(array $postData)
      {
         // Altering customer's postData
         $postData['password'] = password_hash($postData['password'], PASSWORD_BCRYPT, ['cost' => 12]);
         $postData['last_name'] = ucfirst(trim($postData['last_name']));
         $postData['first_name'] = ucfirst(trim($postData['first_name']));

         $this->insert($postData);
      }

      public function loginCustomer(array $postData)
      {
         $errors = [];
         if (empty($postData['login']) || empty($postData['password'])) {
            foreach ($postData as $key => $val) {
               if (empty($val)) {
                  $errors[$key]['check'] = true;
                  $errors[$key]['desc'] = 'Це поле є обов\'язковим для заповнення';
               }
            }
         } else {
            // Чистка форм-інпутів:
            $postData['login'] = preg_replace('#[^a-zA-Z0-9_-]#', '', strip_tags($postData['login']));
            $postData['password'] = preg_replace('#[^a-zA-Z0-9_-]#', '', strip_tags($postData['password']));

            // Get data from DB
            $connection = $this->builder();
            $stmt = $connection->prepare('SELECT login FROM ' . $this->dataBaseName . '.customers WHERE login = :login');
            $stmt->bindParam(':login', $postData['login']);
            $stmt->execute();
            $dbLogin = $stmt->fetchColumn();

            if ($postData['login'] === $dbLogin) {
               $stmt = $connection->prepare('SELECT password FROM ' . $this->dataBaseName . '.customers WHERE login = :login');
               $stmt->bindParam(':login', $postData['login']);
               $stmt->execute();
               $dbPassword = $stmt->fetchColumn();
               if (password_verify($postData['password'], $dbPassword)) {
                  // Save customer's ID into $_SESSION
                  $stmt = $connection->prepare('SELECT id_customer FROM ' . $this->dataBaseName . '.customers WHERE login = :login');
                  $stmt->bindParam(':login', $postData['login']);
                  $stmt->execute();
                  $dbIdCustomer = $stmt->fetchColumn();
                  $_SESSION['customer']['id_customer'] = $dbIdCustomer;
                  $_SESSION['customer']['login'] = $dbLogin;
                  
               } else {
                  $errors['login']['check'] = true;
                  $errors['password']['check'] = true;
                  $errors['login_pass']['desc'] = 'Неправильний Нікнейм або Пароль';
               }
            } else {
               $errors['login']['check'] = true;
               $errors['password']['check'] = true;
               $errors['login_pass']['desc'] = 'Неправильний Нікнейм або Пароль';
            }
         }

         return $errors;
      }
   }
?>