<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\DTOs\Short\DetailsDTO $short */
/** @var \Generator<int, \App\Support\DTOs\Playlist\OptionDTO> $playlists */
?>

<!-- CONSTANTS -->
<?php
$likeUrl = $short->url . "/like";
$dislikeUrl = $short->url . "/dislike";
$watchLaterUrl = $short->url . "/watch-later";
$addData = json_encode(["media" => $short->code]) ?: null;
?>

<!-- CONTENT -->
<section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
    <div>
        <!-- Kısa Video Başlığı -->
        <h1 class="text-xl font-black leading-8 tracking-tight text-slate-950 sm:text-2xl">
            <?= $this->escape($short->title) ?>
        </h1>
        <!-- Kısa Video Bilgileri -->
        <p title="<?= $short->viewCount ?> görüntüleme · <?= $this->escape($short->date) ?>" class="mt-2 text-sm text-slate-500">
            <?= $this->escape($short->viewCountFormatted) ?> görüntüleme · <?= $this->escape($short->dateFormatted) ?>
        </p>
    </div>

    <div class="mt-5 border-t border-slate-100 pt-5">
        <div class="flex flex-col gap-5 xl:flex-row xl:items-center xl:justify-between">
            <!-- Kanal -->
            <div class="flex min-w-0 items-center gap-3">
                <!-- Kanal Resmi -->
                <a href="<?= $this->escape($short->channel->url) ?>" class="shrink-0">
                    <img src="<?= $this->escape($short->channel->avatar) ?>" alt="<?= $this->escape($short->channel->title) ?>" class="h-12 w-12 rounded-full border border-slate-200 object-cover">
                </a>
                <!-- Kanal Bilgileri -->
                <div class="min-w-0 flex-1">
                    <!-- Kanal Başlığı -->
                    <a href="<?= $this->escape($short->channel->url) ?>" title="<?= $this->escape($short->channel->title) ?>" class="block truncate text-sm font-black text-slate-950 transition hover:text-red-600">
                        <?= $this->escape($short->channel->title) ?>
                    </a>
                    <!-- Kanal İstatistik -->
                    <p title="<?= $short->channel->subscriberCount ?> abone" class="mt-1 text-xs text-slate-500">
                        <?= $this->escape($short->channel->subscriberCountFormatted) ?> abone
                    </p>
                </div>
                <!-- Abone Ol -->
                <?= $this->insert("Components/Interaction/Subscribe", (array) new \App\Support\ViewProps\Components\Interaction\SubscribeViewProp(
                    channelUrl: $short->channel->url,
                    subscription: $short->channel->subscription,
                )) ?>
            </div>

            <!-- Etkileşimler -->
            <div class="flex flex-wrap items-center gap-2">
                <!-- Beğen / Beğenme -->
                <?= $this->insert("Components/Interaction/VideoReaction", (array) new \App\Support\ViewProps\Components\Interaction\VideoReactionViewProp(
                    likeUrl: $likeUrl,
                    liked: $short->liked,
                    likeCount: $short->likeCount,
                    likeCountFormatted: $short->likeCountFormatted,
                    dislikeUrl: $dislikeUrl,
                    disliked: $short->disliked,
                    dislikeCount: $short->dislikeCount,
                    dislikeCountFormatted: $short->dislikeCountFormatted,
                )) ?>
                <!-- Daha Sonra İzleye Ekle -->
                <?= $this->insert("Components/Interaction/WatchLater", (array) new \App\Support\ViewProps\Components\Interaction\WatchLaterViewProp(
                    url: $watchLaterUrl,
                    inWatchLater: $short->inWatchLater,
                )) ?>
                <!-- Oynatma Listesine Ekle -->
                <?= $this->insert("Components/Interaction/AddToPlaylist", (array) new \App\Support\ViewProps\Components\Interaction\AddToPlaylistViewProp(
                    addData: $addData,
                    playlists: $playlists,
                )) ?>
            </div>
        </div>
    </div>

    <!-- Kısa Video Açıklaması -->
    <?= $this->insert("Components/Short/Description", (array) new \App\Support\ViewProps\Components\Short\DescriptionViewProp(
        description: $short->description,
    )) ?>

</section>