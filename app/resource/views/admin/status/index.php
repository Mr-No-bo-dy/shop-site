<?php //require 'app/resource/views/home/components/header.php'; ?>

<h1>Statuses</h1>

<form action="status/create" method="post">
   <input type="text" name="name" placeholder="Status Name">
   <input type="text" name="category" placeholder="Status Categiry">
   <button type="submit">Create</button>
</form>

<table>
   <?php foreach ($allStatuses as $status) { ?>
      <tr>
         <td><?= $status['id_status']; ?></td>
         <td><?= $status['name']; ?></td>
         <td><?= $status['category']; ?></td>
      </tr>
   <?php } ?>
</table>

<?php //require 'app/resource/views/home/components/footer.php'; ?>