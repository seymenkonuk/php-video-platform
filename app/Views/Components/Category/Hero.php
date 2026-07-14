<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\DTOs\CategoryHeaderDTO $header  */
?>

<!-- CONTENT -->
<div class="relative overflow-hidden rounded-3xl border border-slate-200 bg-slate-950 shadow-sm">
    <!-- Banner Resmi -->
    <img src="<?= $this->escape($header->banner) ?>" alt="<?= $this->escape($header->title) ?>" class="absolute inset-0 h-full w-full object-cover opacity-35">
    <!-- Üstündeki Siyahlık -->
    <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-950/80 to-transparent"></div>
    <div class="relative z-10 max-w-3xl px-6 py-12 text-white sm:px-10 sm:py-16">
        <!-- Kategori Etiketi -->
        <span class="inline-flex items-center gap-2 rounded-full bg-white bg-opacity-10 px-3 py-1.5 text-xs font-bold uppercase tracking-widest backdrop-blur">
            <i class="bi bi-tags-fill text-red-400"></i>Kategori
        </span>
        <!-- Kategori İsmi -->
        <h1 class="mt-4 text-3xl font-black tracking-tight sm:text-4xl">
            <?= $this->escape($header->title) ?>
        </h1>
        <!-- Kategori Açıklaması -->
        <?php if (isset($header->description) && $header->description !== ""): ?>
            <p class="mt-3 max-w-2xl text-sm leading-7 text-slate-200 sm:text-base">
                <?= $this->escape($header->description) ?>
            </p>
        <?php endif ?>
        <!-- Video Sayısı -->
        <p class="mt-5 text-sm font-semibold text-slate-300">
            <?= $this->escape($header->videoCountFormatted) ?> video
        </p>
    </div>
</div>