<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var string $href  */
/** @var string $icon  */
/** @var string $title  */
/** @var string $description  */
?>

<!-- CONTENT -->
<a href="<?= $this->escape($href) ?>" class="group flex items-center gap-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-red-200 hover:shadow-md">
    <!-- İkon -->
    <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-red-50 text-xl text-red-600">
        <i class="bi <?= $this->escape($icon) ?>"></i>
    </span>
    <span class="min-w-0 flex-1">
        <!-- Başlık -->
        <strong class="block truncate text-base font-black text-slate-950 group-hover:text-red-600">
            <?= $this->escape($title) ?>
        </strong>
        <!-- Açıklama -->
        <span class="mt-1 block truncate text-sm text-slate-500">
            <?= $this->escape($description) ?>
        </span>
    </span>
    <!-- Link İkonu -->
    <i class="bi bi-chevron-right text-slate-400 transition group-hover:translate-x-1 group-hover:text-red-600"></i>
</a>