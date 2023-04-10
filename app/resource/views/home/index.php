<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Index</title>
</head>

<body>
   <h2>Welcome to Shop, <?= $data['name'] ?></h2>
   <?= '<pre>'; ?>
   <?php // var_dump($data['products']); ?>
   <?= '</pre>'; ?>
   
   <?php //foreach($data['products'] as $product) {?>
      <p>Price: <b><?//= $product['price'] ?> $</b></p>
      <b><?php //var_dump($product) ?>
   <?php //} ?>

   
</body>

</html>