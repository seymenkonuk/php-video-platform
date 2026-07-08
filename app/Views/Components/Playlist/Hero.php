<!-- PARAMETERS -->
<?php

use App\Support\DTOs\PlaylistHeaderDTO;

/** @var PlaylistHeaderDTO $header  */

?>

<!-- CONTENT -->
<div class="grid overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm lg:grid-cols-[22rem_minmax(0,1fr)]">
    <div class="relative aspect-video overflow-hidden bg-slate-100 lg:aspect-auto lg:min-h-72">
        <!-- Banner Resmi -->
        <img src="<?= $this->escape($header->banner) ?>" alt="<?= $this->escape($header->title) ?>" class="h-full w-full object-cover">
        <!-- Alttaki Siyahlık -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
        <!-- Video Sayısı Bilgisi -->
        <span class="absolute bottom-4 left-4 inline-flex items-center gap-2 rounded-xl bg-black bg-opacity-70 px-3 py-2 text-sm font-bold text-white">
            <!-- İkon -->
            <i class="bi bi-collection-play"></i>
            <!-- Video Sayısı -->
            <?= $this->escape($header->videoCountFormatted) ?> video
        </span>
    </div>
    <div class="flex flex-col justify-center p-6 sm:p-8">
        <!-- Oynatma Listesi Bilgileri -->
        <div class="flex flex-wrap items-center gap-2 text-xs font-bold uppercase tracking-widest text-red-600">
            <span>Oynatma listesi</span>
            <span class="text-slate-300">•</span>
            <!-- Görünürlük Bilgisi -->
            <span class="text-slate-500">
                <?= $this->escape($header->viewType->label()) ?>
            </span>
        </div>
        <!-- Oynatma Listesi Başlığı -->
        <h1 class="mt-3 text-2xl font-black tracking-tight text-slate-950 sm:text-3xl">
            <?= $this->escape($header->title) ?>
        </h1>
        <!-- Oynatma Listesi Açıklaması -->
        <?php if (isset($header->description) && $header->description !== ""): ?>
            <p class="mt-3 line-clamp-3 text-sm leading-6 text-slate-600">
                <?= $this->escape($header->description) ?>
            </p>
        <?php endif ?>
        <!-- Kanal Bilgisi -->
        <a href="<?= $this->escape($header->channel->url) ?>" class="mt-5 flex w-fit items-center gap-3 text-sm font-bold text-slate-700 hover:text-red-600">
            <!-- Kanal Resmi -->
            <img src="<?= $this->escape($header->channel->avatar) ?>" alt="<?= $this->escape($header->channel->title) ?>" class="h-9 w-9 rounded-full object-cover">
            <!-- Kanal İsmi -->
            <span><?= $this->escape($header->channel->title) ?></span>
        </a>
        <!-- Oynatma Listesi Toplam Uzunluğu (Süre) -->
        <p class="mt-4 text-xs text-slate-500">
            <?= $this->escape($header->totalDurationFormatted) ?> toplam süre
        </p>
    </div>
</div>