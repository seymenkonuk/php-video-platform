<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\DTOs\ShortCardDTO $short  */
?>

<!-- LAYOUT -->
<?= $this->layout("Components/Common/Card") ?>

<!-- CONTENT -->
<a href="<?= $this->escape($short->url) ?>" class="relative block aspect-[9/16] overflow-hidden bg-slate-100">
    <!-- Short Kapak Resmi -->
    <img src="<?= $this->escape($short->thumbnail) ?>" alt="<?= $this->escape($short->title) ?>" loading="lazy" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
    <!-- Alttaki Siyahlık  -->
    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-80"></div>
    <!-- Sol Üste Short İkonu -->
    <span class="absolute left-3 top-3 flex h-9 w-9 items-center justify-center rounded-full bg-red-600 text-white shadow">
        <i class="bi bi-lightning-charge-fill"></i>
    </span>
    <!-- Short Bilgileri -->
    <div class="absolute inset-x-0 bottom-0 p-4 text-white">
        <!-- Short Başlığı -->
        <h2 title="<?= $this->escape($short->title) ?>" class="line-clamp-2 text-sm font-bold leading-5 sm:text-base">
            <?= $this->escape($short->title) ?>
        </h2>
        <!-- Short Kanal İsmi -->
        <p title="<?= $this->escape($short->channel->title) ?>" class="mt-1 truncate text-xs text-slate-200">
            <?= $this->escape($short->channel->title) ?>
        </p>
        <!-- Görüntüleme Sayısı -->
        <p title="<?= $this->escape($short->viewCount) ?> görüntüleme" class="mt-1 text-xs text-slate-300">
            <?= $this->escape($short->viewCountFormatted) ?> görüntüleme
        </p>
    </div>
    <!-- Short Süresi -->
    <span class="absolute right-3 top-3 rounded-md bg-black bg-opacity-70 px-2 py-1 text-xs font-bold text-white">
        <?= $this->escape($short->durationFormatted) ?>
    </span>
</a>