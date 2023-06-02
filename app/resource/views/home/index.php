<?php require 'app/resource/views/home/components/header.php'; ?>

<p>Welcome to Shop, <b><?//= $name ?></b></p>
<p><a class="btn btn-success" href="<?//= $this->getBaseURL('home/cart') ?>home/cart">Cart</a></p>

<div class="m-2">
   <h2>Products</h2>
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
      <form style="display: inline-block;" action="<?= $this->getBaseURL('home/view') ?>" method="post">
         <button class="btn btn-secondary" type="submit" name="resetFilters" value="1">Reset Filters</button>
      </form>
   </div>
   <div class="flex">
      <?php foreach ($products as $product) { ?>
         <figure class="figure">
            <figcaption>
               <div><?= $this->getImage([
                        'name' => $product['main_image'],
                        'alt' => $product['name'] . '_image',
                        'class' => 'image',
                        'id' => 'img' . $product['id_product'],
                     ]); ?></div>
               <h5 class="my-3">Name: <strong><?= $product['name'] ?></strong></h5>
               <p><b>Description:</b> <?= $product['description'] ?></p>
               <p><b>Category: </b><?= ucfirst($product['category_name']) ?></p>
               <p><b>Status: </b><?= ucfirst($product['status_name']) ?></p>
               <div><b>Prices:</b></div>
               <?php foreach ($product['prices'] as $prices) { ?>
                  <?php foreach ($prices as $status => $price) { ?>
                     <p class="m-0"><?= ucfirst($status) ?> <?= $price ?></p>
                  <?php } ?>
               <?php } ?>
               <form action="" method="post">
                  <button class="btn btn-primary" type="submit" name="cart" value="<?= $product['id_product'] ?>">В кошик</button>
               </form>
            </figcaption>
         </figure>
      <?php } ?>
   </div>
</div>

<?php require 'app/resource/views/home/components/footer.php'; ?>