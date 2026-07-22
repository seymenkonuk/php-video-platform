<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var string $brandName  */
/** @var string $textColor  */
?>

<!-- CONTENT -->
<?php if ($brandName !== ''): ?>
    <a href="/" class="group inline-flex items-center gap-2.5">
        <!-- Logo -->
        <span class="flex h-9 w-11 items-center justify-center rounded-xl bg-red-600 text-white shadow-sm transition-transform group-hover:scale-105">
            <i class="bi bi-play-fill text-2xl"></i>
        </span>
        <!-- Marka İsmi -->
        <span class="text-xl font-black tracking-tight <?= $this->escape($textColor) ?> group-hover:text-red-600">
            <?= $this->escape($brandName) ?>
        </span>
    </a>
<?php endif ?>