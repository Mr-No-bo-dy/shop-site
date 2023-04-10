<?php 
   require_once "app/vendor/DataBase.php";
   require_once "app/vendor/BaseModel.php";

   class Product extends BaseModel
   {
      // public function getAll()
      // {
      //    $builder = $this->builder();
      //    $stmt = $builder->prepare("SELECT * FROM shop_db.products");
      //    $stmt->execute();

      //    return $stmt->fetchAll();
      // }

      // public function getAllProducts($table)
      // {
      //    $products = $this->getAll($table);
      //    foreach ($products as $product) {
      //       $builder = $this->builder();
      //       $stmt = $builder->prepare("SELECT * FROM shop_db.$table WHERE id_product = " . $product['id_product']);
      //       $stmt->execute();
      //       $prices[] = $stmt->fetch();
      //    }

      //    foreach ($prices as &$price) {      // масив з id_product => price
      //       if (!empty($price)) {
      //          $preparePrice[$price['id_product']] = $price;
      //       }
      //       // $prices[$price['id_product']][] = $price;
      //    }

      //    foreach ($products as $product) {
      //       $prepareProduct['prices'] = $preparePrice[$product['id_product']];
      //    }
      //    echo '<pre>';
      //    var_dump($products);
      //    die;
          
      //    return $prices;
      // }
   }
?>