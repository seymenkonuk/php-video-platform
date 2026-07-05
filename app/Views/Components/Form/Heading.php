<!-- PARAMETERS -->
<?php

/** @var ?string $icon  */
/** @var string $text  */

?>

<!-- DEFAULT VALUE -->
<?php

$icon ??= null;

?>

<!-- CONTENT -->
<div class="mb-2 text-center">
    <!-- Form Başlığı İkonu (Varsa) -->
    <?php if ($icon !== null): ?>
        <span class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-red-50 text-red-600">
            <i class="bi <?= $this->escape($icon) ?> text-xl"></i>
        </span>
    <?php endif ?>
    <!-- Form Başlığı -->
    <h1 class="text-2xl font-black tracking-tight text-slate-950 sm:text-3xl">
        <?= $this->escape($text) ?>
    </h1>
</div>