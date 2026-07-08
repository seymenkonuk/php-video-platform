<!-- PARAMETERS -->
<?php

/** @var string $title  */
/** @var string $value  */
/** @var string $valueFormatted  */

?>

<!-- CONTENT -->
<div class="flex items-center justify-between gap-4 rounded-xl bg-slate-50 px-4 py-3">
    <!-- İstatistik İsmi -->
    <span class="text-sm font-medium text-slate-500"><?= $this->escape($title) ?></span>
    <!-- İstatistik Değeri -->
    <strong title="<?= $this->escape($value) ?>" class="text-sm font-black text-slate-950">
        <?= $this->escape($valueFormatted) ?>
    </strong>
</div>