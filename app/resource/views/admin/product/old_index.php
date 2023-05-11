<?php require 'app/resource/views/admin/components/header.php'; ?>

<table>
   <thead>
      <tr>
         <th rowspan="2">ID</th>
         <th rowspan="2">Product</th>
         <th rowspan="2">Description</th>
         <th rowspan="2">Image</th>
         <th rowspan="2">Quantity</th>
         <th colspan="3">Prices</th>
      </tr>
      <tr>
         <th>Wholesale</th>
         <th>Retail</th>
         <th>Discount</th>
      </tr>
   </thead>
   <tbody>
   <?php foreach ($products as $product) { ?>
      <tr>
         <td><?= $product['id_product'] ?></td>
         <td><?= $product['name'] ?></td>
         <td><?= $product['description'] ?></td>
         <td><?= $product['main_image'] ?></td>
         <td><?= $product['quantity'] ?></td>
         <td><?= isset($product['prices'][1]) ? $product['prices'][1]['price'] : '' ?></td>
         <td><?= isset($product['prices'][2]) ? $product['prices'][2]['price'] : '' ?></td>
         <td><?= isset($product['prices'][3]) ? $product['prices'][3]['price'] : '' ?></td>
      </tr>
   <?php } ?>
   </tbody>
</table>


<script src='/app/resource/js/scripts.js'></script>
<?php require 'app/resource/views/admin/components/footer.php'; ?>