<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var string $action  */
/** @var ?string $enctype  */
?>

<!-- CONSTANST -->
<?php
$hasEnctype = isset($enctype) && $enctype !== "";
?>

<!-- LAYOUT -->
<?= $this->layout("Components/Common/Card", (array) new \App\Support\ViewProps\Components\Common\CardViewProp()) ?>

<!-- CONTENT -->
<form
    method="POST"
    action="<?= $this->escape($action) ?>"
    <?php if ($hasEnctype): ?>
    enctype="<?= $this->escape($enctype) ?>"
    <?php endif ?>
    onsubmit="return addCsrfToken(this) && sanitizeForm(this)"
    class="space-y-5 p-5 sm:p-7 lg:p-8">
    <!-- FORMUN İÇERİĞİ -->
    <?= $this->section("content") ?>
</form>