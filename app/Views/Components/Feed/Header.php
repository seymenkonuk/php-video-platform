<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var string $icon */
/** @var string $eyebrow */
/** @var string $title */
/** @var \App\Support\DTOs\LibraryHeaderDTO $header  */
?>

<!-- CONTENT -->
<div class="flex flex-col gap-5 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:flex-row sm:items-center sm:justify-between sm:p-7">
    <div class="flex items-center gap-4">
        <!-- İkon -->
        <span class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-red-50 text-2xl text-red-600">
            <i class="bi <?= $this->escape($icon) ?>"></i>
        </span>
        <div>
            <!-- Üst Başlık -->
            <p class="text-xs font-bold uppercase tracking-widest text-red-600"><?= $this->escape($eyebrow) ?></p>
            <!-- Başlık -->
            <h1 class="mt-1 text-2xl font-black text-slate-950"><?= $this->escape($title) ?></h1>
            <!-- Bilgiler -->
            <p class="mt-1 text-sm text-slate-500">
                <?= $this->escape($header->videoCountFormatted) ?> video · <?= $this->escape($header->totalDurationFormatted) ?>
            </p>
        </div>
    </div>
</div>