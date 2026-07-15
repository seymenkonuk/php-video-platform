<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\DTOs\Playlist\ListItemDTO $playlist  */
?>

<!-- CONTENT -->
<article class="group flex min-w-0 flex-col gap-4 rounded-2xl border border-slate-200 bg-white p-3 shadow-sm transition hover:border-slate-300 hover:shadow-md sm:flex-row sm:items-center">
    <!-- Sıra Numarası (Varsa) -->
    <?php if ($playlist->order !== null): ?>
        <span class="hidden w-8 shrink-0 text-center text-sm font-black text-slate-400 sm:block">
            <?= $playlist->order ?>
        </span>
    <?php endif ?>
    <!-- Oynatma Listesi Kapak Resmi -->
    <a href="<?= $this->escape($playlist->url) ?>" class="relative block aspect-video w-full shrink-0 overflow-hidden rounded-xl bg-slate-100 sm:w-56 lg:w-64">
        <img src="<?= $this->escape($playlist->banner) ?>" alt="<?= $this->escape($playlist->title) ?>" loading="lazy" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
        <!-- Yandaki Siyahlık  -->
        <span class="absolute inset-y-0 right-0 flex w-1/3 flex-col items-center justify-center bg-black bg-opacity-65 text-white">
            <!-- Ortasına İkon -->
            <i class="bi bi-list-ul text-xl"></i>
            <!-- Altına Video Sayısı -->
            <span title="<?= $playlist->videoCount ?>" class="mt-1 text-xs font-bold">
                <?= $this->escape($playlist->videoCountFormatted) ?>
            </span>
        </span>
    </a>
    <!-- Oynatma Listesi Bilgileri  -->
    <div class="min-w-0 flex-1">
        <!-- Oynatma Listesi Başlığı -->
        <a href="<?= $this->escape($playlist->url) ?>" title="<?= $this->escape($playlist->title) ?>" class="line-clamp-2 text-base font-bold text-slate-950 hover:text-red-600 sm:text-lg">
            <?= $this->escape($playlist->title) ?>
        </a>
        <!-- Kanal Bilgileri -->
        <a href="<?= $this->escape($playlist->channel->url) ?>" title="<?= $this->escape($playlist->channel->title) ?>" class="mt-3 flex w-fit min-w-0 items-center gap-2 text-sm font-semibold text-slate-600 hover:text-red-600">
            <!-- Kanal Resmi -->
            <img src="<?= $this->escape($playlist->channel->avatar) ?>" alt="<?= $this->escape($playlist->channel->title) ?>" loading="lazy" class="h-7 w-7 rounded-full object-cover">
            <span class="truncate">
                <?= $this->escape($playlist->channel->title) ?>
            </span>
        </a>
        <!-- Video Sayısı -->
        <p title="<?= $playlist->videoCount ?> video" class="mt-2 text-xs text-slate-500">
            <?= $this->escape($playlist->videoCountFormatted) ?> video
        </p>
    </div>
</article>