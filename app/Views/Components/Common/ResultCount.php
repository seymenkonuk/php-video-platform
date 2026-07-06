<!-- PARAMETERS -->
<?php

/** @var string $count  */
/** @var string $name  */

?>

<!-- CONTENT -->
<div class="inline-flex w-fit items-center gap-2 rounded-full border border-slate-200 bg-white px-3 py-1.5 text-sm text-slate-600 shadow-sm">
    <!-- Adet -->
    <span class="flex h-6 min-w-6 items-center justify-center rounded-full bg-red-50 px-1.5 text-xs font-bold text-red-700">
        <?= $this->escape($count) ?>
    </span>
    <!-- "İçerik Bulundu" -->
    <span>
        <?= $this->escape($name) ?> bulundu
    </span>
</div>