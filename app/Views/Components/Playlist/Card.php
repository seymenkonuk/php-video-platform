<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\DTOs\Playlist\CardDTO $playlist  */
?>

<!-- LAYOUT -->
<?= $this->layout("Components/Common/Card", (array) new \App\Support\ViewProps\Components\Common\CardViewProp()) ?>

<!-- CONTENT -->
<a href="<?= $this->escape($playlist->url) ?>" class="relative block aspect-video overflow-hidden bg-slate-100">
    <!-- Oynatma Listesi Kapak Resmi -->
    <img src="<?= $this->escape($playlist->banner) ?>" alt="<?= $this->escape($playlist->title) ?>" loading="lazy" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
    <!-- Yandaki Siyahlık -->
    <div class="absolute inset-y-0 right-0 flex w-2/5 flex-col items-center justify-center bg-black bg-opacity-70 text-white backdrop-blur-sm">
        <!-- Ortasına Oynatma Listesi İkonu -->
        <i class="bi bi-collection-play mb-2 text-2xl"></i>
        <!-- Altına Video Sayısı -->
        <span title="<?= $playlist->videoCount ?> video" class="text-sm font-bold">
            <?= $this->escape($playlist->videoCountFormatted) ?> video
        </span>
    </div>
</a>

<div class="p-4">
    <!-- Oynatma Listesi Başlığı -->
    <a href="<?= $this->escape($playlist->url) ?>" title="<?= $this->escape($playlist->title) ?>" class="line-clamp-2 font-bold text-slate-950 transition hover:text-red-600">
        <?= $this->escape($playlist->title) ?>
    </a>
    <!-- Oynatma Listesi Bilgileri -->
    <div class="mt-3 flex items-center justify-between gap-3">
        <!-- Kanal Bilgileri -->
        <a href="<?= $this->escape($playlist->channel->url) ?>" title="<?= $this->escape($playlist->channel->title) ?>" class="flex min-w-0 items-center gap-2 text-sm font-medium text-slate-600 hover:text-red-600">
            <!-- Kanal Resmi -->
            <img src="<?= $this->escape($playlist->channel->avatar) ?>" alt="<?= $this->escape($playlist->channel->title) ?>" loading="lazy" class="h-8 w-8 shrink-0 rounded-full object-cover">
            <!-- Kanal Başlığı -->
            <span class="truncate">
                <?= $this->escape($playlist->channel->title) ?>
            </span>
        </a>
        <!-- Görüntüleme Türü -->
        <span class="inline-flex shrink-0 items-center gap-1 rounded-full bg-slate-100 px-2 py-1 text-xs font-medium text-slate-600">
            <i class="bi <?= $this->escape($playlist->viewType->icon()) ?>"></i>
            <?= $this->escape($playlist->viewType->label()) ?>
        </span>
    </div>
</div>