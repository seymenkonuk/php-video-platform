<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\DTOs\Music\DetailsDTO $music */
/** @var \Generator<int, \App\Support\DTOs\Playlist\OptionDTO> $playlists */
?>

<!-- CONSTANTS -->
<?php
$likeUrl = $music->url . "/like";
$dislikeUrl = $music->url . "/dislike";
$watchLaterUrl = $music->url . "/watch-later";
$addData = json_encode(["media" => $music->code]) ?: null;
?>

<!-- CONTENT -->
<section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
    <div>
        <!-- Müzik Başlığı -->
        <h1 class="text-xl font-black leading-8 tracking-tight text-slate-950 sm:text-2xl">
            <?= $this->escape($music->title) ?>
        </h1>
        <!-- Müzik Bilgileri -->
        <p title="<?= $music->viewCount ?> görüntüleme · <?= $this->escape($music->date) ?>" class="mt-2 text-sm text-slate-500">
            <?= $this->escape($music->viewCountFormatted) ?> görüntüleme · <?= $this->escape($music->dateFormatted) ?>
        </p>
    </div>

    <div class="mt-5 border-t border-slate-100 pt-5">
        <div class="flex flex-col gap-5 xl:flex-row xl:items-center xl:justify-between">
            <!-- Kanal -->
            <div class="flex min-w-0 items-center gap-3">
                <!-- Kanal Resmi -->
                <a href="<?= $this->escape($music->channel->url) ?>" class="shrink-0">
                    <img src="<?= $this->escape($music->channel->avatar) ?>" alt="<?= $this->escape($music->channel->title) ?>" class="h-12 w-12 rounded-full border border-slate-200 object-cover">
                </a>
                <!-- Kanal Bilgileri -->
                <div class="min-w-0 flex-1">
                    <!-- Kanal Başlığı -->
                    <a href="<?= $this->escape($music->channel->url) ?>" title="<?= $this->escape($music->channel->title) ?>" class="block truncate text-sm font-black text-slate-950 transition hover:text-red-600">
                        <?= $this->escape($music->channel->title) ?>
                    </a>
                    <!-- Kanal İstatistik -->
                    <p title="<?= $music->channel->subscriberCount ?> abone" class="mt-1 text-xs text-slate-500">
                        <?= $this->escape($music->channel->subscriberCountFormatted) ?> abone
                    </p>
                </div>
                <!-- Abone Ol -->
                <?= $this->insert("Components/Interaction/Subscribe", (array) new \App\Support\ViewProps\Components\Interaction\SubscribeViewProp(
                    channelUrl: $music->channel->url,
                    subscription: $music->channel->subscription,
                )) ?>
            </div>

            <!-- Etkileşimler -->
            <div class="flex flex-wrap items-center gap-2">
                <!-- Beğen / Beğenme -->
                <?= $this->insert("Components/Interaction/VideoReaction", (array) new \App\Support\ViewProps\Components\Interaction\VideoReactionViewProp(
                    likeUrl: $likeUrl,
                    liked: $music->liked,
                    likeCount: $music->likeCount,
                    likeCountFormatted: $music->likeCountFormatted,
                    dislikeUrl: $dislikeUrl,
                    disliked: $music->disliked,
                    dislikeCount: $music->dislikeCount,
                    dislikeCountFormatted: $music->dislikeCountFormatted,
                )) ?>
                <!-- Daha Sonra İzleye Ekle -->
                <?= $this->insert("Components/Interaction/WatchLater", (array) new \App\Support\ViewProps\Components\Interaction\WatchLaterViewProp(
                    url: $watchLaterUrl,
                    inWatchLater: $music->inWatchLater,
                )) ?>
                <!-- Oynatma Listesine Ekle -->
                <?= $this->insert("Components/Interaction/AddToPlaylist", (array) new \App\Support\ViewProps\Components\Interaction\AddToPlaylistViewProp(
                    addData: $addData,
                    playlists: $playlists,
                )) ?>
            </div>
        </div>
    </div>

    <!-- Müzik Açıklaması -->
    <?= $this->insert("Components/Music/Description", (array) new \App\Support\ViewProps\Components\Music\DescriptionViewProp(
        description: $music->description,
    )) ?>

</section>