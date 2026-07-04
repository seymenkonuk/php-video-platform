<!-- PARAMETERS -->
<?php

/** @var string $action  */
/** @var ?string $enctype  */

?>

<!-- LAYOUT -->
<?= $this->layout("Components/Common/Card") ?>

<!-- CONTENT -->
<form
    method="POST"
    action="<?= $this->escape($action) ?>"
    <?php if ($enctype !== null): ?>
    enctype="<?= $this->escape($enctype) ?>"
    <?php endif ?>
    onsubmit="return addCsrfToken(this) && sanitizeForm(this)"
    class="space-y-5 p-5 sm:p-7 lg:p-8">
    <!-- FORMUN İÇERİĞİ -->
    <?= $this->section("content") ?>
</form>