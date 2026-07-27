<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\DTOs\Playlist\PanelDTO $activePlaylist */
?>

<!-- CONTENT -->
<aside class="min-w-0 2xl:sticky 2xl:top-24">
    <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-100 p-5">
            <div class="flex items-start justify-between gap-4">
                <div class="min-w-0">
                    <!-- Başlık -->
                    <p class="text-xs font-bold uppercase tracking-widest text-red-600">
                        Oynatma listesi
                    </p>
                    <!-- Oynatma Listesi Başlığı -->
                    <a href="<?= $this->escape($activePlaylist->url) ?>" title="<?= $this->escape($activePlaylist->title) ?>" class="mt-2 line-clamp-2 block text-lg font-black leading-6 text-slate-950 transition hover:text-red-600">
                        <?= $this->escape($activePlaylist->title) ?>
                    </a>
                </div>
                <!-- Oynatma Listesini Aç İkonu -->
                <a href="<?= $this->escape($activePlaylist->url) ?>" title="Oynatma listesini aç" class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-600 shadow-sm transition hover:border-red-200 hover:bg-red-50 hover:text-red-700">
                    <i class="bi bi-box-arrow-up-right"></i>
                </a>
            </div>

            <!-- Kanal Bilgisi -->
            <a href="<?= $this->escape($activePlaylist->channel->url) ?>" title="<?= $this->escape($activePlaylist->channel->title) ?>" class="mt-4 flex w-fit min-w-0 items-center gap-2 text-sm font-semibold text-slate-600 transition hover:text-red-600">
                <!-- Kanal Resmi -->
                <img src="<?= $this->escape($activePlaylist->channel->avatar) ?>" alt="<?= $this->escape($activePlaylist->channel->title) ?>" class="h-7 w-7 rounded-full object-cover">
                <!-- Kanal Başlığı -->
                <span class="truncate"><?= $this->escape($activePlaylist->channel->title) ?></span>
            </a>

            <div class="mt-4 flex items-center justify-between gap-3 text-xs text-slate-500">
                <!-- Oynatma Listesi Video Durumu -->
                <span class="font-bold text-slate-700">
                    <?= $activePlaylist->currentIndex ?> / <?= $activePlaylist->videoCount ?>
                </span>
                <!-- Oynatma Listesi Görüntüleme Türü -->
                <span class="inline-flex items-center gap-1">
                    <i class="bi <?= $this->escape($activePlaylist->viewType->icon()) ?>"></i>
                    <?= $this->escape($activePlaylist->viewType->label()) ?>
                </span>
            </div>

            <!-- Oynatma Listesi Durum Çubuğu -->
            <progress value="<?= $activePlaylist->currentIndex ?>" max="<?= $activePlaylist->videoCount ?>" class="mt-3 h-1.5 w-full overflow-hidden rounded-full bg-slate-100 accent-red-500">
            </progress>
        </div>

        <?php if ($activePlaylist->items->valid()): ?>
            <!-- Oynatma Listesi Elemanları -->
            <div class="hide-scrollbar max-h-[calc(100vh-18rem)] space-y-1 overflow-y-auto p-2">
                <?php foreach ($activePlaylist->items as $item): ?>
                    <?= $this->insert("Components/Playlist/Item", (array) new \App\Support\ViewProps\Components\Playlist\ItemViewProp(
                        current: $item->order === $activePlaylist->currentIndex,
                        video: $item,
                    )) ?>
                <?php endforeach ?>
            </div>
        <?php endif ?>
    </section>
</aside>