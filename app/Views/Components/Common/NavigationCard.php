<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var string $href  */
/** @var string $icon  */
/** @var string $title  */
/** @var string $description  */
/** @var string $actionLabel  */
?>

<!-- CONTENT -->
<a href="<?= $this->escape($href) ?>" class="group flex min-h-48 flex-col rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:border-red-200 hover:shadow-lg">
    <!-- İkon -->
    <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-50 text-xl text-red-600">
        <i class="bi <?= $this->escape($icon) ?>"></i>
    </span>

    <!-- Başlık -->
    <h2 class="mt-5 text-lg font-black text-slate-950">
        <?= $this->escape($title) ?>
    </h2>

    <!-- Açıklama -->
    <p class="mt-1 flex-1 text-sm leading-6 text-slate-500">
        <?= $this->escape($description) ?>
    </p>

    <!-- Buton -->
    <span class="mt-4 inline-flex items-center gap-2 text-sm font-bold text-red-600">
        <?= $this->escape($actionLabel) ?>
        <i class="bi bi-arrow-right transition group-hover:translate-x-1"></i>
    </span>
</a>