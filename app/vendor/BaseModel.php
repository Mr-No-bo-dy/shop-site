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
            $fieldsError = false;
            $errorText = '';

            $cont = new Controller;
            $userData = $cont->getPost();

            if (!empty($_POST)) {
               if (empty($userData['login']) || empty($userData['password']) || empty($userData['first_name']) || empty($userData['last_name']) 
                  || empty($userData['phone']) || empty($userData['email']) || empty($userData['id_status'])) {
                  $fieldsError = true;
                  // $this->fieldsError = true;
                  // $this->fieldsError = true;
                  throw new Exception("Заповнені не всі поля");

               } else {
                  // Get data from DB
                  // $pdo = new DataBase();
                  // $connection = $pdo->connection();
                  $connection = $this->builder();
                  $stmt = $connection->prepare('SELECT * FROM shop_db.users');
                  $stmt->execute();
                  $db = $stmt->fetchAll();

                  // Check login
                  if (!preg_match_all('#[a-zA-Z0-9а-яА-ЯєЄіІ_-]{4,20}#u', $userData['login'])) {
                     // echo '<h3>login</h3>';
                     throw new Exception("Юзернейм повинен містити лише літери, цифри, - чи _ та мати довжину від 6 до 20 символів");
                  }

                  // Check unique login
                  foreach ($db as $row) {
                     if ($userData['login'] == $row['login']) {
                        // echo '<h3>ulogin</h3>';
                        throw new Exception("Такий Юзернейм вже зареєстрований");
                        break;
                     }
                  }

                  // Check password
                  if (!preg_match_all('#[a-zA-Z0-9а-яА-ЯєЄіІ_-]{8,32}#u', $userData['password'])) {
                     // echo '<h3>pass</h3>';
                     throw new Exception("Пароль повинен містити лише літери, цифри, - чи _ та мати довжину від 8 до 32 символів");
                  }

                  // Check email
                  if (preg_match('#(ru|rus)$#', $userData['email'])) {
                     throw new Exception("Московитським окупантам тут не місце!");
                  } elseif (!preg_match('#^[a-zA-Z0-9-.]+@[a-z]+\.[a-z]{2,3}$#', $userData['email'])) {
                     throw new Exception("Такої електронної адреси не існує");
                     // echo '<h3>email</h3>';
                  }

                  // Check unique email
                  foreach ($db as $row) {
                     if ($userData['email'] == $row['email']) {
                        // echo '<h3>uemail</h3>';
                        throw new Exception("Така Електронна адреса вже зареєстрована");
                        break;
                     }
                  }

                  // Check phone
                  $userData['phone'] = preg_replace('#[\s()-]#', '', $userData['phone']);
                  if (preg_match('#^(\+7)#', $userData['phone'])) {
                     throw new Exception("Московитським окупантам тут не місце!");
                  } elseif (!preg_match('#^(\+)[0-9]{10,12}$#', $userData['phone'])) {
                     // echo '<h3>phone</h3>';
                     throw new Exception("Введіть номер телефону в міжнародному форматі без додаткових символів");
                  }
                  
                  // Check first_name
                  $userData['first_name'] = ucfirst($userData['first_name']);
                  if (!preg_match_all('#[a-zA-Z0-9а-яА-ЯєЄіІ_-]{2,32}#u', $userData['first_name'])) {
                     // echo '<h3>fname</h3>';
                     throw new Exception("Ім'я повинно містити лише літери, цифри, - чи _ та мати довжину від 2 до 32 символів");
                  }
                                    
                  // Check last_name
                  $userData['last_name'] = ucfirst($userData['last_name']);
                  if (!preg_match_all('#[a-zA-Z0-9а-яА-ЯєЄіІ_-]{2,32}#u', $userData['last_name'])) {
                     // echo '<h3>lname</h3>';
                     throw new Exception("Прізвище повинно містити лише літери, цифри, - чи _ та мати довжину від 2 до 32 символів");
                  }
                                    
                  // Check id_status
                  $idStatus = (int)$userData['id_status'];
                  if (gettype($idStatus) != 'integer') {
                     // echo '<h3>id</h3>';
                     throw new Exception("Ідентифікатор статусу - це числове значення");
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
         if (isset($data['login']) && isset($data['password']) && isset($data['first_name']) && isset($data['last_name']) 
            && isset($data['phone']) && isset($data['email']) && isset($data['id_status'])) {
            
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
            $stmt->execute();
         }

         $this->builder();
      }

      public function login(array $data)
      {
         echo '<pre>';
         try {
            $fieldsError = false;
            $errorText = '';

            // $cont = new Controller;
            // $userData = $cont->getPost();

            if (empty($data['login']) || empty($data['password'])) {
               $fieldsError = true;
               throw new Exception("Порожні поля");
            } else {

               // Get data from DB
               // $pdo = new DataBase();
               // $connection = $pdo->connection();
               $connection = $this->builder();
               $stmt = $connection->prepare('SELECT * FROM shop_db.users');
               $stmt->execute();
               $db = $stmt->fetchAll();
               // var_dump($db);
               
               $data['login'] = preg_replace('#[^a-zA-Z0-9а-яА-ЯєЄіІ_-]#u', '', $data['login']);
               $data['password'] = preg_replace('#[^a-zA-Z0-9а-яА-ЯєЄіІ_-]#u', '', $data['password']);

               foreach ($db as $row) {
                  if ($row['login'] == $data['login']) {
                     // var_dump($row);
                     if (password_verify($data['password'], $row['password'])) {
                        // echo '<h3>OK</h3>';
                        return true;
                     } else {
                        // echo '<h3>pass</h3>';
                        throw new Exception("Неправильний Нікнейм або Пароль");
                        // return false;
                     }
                     // break;
                  }
               }
            }

         } catch (Exception $e) {
            $errorText = $e->getMessage();
         }
      }

   }
?>