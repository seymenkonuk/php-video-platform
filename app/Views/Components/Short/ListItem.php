<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\DTOs\Short\ListItemDTO $short  */
?>

<!-- CONTENT -->
<article class="group flex min-w-0 gap-4 rounded-2xl border border-slate-200 bg-white p-3 shadow-sm transition hover:border-slate-300 hover:shadow-md">
    <!-- Sıra Numarası (Varsa) -->
    <?php if ($short->order !== null): ?>
        <span class="hidden w-7 shrink-0 self-center text-center text-sm font-black text-slate-400 sm:block">
            <?= $short->order ?>
        </span>
    <?php endif ?>
    <!-- Short Kapak Resmi -->
    <a href="<?= $this->escape($short->url) ?>" class="relative h-36 w-24 shrink-0 overflow-hidden rounded-xl bg-slate-100 sm:h-40 sm:w-28">
        <img src="<?= $this->escape($short->thumbnail) ?>" alt="<?= $this->escape($short->title) ?>" loading="lazy" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
        <!-- Short Süresi -->
        <span class="absolute bottom-2 right-2 rounded bg-black bg-opacity-75 px-1.5 py-0.5 text-xs font-bold text-white">
            <?= $this->escape($short->durationFormatted) ?>
        </span>
    </a>
    <!-- Short Bilgileri -->
    <div class="min-w-0 flex-1 py-1">
        <!-- Short Başlığı -->
        <a href="<?= $this->escape($short->url) ?>" title="<?= $this->escape($short->title) ?>" class="line-clamp-2 text-base font-bold text-slate-950 hover:text-red-600 sm:text-lg">
            <?= $this->escape($short->title) ?>
        </a>
        <!-- Kanal Bilgileri -->
        <a href="<?= $this->escape($short->channel->url) ?>" title="<?= $this->escape($short->channel->title) ?>" class="mt-3 flex w-fit min-w-0 items-center gap-2 text-sm font-semibold text-slate-600 hover:text-red-600">
            <!-- Kanal Resmi -->
            <img src="<?= $this->escape($short->channel->avatar) ?>" alt="<?= $this->escape($short->channel->title) ?>" loading="lazy" class="h-7 w-7 rounded-full object-cover">
            <!-- Kanal Başlığı -->
            <span class="truncate">
                <?= $this->escape($short->channel->title) ?>
            </span>
        </a>
        <!-- Görüntüleme Sayısı -->
        <p title="<?= $short->viewCount ?> görüntüleme · <?= $this->escape($short->date) ?>" class="mt-2 text-xs text-slate-500">
            <?= $this->escape($short->viewCountFormatted) ?> görüntüleme · <?= $this->escape($short->dateFormatted) ?>
        </p>
    </div>
</article>