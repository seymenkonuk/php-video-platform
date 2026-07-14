<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\DTOs\CategoryCardDTO $category  */
?>

<!-- LAYOUT -->
<?= $this->layout("Components/Common/Card") ?>

<!-- CONTENT -->
<a href="<?= $this->escape($category->url) ?>" class="relative block aspect-[16/9] overflow-hidden bg-slate-100">
    <!-- Kategori Kapak Resmi -->
    <img src="<?= $this->escape($category->banner) ?>" alt="<?= $this->escape($category->title) ?>" loading="lazy" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
    <!-- Alttaki Siyahlık -->
    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/10 to-transparent"></div>
    <!-- Sol Üstteki Kategori İkonu -->
    <span class="absolute left-3 top-3 flex h-10 w-10 items-center justify-center rounded-xl bg-white bg-opacity-90 text-red-600 shadow">
        <i class="bi bi-tags-fill"></i>
    </span>
</a>

<div class="flex flex-1 flex-col p-4">
    <!-- Kategori İsmi -->
    <a href="<?= $this->escape($category->url) ?>" title="<?= $this->escape($category->title) ?>" class="text-lg font-black text-slate-950 transition hover:text-red-600">
        <?= $this->escape($category->title) ?>
    </a>
    <!-- Kategori Açıklaması (Varsa) -->
    <?php if (isset($category->description) && $category->description !== ""): ?>
        <p class="mt-2 line-clamp-2 text-sm leading-6 text-slate-500">
            <?= $this->escape($category->description) ?>
        </p>
    <?php endif ?>
    <!-- Video Sayısı -->
    <span title="<?= $this->escape($category->videoCount) ?> video" class="mt-4 inline-flex w-fit items-center gap-1.5 rounded-full bg-red-50 px-2.5 py-1 text-xs font-bold text-red-700">
        <!-- İkon -->
        <i class="bi bi-play-btn"></i>
        <!-- Mesaj -->
        <?= $this->escape($category->videoCountFormatted) ?> video
    </span>
</div>