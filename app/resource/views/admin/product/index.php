<?php require 'app/resource/views/admin/components/header.php'; ?>

<h4>Products</h4>
<div class="my-3"><a class="btn btn-success" href="<?= $this->getBaseURL('product/create') ?>">Create New</a></div>

<div class="mb-3"><p class="m-0"><b>Filters: </b></p>
      <form class="filters" style="display: inline-block;" action="" method="post">
         <div style="display: inline-block;" class="name_filter">
            <input type="text" name="productName" value="<?= $_POST['productName'] ?? '' ?>" placeholder="Product Name">
         </div>
         <select name="id_category">
            <?php foreach ($allCategories as $category) { ?>
               <option value="<?= $category['id_category'] ?>" 
                  <?php if (!empty($filters['id_category']) && $filters['id_category'] == $category['id_category']) { ?>
                     selected
                  <?php } elseif ($category['id_category'] == 0) { ?>
                     selected
                  <?php } ?> 
               ><?= ucfirst($category['name']) ?></option>
            <?php } ?>
         </select>
         <select name="id_sub_category">
            <?php foreach ($allSubCategories as $subCategory) { ?>
               <option value="<?= $subCategory['id_sub_category'] ?>" 
                  <?php if (!empty($filters['id_sub_category']) && $filters['id_sub_category'] == $subCategory['id_sub_category']) { ?>
                     selected
                  <?php } elseif ($subCategory['id_sub_category'] == 0) { ?>
                     selected
                  <?php } ?> 
               ><?= ucfirst($subCategory['name']) ?></option>
            <?php } ?>
         </select>
         <select name="id_status">
            <?php foreach ($allStatuses as $status) { ?>
               <option value="<?= $status['id_status'] ?>" 
                  <?php if (!empty($filters['id_status']) && $filters['id_status'] == $status['id_status']) { ?>
                     selected
                  <?php } elseif ($status['id_status'] == 0) { ?>
                     selected
                  <?php } ?> 
               ><?= ucfirst($status['name']) ?></option>
            <?php } ?>
         </select>
         <div style="display: inline-block;" class="price_filter">
            <input type="number" name="price[min]" value="<?= $_POST['price']['min'] ?? '' ?>" placeholder="Minimum Price">
            <input type="number" name="price[max]" value="<?= $_POST['price']['max'] ?? '' ?>" placeholder="Maximum Price">
         </div>
         <button class="btn btn-primary" type="submit" name="show">Show</button>
      </form>
      <form style="display: inline-block;" action="" method="post">
         <button class="btn btn-secondary" type="submit" name="resetFilters" value="1">Reset Filters</button>
      </form>
</div>

<table>
   <thead>
      <tr>
         <th>ID</th>
         <th>Image</th>
         <th>Name</th>
         <th>Description</th>
         <th>Category</th>
         <th>SubCategory</th>
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
         <td>
            <?php foreach ($product['sub_categories'] as $subCategory) { ?>
               <div><?= ucfirst($subCategory) ?></div>
            <?php } ?>
         </td>
         <td><?= ucfirst($product['status_name']) ?></td>
         <td><?= $product['quantity'] ?></td>
         <td>
         <?php foreach ($product['prices'] as $prices) { ?>
            <?php foreach ($prices as $status => $price) { ?>
               <p class="m-0"><?= ucfirst($status) ?> <?= $price ?></p>
            <?php } ?>
         <?php } ?>
         </td>
         <td><a class="btn btn-primary" href="<?= $this->getBaseURL('product') . '?id=' . $product['id_product']. '&name=' . $product['name'] ?>">View</a></td>
         <td><a class="btn btn-warning" href="<?= $this->getBaseURL('product/update') . '?id=' . $product['id_product']. '&name=' . $product['name'] ?>">Change</a></td>
         <td>
            <form action="<?= $this->getBaseURL('product/delete') ?>" method="post">
               <button class="btn btn-danger" type="submit" name="delete" value="<?= $product['id_product'] ?>">Delete</button>
            </form>
         </td>
      </tr>
   <?php } ?>
   </tbody>
</table>

<?php require 'app/resource/views/admin/components/footer.php'; ?>