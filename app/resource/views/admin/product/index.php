<?php require 'app/resource/views/admin/components/header.php'; ?>

<h4>Products</h4>

<hr>
<div><a style="text-decoration: none;" href="<?= $this->getBaseURL('product/create') ?>">Create New</a></div>
<hr>

<table>
   <thead>
      <tr>
         <th>ID</th>
         <th>Name</th>
         <th>Description</th>
         <th>Status</th>
         <th>Quantity</th>
         <th>Image</th>
         <th>Prices</th>
         <th>More Info</th>
      </tr>
   </thead>
   <tbody>
   <?php foreach ($products as $product) { ?>
      <tr>
         <td><?= $product['id_product'] ?></td>
         <td><?= $product['name'] ?></td>
         <td><?= $product['description'] ?></td>
         <td><?= $product['status_name'] ?></td>
         <td><?= $product['quantity'] ?></td>
         <td><?= $product['main_image'] ?></td>
         <td>
         <?php foreach ($product['prices'] as $prices) { ?>
            <?php foreach ($prices as $status => $price) { ?>
               <p class="m-0"><?= $status ?> <?= $price ?></p>
            <?php } ?>
         <?php } ?>
         </td>
         <td><a style="text-decoration: none;" href="<?= $this->getBaseURL('product') . '?id=' . $product['id_product']. '&name=' . $product['name'] ?>">See more...</a></td>
      </tr>
   <?php } ?>
   </tbody>
</table>

<?php require 'app/resource/views/admin/components/footer.php'; ?>