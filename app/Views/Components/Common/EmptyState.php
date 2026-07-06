<!-- PARAMETERS -->
<?php

/** @var ?string $icon  */
/** @var string $title  */
/** @var ?string $description  */

?>

<!-- DEFAULT VALUE -->
<?php

$icon ??= "bi-inbox";
$description ??= "";

?>

<!-- CONTENT -->
<div class="flex min-h-64 flex-col items-center justify-center rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-12 text-center">
    <!-- İkon -->
    <span class="mb-5 flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-2xl text-slate-500">
        <i class="bi <?= $this->escape($icon) ?>"></i>
    </span>
    <!-- Başlık -->
    <h2 class="text-xl font-bold text-slate-900">
        <?= $this->escape($title) ?>
    </h2>
    <!-- Açıklama -->
    <?php if ($description !== ""): ?>
        <p class="mt-2 max-w-md text-sm leading-6 text-slate-500">
            <?= $this->escape($description) ?>
        </p>
    <?php endif ?>
</div>