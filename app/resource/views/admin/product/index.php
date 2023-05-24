<?php require 'app/resource/views/admin/components/header.php'; ?>

<h4>Products</h4>
<div class="my-3"><a class="btn btn-success" href="<?= $this->getBaseURL('product/create') ?>">Create New</a></div>
<table>
   <thead>
      <tr>
         <th>ID</th>
         <th>Image</th>
         <th>Name</th>
         <th>Description</th>
         <th>Category</th>
         <th>Status</th>
         <th>Quantity</th>
         <th>Prices</th>
         <th>All Info</th>
         <th>Change</th>
         <th>Delete</th>
      </tr>
   </thead>
   <tbody>
   <?php foreach ($products as $product) { ?>
      <tr>
         <td><?= $product['id_product'] ?></td>
         <td><?= $this->getImage(['name' => $product['main_image']]); ?></td>
         <td><?= $product['name'] ?></td>
         <td><?= $product['description'] ?></td>
         <td><?= ucfirst($product['category_name']) ?></td>
         <td><?= $product['status_name'] ?></td>
         <td><?= $product['quantity'] ?></td>
         <td>
         <?php foreach ($product['prices'] as $prices) { ?>
            <?php foreach ($prices as $status => $price) { ?>
               <p class="m-0"><?= $status ?> <?= $price ?></p>
            <?php } ?>
         <?php } ?>
         </td>
         <td><a class="btn btn-primary" href="<?= $this->getBaseURL('product') . '?id=' . $product['id_product']. '&name=' . $product['name'] ?>">View</a></td>
         <td><a class="btn btn-warning" href="<?= $this->getBaseURL('product/update') . '?id=' . $product['id_product']. '&name=' . $product['name'] ?>">Change</a></td>
         <td>
            <form action="<?= $this->getBaseURL('product/delete') ?>" method="post">
               <button type="submit" name="delete" value="<?= $product['id_product'] ?>">Delete</button>
            </form>
         </td>
      </tr>
   <?php } ?>
   </tbody>
</table>

<?php require 'app/resource/views/admin/components/footer.php'; ?>