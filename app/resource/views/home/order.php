<?php require 'app/resource/views/home/components/header.php'; ?>

<div class="container-lg">
   <h1 class="my-2 h2 text-center">Make Order</h1>

   <div class="mx-auto col-md-6">
      <div class="card mb-4 p-4 bg-light shadow-lg">
         <div class="table_warp text-center">
            <table>
               <thead>
                  <tr>
                     <th>ID</th>
                     <th>Name</th>
                     <th>Count</th>
                     <th>Price</th>
                     <th>Total Price</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach ($cartData as $idProduct => $product) { ?>
                     <tr>
                        <td><?= $product['id_product'] ?></td>
                        <td><?= $product['name'] ?></td>
                        <td><?= $product['count'] ?></td>
                        <td><?= $product['price'] ?></td>
                        <td><?= $product['total_price'] ?></td>
                     </tr>
                  <?php } ?>
               </tbody>
            </table>
         </div>

         <form action="<?= $this->getBaseURL('order') ?>" method="post">
            <label class="mt-2">First Name</label><input class="form-control" type="text" name="first_name" value="<?= $_POST['first_name'] ?? '' ?>" placeholder="Enter First Name">
            <label class="mt-2">Last Name</label><input class="form-control" type="text" name="last_name" value="<?= $_POST['last_name'] ?? '' ?>" placeholder="Enter Last Name">
            <label class="mt-2">Phone</label><input class="form-control" type="number" name="phone" value="<?= $_POST['phone'] ?? '' ?>" placeholder="Enter Phone ">
            <label class="mt-2">Email</label><input class="form-control" type="email" name="email" value="<?= $_POST['email'] ?? '' ?>" placeholder="Enter Email">
            <div class="text-center mt-4"><button class="btn btn-primary me-3" type="submit" name="order" value="1">Order</button><a class="btn btn-secondary" href="<?= $this->getBaseURL('../home') ?>">Cancel</a></div>
         </form>
      </div>
   </div>
</div>

<?php require 'app/resource/views/home/components/footer.php'; ?>