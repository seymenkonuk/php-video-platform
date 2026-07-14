<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\DTOs\VideoListItemDTO $video  */
?>

<!-- CONTENT -->
<article class="group flex min-w-0 flex-col gap-4 rounded-2xl border border-slate-200 bg-white p-3 shadow-sm transition hover:border-slate-300 hover:shadow-md sm:flex-row sm:items-center">
    <!-- Sıra Numarası (Varsa) -->
    <?php if ($video->order !== null): ?>
        <span class="hidden w-8 shrink-0 text-center text-sm font-black text-slate-400 sm:block">
            <?= $this->escape($video->order) ?>
        </span>
    <?php endif ?>
    <!-- Video Kapak Resmi -->
    <a href="<?= $this->escape($video->url) ?>" class="relative block aspect-video w-full shrink-0 overflow-hidden rounded-xl bg-slate-100 sm:w-56 lg:w-64">
        <img src="<?= $this->escape($video->thumbnail) ?>" alt="<?= $this->escape($video->title) ?>" loading="lazy" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
        <!-- Video Süresi -->
        <span class="absolute bottom-2 right-2 rounded-md bg-black bg-opacity-80 px-2 py-1 text-xs font-bold text-white">
            <?= $this->escape($video->durationFormatted) ?>
        </span>
    </a>
    <!-- Video Bilgileri  -->
    <div class="min-w-0 flex-1 px-1 pb-1 sm:px-0 sm:pb-0">
        <!-- Video Başlığı -->
        <a href="<?= $this->escape($video->url) ?>" title="<?= $this->escape($video->title) ?>" class="line-clamp-2 text-base font-bold leading-6 text-slate-950 transition hover:text-red-600 sm:text-lg">
            <?= $this->escape($video->title) ?>
        </a>
        <!-- Kanal Bilgileri -->
        <a href="<?= $this->escape($video->channel->url) ?>" title="<?= $this->escape($video->channel->title) ?>" class="mt-2 flex w-fit min-w-0 items-center gap-2 text-sm font-semibold text-slate-600 hover:text-red-600">
            <!-- Kanal Resmi -->
            <img src="<?= $this->escape($video->channel->avatar) ?>" alt="<?= $this->escape($video->channel->title) ?>" loading="lazy" class="h-7 w-7 rounded-full object-cover">
            <!-- Kanal Başlığı -->
            <span class="truncate">
                <?= $this->escape($video->channel->title) ?>
            </span>
        </a>
        <!-- Görüntüleme Sayısı -->
        <p title="<?= $this->escape($video->viewCount) ?> görüntüleme · <?= $this->escape($video->date) ?>" class="mt-2 text-xs text-slate-500">
            <?= $this->escape($video->viewCountFormatted) ?> görüntüleme · <?= $this->escape($video->dateFormatted) ?>
        </p>
    </div>
</article>