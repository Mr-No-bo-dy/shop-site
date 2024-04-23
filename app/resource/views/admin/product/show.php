<h2 class="h3">Product</h2>
<figure>
    <figcaption>
        <h3 class="my-3 h5">Name: <strong><?= $product['name'] ?></strong></h3>
        <p><b>ID:</b> <?= $product['id_product'] ?></p>
        <p><b>Description:</b> <?= $product['description'] ?></p>
        <p><b>Category: </b><?= ucfirst($category) ?></p>
        <p><b>Status: </b><?= ucfirst($status) ?></p>
        <p><b>Quantity:</b> <?= $product['quantity'] ?></p>
        <div><b>Prices:</b></div>
        <?php foreach ($statuses as $status) { ?>
            <?php foreach ($prices as $price) { ?>
                <?php if ($status['id_status'] === $price['id_status']) { ?>
                    <div><?= ucfirst($status['name']) ?>: <?= $price['price'] ?>$</div>
                <?php } ?>
            <?php } ?>
        <?php } ?>
    </figcaption>
</figure>
