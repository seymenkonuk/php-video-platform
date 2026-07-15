<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\DTOs\Video\CardDTO $video  */
?>

<!-- LAYOUT -->
<?= $this->layout("Components/Common/Card") ?>

<!-- CONTENT -->
<a href="<?= $this->escape($video->url) ?>" class="relative block aspect-video overflow-hidden bg-slate-100">
    <!-- Video Kapak Resmi -->
    <img src="<?= $this->escape($video->thumbnail) ?>" alt="<?= $this->escape($video->title) ?>" loading="lazy" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
    <!-- Video Süresi -->
    <span class="absolute bottom-2 right-2 rounded-md bg-black bg-opacity-80 px-2 py-1 text-xs font-bold text-white">
        <?= $this->escape($video->durationFormatted) ?>
    </span>
    <!-- Üzerine Gelince Oynatma Simgesi Gözüksün -->
    <span class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-0 transition group-hover:bg-opacity-20">
        <span class="flex h-12 w-12 scale-75 items-center justify-center rounded-full bg-white bg-opacity-95 text-red-600 opacity-0 shadow-xl transition group-hover:scale-100 group-hover:opacity-100">
            <i class="bi bi-play-fill text-2xl"></i>
        </span>
    </span>
</a>

<div class="flex min-w-0 gap-3 p-4">
    <!-- Kanal Profil Resmi -->
    <a href="<?= $this->escape($video->channel->url) ?>" class="shrink-0">
        <img src="<?= $this->escape($video->channel->avatar) ?>" alt="<?= $this->escape($video->channel->title) ?>" loading="lazy" class="h-10 w-10 rounded-full border border-slate-200 object-cover">
    </a>
    <div class="min-w-0 flex-1">
        <!-- Video Başlığı -->
        <a href="<?= $this->escape($video->url) ?>" title="<?= $this->escape($video->title) ?>" class="line-clamp-2 text-sm font-bold leading-5 text-slate-950 transition hover:text-red-600 sm:text-base">
            <?= $this->escape($video->title) ?>
        </a>
        <!-- Kanal İsmi -->
        <a href="<?= $this->escape($video->channel->url) ?>" title="<?= $this->escape($video->channel->title) ?>" class="mt-1 block truncate text-sm font-medium text-slate-500 transition hover:text-slate-900">
            <?= $this->escape($video->channel->title) ?>
        </a>
        <!-- Video Bilgileri -->
        <p title="<?= $video->viewCount ?> görüntüleme · <?= $this->escape($video->date) ?>" class="mt-0.5 truncate text-xs text-slate-500">
            <?= $this->escape($video->viewCountFormatted) ?> görüntüleme · <?= $this->escape($video->dateFormatted) ?>
        </p>
    </div>
</div>