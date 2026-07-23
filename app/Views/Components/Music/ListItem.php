<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\DTOs\Media\ListItemDTO $music  */
?>

<!-- CONTENT -->
<article class="group flex min-w-0 items-center gap-3 rounded-2xl border border-slate-200 bg-white p-3 shadow-sm transition hover:border-slate-300 hover:shadow-md">
    <!-- Sıra Numarası (Varsa) -->
    <?php if ($music->order !== null): ?>
        <span class="hidden w-7 shrink-0 text-center text-sm font-black text-slate-400 sm:block">
            <?= $music->order ?>
        </span>
    <?php endif ?>
    <!-- Müzik Kapak Resmi -->
    <a href="<?= $this->escape($music->url) ?>" class="relative h-20 w-20 shrink-0 overflow-hidden rounded-xl bg-slate-100 sm:h-24 sm:w-24">
        <img src="<?= $this->escape($music->thumbnail) ?>" alt="<?= $this->escape($music->title) ?>" loading="lazy" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
        <!-- Üzerine Gelindiğinde Oynatma İkonu Çıksın -->
        <span class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-0 text-white opacity-0 transition group-hover:bg-opacity-25 group-hover:opacity-100">
            <i class="bi bi-play-fill text-3xl"></i>
        </span>
    </a>
    <!-- Müzik Bilgileri -->
    <div class="min-w-0 flex-1">
        <!-- Müzik Başlığı -->
        <a href="<?= $this->escape($music->url) ?>" title="<?= $this->escape($music->title) ?>" class="line-clamp-2 font-bold text-slate-950 hover:text-red-600">
            <?= $this->escape($music->title) ?>
        </a>
        <!-- Kanal Başlığı -->
        <a href="<?= $this->escape($music->channel->url) ?>" title="<?= $this->escape($music->channel->title) ?>" class="mt-1 block truncate text-sm text-slate-500 hover:text-red-600">
            <?= $this->escape($music->channel->title) ?>
        </a>
        <!-- Görüntüleme Sayısı -->
        <p title="<?= $music->viewCount ?> dinlenme · <?= $this->escape($music->date) ?>" class="mt-1 truncate text-xs text-slate-400">
            <?= $this->escape($music->viewCountFormatted) ?> dinlenme · <?= $this->escape($music->dateFormatted) ?>
        </p>
    </div>
    <!-- Müzik Süresi -->
    <span class="shrink-0 text-xs font-semibold text-slate-500">
        <?= $this->escape($music->durationFormatted) ?>
    </span>
</article>