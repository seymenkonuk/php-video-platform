<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var bool $current */
/** @var \App\Support\DTOs\Playlist\ItemDTO $video */
?>

<!-- CONTENT -->
<a href="<?= $this->escape($video->url) ?>" class="group flex min-w-0 items-center gap-2 rounded-xl p-2 transition <?= $current ? 'bg-red-50' : 'hover:bg-slate-50' ?>">
    <span class="flex w-6 shrink-0 items-center justify-center text-xs font-black <?= $current ? 'text-red-600' : 'text-slate-400' ?>">
        <!-- Sıra No -->
        <?php if ($current): ?>
            <i class="bi bi-play-fill text-lg"></i>
        <?php else: ?>
            <?= $video->order ?? "" ?>
        <?php endif ?>
    </span>

    <div class="relative aspect-video w-28 shrink-0 overflow-hidden rounded-lg bg-slate-100">
        <!-- Thumbnail Resmi -->
        <img src="<?= $this->escape($video->thumbnail) ?>" alt="<?= $this->escape($video->title) ?>" loading="lazy" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
        <!-- Süre Bilgisi -->
        <span class="absolute bottom-1 right-1 rounded bg-black bg-opacity-80 px-1.5 py-0.5 text-[10px] font-bold text-white">
            <?= $this->escape($video->durationFormatted) ?>
        </span>
    </div>

    <div class="min-w-0 flex-1">
        <!-- Video Başlığı -->
        <h3 title="<?= $this->escape($video->title) ?>" class="line-clamp-2 text-sm font-bold leading-5 <?= $current ? 'text-red-700' : 'text-slate-950' ?>">
            <?= $this->escape($video->title) ?>
        </h3>
        <!-- Kanal Başlığı -->
        <p title="<?= $this->escape($video->channel->title) ?>" class="mt-1 truncate text-xs text-slate-500">
            <?= $this->escape($video->channel->title) ?>
        </p>
    </div>
</a>