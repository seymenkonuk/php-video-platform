<!-- PARAMETERS -->
<?php

/** @var ?string $icon  */
/** @var string $title  */
/** @var ?string $description  */

?>

<!-- DEFAULT VALUE -->
<?php

$icon ??= "bi-grid";
$description ??= "";

?>

<!-- CONTENT -->
<header class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
    <div class="flex min-w-0 items-start gap-3">
        <!-- İkon -->
        <span class="mt-0.5 flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-red-50 text-red-600">
            <i class="bi <?= $this->escape($icon) ?> text-lg"></i>
        </span>
        <div class="min-w-0">
            <!-- Başlık -->
            <h1 class="text-2xl font-black tracking-tight text-slate-950 sm:text-3xl">
                <?= $this->escape($title) ?>
            </h1>
            <!-- Açıklama -->
            <?php if ($description !== ""): ?>
                <p class="mt-1 max-w-2xl text-sm leading-6 text-slate-500"><?= $this->escape($description) ?></p>
            <?php endif ?>
        </div>
    </div>
</header>