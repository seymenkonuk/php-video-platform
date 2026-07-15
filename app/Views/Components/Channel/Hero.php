<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\DTOs\Channel\HeaderDTO $header  */
/** @var ?string $activeNav  */
/** @var array<\App\Support\DTOs\UI\MenuItemDTO> $navItems  */
?>

<!-- DEFAULT VALUE -->
<?php
$activeNav ??= null;
?>

<!-- CONTENT -->
<div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
    <div class="relative aspect-[3/1] min-h-36 overflow-hidden bg-slate-200 sm:aspect-[4/1]">
        <!-- Banner Resmi -->
        <img src="<?= $this->escape($header->banner) ?>" alt="<?= $this->escape($header->title) ?>" class="h-full w-full object-cover">
        <!-- Alttaki Siyahlık -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/35 to-transparent"></div>
    </div>

    <div class="relative px-5 pb-5 sm:px-8">
        <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
            <div class="flex min-w-0 flex-col items-center text-center sm:flex-row sm:items-end sm:text-left">
                <!-- Kanal Resmi -->
                <img src="<?= $this->escape($header->avatar) ?>" alt="<?= $this->escape($header->title) ?>" class="-mt-12 h-24 w-24 shrink-0 rounded-full border-4 border-white object-cover shadow-lg sm:-mt-14 sm:h-28 sm:w-28">
                <div class="mt-3 min-w-0 sm:mb-2 sm:ml-5 sm:mt-0">
                    <!-- Kanal Başlığı -->
                    <h1 title="<?= $this->escape($header->title) ?>" class="truncate text-2xl font-black tracking-tight text-slate-950 sm:text-3xl">
                        <?= $this->escape($header->title) ?>
                    </h1>
                    <!-- Kanal Bilgileri -->
                    <p title="<?= $header->subscriberCount ?> abone · <?= $header->videoCount ?> video" class="mt-1 text-sm text-slate-500">
                        <?= $this->escape($header->subscriberCountFormatted) ?> abone · <?= $this->escape($header->videoCountFormatted) ?> video
                    </p>
                </div>
            </div>
            <!-- Abone Ol Butonu vb. Eklenecek -->
            <div class="flex w-full sm:mb-2 sm:w-auto">
            </div>
        </div>
    </div>

    <!-- Nav Item'ları Yerleştir -->
    <nav class="flex gap-1 overflow-x-auto border-t border-slate-100 px-3 py-2 sm:px-6" aria-label="Kanal menüsü">
        <?php foreach ($navItems as $navItem): ?>
            <?php $isActive = $activeNav === $navItem->href; ?>
            <a href="<?= $this->escape($navItem->href) ?>" class="shrink-0 rounded-xl px-3 py-2 text-sm font-semibold transition <?= $isActive ? 'bg-red-50 text-red-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-950' ?>">
                <?= $this->escape($navItem->text) ?>
            </a>
        <?php endforeach ?>
    </nav>
</div>