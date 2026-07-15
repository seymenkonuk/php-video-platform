<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\DTOs\Channel\ListItemDTO $channel  */
?>

<!-- CONTENT -->
<article class="flex min-w-0 items-center gap-4 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:border-slate-300 hover:shadow-md">
    <!-- Kanal Resmi -->
    <a href="<?= $this->escape($channel->url) ?>" class="shrink-0">
        <img src="<?= $this->escape($channel->avatar) ?>" alt="<?= $this->escape($channel->title) ?>" loading="lazy" class="h-16 w-16 rounded-full object-cover ring-1 ring-slate-200 sm:h-20 sm:w-20">
    </a>
    <!-- Kanal Bilgileri  -->
    <div class="min-w-0 flex-1">
        <!-- Kanal Başlığı -->
        <a href="<?= $this->escape($channel->url) ?>" title="<?= $this->escape($channel->title) ?>" class="block truncate text-base font-black text-slate-950 hover:text-red-600 sm:text-lg">
            <?= $this->escape($channel->title) ?>
        </a>
        <!-- Abone Sayısı . Video Sayısı -->
        <p title="<?= $this->escape($channel->subscriberCount) ?> abone · <?= $this->escape($channel->videoCount) ?> video" class="mt-1 text-sm text-slate-500">
            <?= $this->escape($channel->subscriberCountFormatted) ?> abone · <?= $this->escape($channel->videoCountFormatted) ?> video
        </p>
    </div>
    <!-- Sağdaki İkon -->
    <a href="<?= $this->escape($channel->url) ?>" class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-slate-700 transition hover:bg-red-600 hover:text-white" aria-label="Kanalı görüntüle">
        <i class="bi bi-arrow-right"></i>
    </a>
</article>