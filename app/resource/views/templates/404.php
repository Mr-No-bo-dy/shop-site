<?php require 'app/resource/views/home/components/header.php'; ?>

<h1 class="h3">ERROR #404</h1>
<p><?= $error ?? '' ?></p>
<p><a class="btn btn-secondary" href="<?= $this->getBaseURL('../home') ?>">Return back</a></p>

<?php require 'app/resource/views/home/components/footer.php'; ?>