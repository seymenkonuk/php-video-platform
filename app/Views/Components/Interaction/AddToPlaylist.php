<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var ?string $addData */
/** @var \Generator<int, \App\Support\DTOs\Playlist\OptionDTO> $playlists */
?>

<!-- CONTENT -->
<details class="group relative">
    <summary class="inline-flex min-h-10 cursor-pointer list-none items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-red-200 hover:bg-red-50 hover:text-red-700 focus:outline-none focus:ring-4 focus:ring-red-100">
        <i class="bi bi-collection-play"></i>
        <span class="hidden sm:inline">Oynatma listesine ekle</span>
        <i class="bi bi-chevron-down text-xs transition group-open:rotate-180"></i>
    </summary>

    <div class="absolute right-0 z-30 mt-2 w-[min(22rem,calc(100vw-2rem))] overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xl">
        <div class="border-b border-slate-100 px-4 py-4">
            <h2 class="text-sm font-black text-slate-950">Oynatma listesine kaydet</h2>
            <p class="mt-1 text-xs leading-5 text-slate-500">
                Bir listeyi işaretlediğinde değişiklik anında kaydedilir.
            </p>
        </div>

        <div class="max-h-72 space-y-1 overflow-y-auto p-2">
            <?php if ($playlists->valid()): ?>
                <?php foreach ($playlists as $playlist): ?>
                    <?php $addUrl = $playlist->url . "/add" ?>
                    <?php $removeUrl = $playlist->url . "/remove/" . ($playlist->itemId ?? "0") ?>
                    <?= $this->insert("Components/Interaction/PlaylistCheckbox", (array) new \App\Support\ViewProps\Components\Interaction\PlaylistCheckboxViewProp(
                        data: $playlist->checked ? null : $addData,
                        url: $playlist->checked ? $removeUrl : $addUrl,
                        playlist: $playlist,
                    )) ?>
                <?php endforeach ?>
            <?php endif ?>
        </div>
    </div>
</details>