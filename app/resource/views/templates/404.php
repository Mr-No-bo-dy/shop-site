<?php require 'app/resource/views/home/components/header.php'; ?>

<h2>ERROR #404</h2>
<p><?= $error ?? '' ?></p>
<p><a class="btn btn-secondary" href="<?= $this->getBaseURL('../home') ?>">Return back</a></p>

<?php require 'app/resource/views/home/components/footer.php'; ?>