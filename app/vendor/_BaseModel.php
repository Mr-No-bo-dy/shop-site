<?php 
   require_once 'app/vendor/DataBase.php';

   class BaseModel
   {
      public function builder()
      {
         return DataBase::connection();
      }
      
      // Get all info of all entities
      public function getAll(string $tableName, string $primaryColumnName)
      {
         $builder = $this->builder();
         $stmt = $builder->prepare('SELECT * FROM shop_db.' . $tableName . '');
         $stmt->execute();
         
         $items = [];
         $result = $stmt->fetchAll();
         foreach ($result as $row) {
            $items[$row[$primaryColumnName]] = $row;
         }

         return $items;
      }
      
      // Get all info of one entity
      public function getOne(string $tableName, string $primaryColumnName, int $idEntity)
      {
         $builder = $this->builder();
         $stmt = $builder->prepare('SELECT * FROM shop_db.' . $tableName .' WHERE ' . $primaryColumnName .' = ' . $idEntity . '');
         $stmt->execute();
         $item = $stmt->fetch();

         return $item;
      }

      // public static $errorText = '';
      // public static $fieldsError = false;
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
                  // $this->fieldsError = true;
                  // $this->fieldsError = true;
                  throw new Exception("Заповнені не всі поля");

               } else {
                  // Strip special characters from $_POST
                  $userData = [];
                  foreach ($userPost as $key => $val) {
                     $userData[$key] = preg_replace('#[^a-zA-Z0-9а-яА-ЯєЄіІ@._-]#u', '', $val);
                     // $userData[$key] = preg_replace('#[\!\№\#\;\$\:\^\?\*\\,(\)\[\]\{\}\<\>\\+\=\\\|\/]#', '', $val);
                  }
                  // var_dump($userData);
                  // $userData = $userPost;

                  // Get data from DB
                  // $pdo = new DataBase();
                  // $connection = $pdo->connection();
                  $connection = $this->builder();
                  $stmt = $connection->prepare('SELECT * FROM shop_db.users');
                  $stmt->execute();
                  $db = $stmt->fetchAll();

                  // Check login
                  if (strlen($userData['login']) < 8 || strlen($userData['login']) > 32) {
                     $loginError = true;
                     throw new Exception("Довжина Юзернейма повнна бути від 8 до 32 символів");
                  } else {
                     $userData['login'] = preg_replace('#[\s+]#', '_', $userData['login']);
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
                  $userData['phone'] = preg_replace('#[+\s()-]#', '', $userData['phone']);
                  // if (preg_match('#^(\+7)#', $userData['phone'])) {
                  if (preg_match('#^7#', $userData['phone'])) {
                     throw new Exception("Московитським окупантам тут не місце!");
                     // } elseif (!preg_match('#^(\+)[0-9]{10,12}$#', $userData['phone'])) {
                  } elseif (!preg_match('#^[0-9]{10,12}$#', $userData['phone'])) {
                     echo 'error';
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
                     $userData['first_name'] = preg_replace('#[\s]+#', '_', $userData['first_name']);
                     $first_nameError = false;
                  }
                                    
                  // Check last_name
                  if (strlen($userData['last_name']) < 2 || strlen($userData['last_name']) > 32) {
                     $last_nameError = true;
                     throw new Exception("Довжина Прізвища повнна бути від 2 до 32 символів");
                  } else {
                     $userData['last_name'] = preg_replace('#[\s]+#', '_', $userData['last_name']);
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
         
         return $userData;
      }

      // Add user into DB
      public function save(array $data)
      {
         if (isset($data['login']) && isset($data['password']) && isset($data['first_name']) 
            && isset($data['last_name']) && isset($data['phone']) && isset($data['email']) && isset($data['id_status'])) {
            
            $data = $this->errorRegister();
            // var_dump($data);
            
            $sql = 'INSERT INTO shop_db.users (login, password, first_name, last_name, phone, email, id_status) 
               VALUES (:login, :password, :first_name, :last_name, :phone, :email, :id_status)';
            
            // Password's hashing:
            $hashOptions = ['cost' => 12];
            $password = password_hash($data['password'], PASSWORD_BCRYPT, $hashOptions);

            $stmt = $this->builder()
                        ->prepare($sql);

            $stmt->bindParam(':login', $data['login']);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':first_name', $data['first_name']);
            $stmt->bindParam(':last_name', $data['last_name']);
            $stmt->bindParam(':phone', $data['phone']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':id_status', $data['id_status']);
            // $stmt->execute();
         }

         $this->builder();
      }
   }
?>