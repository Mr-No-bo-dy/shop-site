<?php require 'app/resource/views/admin/components/header.php'; ?>

<div class="container-xlg bg-light">
   <h1 class="my-2 h3 text-center">Orders</h1>
   <div class="mb-3"><p class="m-0"><b>Filters: </b></p>
      <form class="filters" style="display: inline-block;" action="" method="post">
         <div style="display: inline-block;" class="name_filter">
            <input type="text" name="productName" value="<?= $_POST['productName'] ?? '' ?>" placeholder="Product Name">
         </div>
         <select name="id_status">
            <?php foreach ($filterStatuses as $status) { ?>
               <option value="<?= $status['id_status'] ?>" 
                  <?php if (!empty($filters['id_status']) && $filters['id_status'] == $status['id_status']) { ?>
                     selected
                  <?php } elseif ($status['id_status'] == 0) { ?>
                     selected
                  <?php } ?> 
               ><?= ucfirst($status['name']) ?></option>
            <?php } ?>
         </select>
         <select name="id_customer">
            <?php foreach ($filterCustomers as $customer) { ?>
               <option value="<?= $customer['id_customer'] ?>" 
                  <?php if (!empty($filters['id_customer']) && $filters['id_customer'] == $customer['id_customer']) { ?>
                     selected
                  <?php } elseif ($customer['id_customer'] == 0) { ?>
                     selected
                  <?php } ?> 
               ><?= $customer['first_name'] ?> <?= $customer['last_name'] ?></option>
            <?php } ?>
         </select>
         <select name="id_user">
            <?php foreach ($filterUsers as $user) { ?>
               <option value="<?= $user['id_user'] ?>" 
                  <?php if (!empty($filters['id_user']) && $filters['id_user'] == $user['id_user']) { ?>
                     selected
                  <?php } elseif ($user['id_user'] == 0) { ?>
                     selected
                  <?php } ?> 
               ><?= $user['first_name'] ?> <?= $user['last_name'] ?></option>
            <?php } ?>
         </select>
         <button class="btn btn-primary" type="submit" name="show">Show</button>
      </form>
      <form style="display: inline-block;" action="" method="post">
         <button class="btn btn-secondary" type="submit" name="resetFilters" value="1">Reset Filters</button>
      </form>
   </div>

   <div class="mb-3 text-center">
      <table>
         <thead>
            <tr>
               <th>ID Order</th>
               <th>Status</th>
               <th>Product</th>
               <th>Count</th>
               <th>Total Price</th>
               <th>Customer</th>
               <th>Seller</th>
               <th>Update</th>
            </tr>
         </thead>
         <tbody>
            <?php foreach ($allOrders as $idOrder => $order) { ?>
               <tr>
                  <td><?= $order['id_order'] ?></td>
                  <td>
                     <select form="updateOrder_<?= $order['id_order'] ?>" name="idStatusUpdate" style="width: 100px;">
                        <?php foreach ($allStatuses as $idStatus => $status) { ?>
                           <option value="<?= $status['id_status'] ?>" <?= $order['id_status'] === $status['id_status'] ? 'selected' : '' ?>><?= ucfirst($status['name']) ?></option>
                        <?php } ?>
                     </select>
                  </td>
                  <td class="ps-1 text-start">
                     <?= $this->getImage([
                        'name' => $order['product_image'],
                        'alt' => $order['product_name'] . '_image',
                        'class' => 'image',
                        'id' => 'img' . $order['id_product'],
                     ]); ?>
                     <?= $order['product_name'] ?>
                  </td>
                  <td><?= $order['total_quantity'] ?></td>
                  <td><?= $order['total_price'] ?> $</td>
                  <td class="ps-1 text-start">
                     <p class="m-0"><b>Name:</b> <?= $order['customer_first_name'] ?> <?= $order['customer_last_name'] ?></p>
                     <p class="m-0"><b>Phone:</b> <?= $order['customer_phone'] ?></p>
                     <p class="m-0"><b>Email:</b> <?= $order['customer_email'] ?></p>
                  </td>
                  <td>
                     <select form="updateOrder_<?= $order['id_order'] ?>" name="idUserUpdate">
                        <?php foreach ($allUsers as $idUser => $user) { ?>
                           <option value="<?= $user['id_user'] ?>" <?= $user['id_user'] === $order['id_user'] ? 'selected' : '' ?>><?= $user['first_name'] ?> <?= $user['last_name'] ?></option>
                        <?php } ?>
                     </select>
                  </td>
                  <td>
                     <form id="updateOrder_<?= $order['id_order'] ?>" action="" method="post">
                        <button class="btn btn-warning" type="submit" name="idOrderUpdate" value="<?= $order['id_order'] ?>">Update</button>
                     </form>
                  </td>
               </tr>
            <?php } ?>
         </tbody>
      </table>
   </div>

   <div class="row">
      <div class="col-12">
         <ul class="pagination justify-content-center">
            <?php foreach ($links as $link) { ?>
               <li class="page-item <?= (isset($link['active']) && $link['active']) ? 'active' : '' ?>">
                  <a href="?page=<?= $link['page'] ?>" class="page-link"><?= $link['label'] ?></a>
               </li>
            <?php } ?>
         </ul>
      </div>
   </div>
</div>

<?php require 'app/resource/views/admin/components/footer.php'; ?>