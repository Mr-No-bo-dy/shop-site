<?php 
   require_once 'app/vendor/DataBase.php';
   require_once 'app/vendor/Controller.php';

   class Requires
   {
      public function errorRegister()
      {
         echo '<pre>';
         try {
            $errorText = '';
            $fieldsError = false;
            $loginError = true;
            $passwordError = true;
            $first_nameError = true;
            $last_nameError = true;
            $phoneError = true;
            $emailError = true;
            $id_statusError = true;

            $cont = new Controller;
            $userPost = $cont->getPost();

            if (!empty($_POST)) {
               if (empty($userPost['login']) || empty($userPost['password']) || empty($userPost['first_name']) || empty($userPost['last_name']) 
                  || empty($userPost['phone']) || empty($userPost['email']) || empty($userPost['id_status'])) {
                  $fieldsError = true;
                  throw new Exception("Заповнені не всі поля");
                  
               } else {
                  // // Strip special characters from $_POST
                  // $userData = [];
                  // foreach ($userPost as $key => $val) {
                  //    $userData[$key] = preg_quote($val, '/');
                  // }
                  // var_dump($userData);
                  $userData = $userPost;

                  // Get data from DB
                  $pdo = new DataBase();
                  $connection = $pdo->connection();
                  // $connection = $this->builder();
                  $stmt = $connection->prepare('SELECT * FROM shop_db.users');
                  $stmt->execute();
                  $db = $stmt->fetchAll();

                  // Check login
                  if (strlen($userData['login']) < 8 || strlen($userData['login']) > 32) {
                     $loginError = true;
                     throw new Exception("Довжина Юзернейма повнна бути від 8 до 32 символів");
                  } else {
                     $loginError = false;
                  }

                  // Check unique login
                  foreach ($db as $row) {
                     if ($userData['login'] == $row['login']) {
                        $loginError = true;
                        throw new Exception("Такий Юзернейм вже зареєстрований");
                        break;
                     }
                  }

                  // Check email
                  if (preg_match('#(ru|rus)$#', $userData['email'])) {
                     throw new Exception("Московитським окупантам тут не місце!");
                  } elseif (!preg_match('#^[a-zA-Z0-9-.]+@[a-z]+\.[a-z]{2,3}$#', $userData['email'])) {
                     throw new Exception("Такої електронної адреси не існує");
                  } else {
                     $emailError = false;
                  }

                  // Check unique email
                  foreach ($db as $row) {
                     if ($userData['email'] == $row['email']) {
                        $emailError = true;
                        throw new Exception("Така Електронна адреса вже зареєстрована");
                        break;
                     }
                  }

                  // Check phone
                  $clean_phone = preg_replace('#[\s()-]+#', '', $userData['phone']);
                  if (preg_match('#^(\+7)#', $userData['phone'])) {
                     throw new Exception("Московитським окупантам тут не місце!");
                  } elseif (!preg_match('#^(\+)[0-9]{10,12}$#', $clean_phone)) {
                     throw new Exception("Введіть номер телефону в міжнародному форматі без додаткових символів");
                  } else {
                     $phoneError = false;
                  }

                  // Check password
                  if (strlen($userData['password']) < 8 || strlen($userData['password']) > 32) {
                     $passwordError = true;
                     throw new Exception("Довжина Паролю повнна бути від 8 до 32 символів");
                  } else {
                     $passwordError = false;
                  }
                  
                  // Check first_name
                  if (strlen($userData['first_name']) < 2 || strlen($userData['first_name']) > 32) {
                     $first_nameError = true;
                     throw new Exception("Довжина Імені повнна бути від 2 до 32 символів");
                  } else {
                     $first_nameError = false;
                  }
                                    
                  // Check last_name
                  if (strlen($userData['last_name']) < 2 || strlen($userData['last_name']) > 32) {
                     $last_nameError = true;
                     throw new Exception("Довжина Прізвища повнна бути від 2 до 32 символів");
                  } else {
                     $last_nameError = false;
                  }
                                    
                  // Check id_status
                  $idStatus = (int)$userData['id_status'];
                  if (gettype($idStatus) != 'integer') {
                     $id_statusError = true;
                     throw new Exception("Ідентифікатор статусу - це числове значення");
                  } else {
                     $id_statusError = false;
                  }

               }
            }

         } catch (Exception $e) {
            $errorText = $e->getMessage();
         }
         // echo '</pre>';
      }
   }
?>