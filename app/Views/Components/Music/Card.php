<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\DTOs\MusicCardDTO $music  */
?>

<!-- LAYOUT -->
<?= $this->layout("Components/Common/Card") ?>

<!-- CONTENT -->
<a href="<?= $this->escape($music->url) ?>" class="relative block aspect-square overflow-hidden bg-slate-100">
    <!-- Müzik Kapak Resmi -->
    <img src="<?= $this->escape($music->thumbnail) ?>" alt="<?= $this->escape($music->title) ?>" loading="lazy" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
    <!-- Alttaki Siyahlık -->
    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-70"></div>
    <!-- Sol Üste Müzik İkonu -->
    <span class="absolute left-3 top-3 flex h-9 w-9 items-center justify-center rounded-full bg-white bg-opacity-90 text-red-600 shadow">
        <i class="bi bi-music-note-beamed"></i>
    </span>
    <!-- Müzik Süresi -->
    <span class="absolute bottom-3 right-3 rounded-md bg-black bg-opacity-80 px-2 py-1 text-xs font-bold text-white">
        <?= $this->escape($music->durationFormatted) ?>
    </span>
</a>

<div class="p-4">
    <!-- Müzik Başlığı -->
    <a href="<?= $this->escape($music->url) ?>" title="<?= $this->escape($music->title) ?>" class="line-clamp-2 font-bold text-slate-950 transition hover:text-red-600">
        <?= $this->escape($music->title) ?>
    </a>
    <!-- Kanal Bilgileri -->
    <a href="<?= $this->escape($music->channel->url) ?>" title="<?= $this->escape($music->channel->title) ?>" class="mt-3 flex min-w-0 items-center gap-2 text-sm font-medium text-slate-600 hover:text-red-600">
        <img src="<?= $this->escape($music->channel->avatar) ?>" alt="<?= $this->escape($music->channel->title) ?>" loading="lazy" class="h-8 w-8 rounded-full object-cover">
        <span class="truncate"><?= $this->escape($music->channel->title) ?></span>
    </a>
    <!-- Müzik Bilgileri -->
    <p title="<?= $this->escape($music->viewCount) ?> dinlenme · <?= $this->escape($music->date) ?>" class="mt-2 truncate text-xs text-slate-500">
        <?= $this->escape($music->viewCountFormatted) ?> dinlenme · <?= $this->escape($music->dateFormatted) ?>
    </p>
</div>