<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\DTOs\Video\DetailsDTO $video */
/** @var \Generator<int, \App\Support\DTOs\Playlist\OptionDTO> $playlists */
?>

<!-- CONSTANTS -->
<?php
$likeUrl = $video->url . "/like";
$dislikeUrl = $video->url . "/dislike";
$watchLaterUrl = $video->url . "/watch-later";
$addData = json_encode(["media" => $video->code]) ?: null;
?>

<!-- CONTENT -->
<section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
    <div>
        <!-- Video Başlığı -->
        <h1 class="text-xl font-black leading-8 tracking-tight text-slate-950 sm:text-2xl">
            <?= $this->escape($video->title) ?>
        </h1>
        <!-- Video Bilgileri -->
        <p title="<?= $video->viewCount ?> görüntüleme · <?= $this->escape($video->date) ?>" class="mt-2 text-sm text-slate-500">
            <?= $this->escape($video->viewCountFormatted) ?> görüntüleme · <?= $this->escape($video->dateFormatted) ?>
        </p>
    </div>

    <div class="mt-5 border-t border-slate-100 pt-5">
        <div class="flex flex-col gap-5 xl:flex-row xl:items-center xl:justify-between">
            <!-- Kanal -->
            <div class="flex min-w-0 items-center gap-3">
                <!-- Kanal Resmi -->
                <a href="<?= $this->escape($video->channel->url) ?>" class="shrink-0">
                    <img src="<?= $this->escape($video->channel->avatar) ?>" alt="<?= $this->escape($video->channel->title) ?>" class="h-12 w-12 rounded-full border border-slate-200 object-cover">
                </a>
                <!-- Kanal Bilgileri -->
                <div class="min-w-0 flex-1">
                    <!-- Kanal Başlığı -->
                    <a href="<?= $this->escape($video->channel->url) ?>" title="<?= $this->escape($video->channel->title) ?>" class="block truncate text-sm font-black text-slate-950 transition hover:text-red-600">
                        <?= $this->escape($video->channel->title) ?>
                    </a>
                    <!-- Kanal İstatistik -->
                    <p title="<?= $video->channel->subscriberCount ?> abone" class="mt-1 text-xs text-slate-500">
                        <?= $this->escape($video->channel->subscriberCountFormatted) ?> abone
                    </p>
                </div>
                <!-- Abone Ol -->
                <?= $this->insert("Components/Interaction/Subscribe", (array) new \App\Support\ViewProps\Components\Interaction\SubscribeViewProp(
                    channelUrl: $video->channel->url,
                    subscription: $video->channel->subscription,
                )) ?>
            </div>

            <!-- Etkileşimler -->
            <div class="flex flex-wrap items-center gap-2">
                <!-- Beğen / Beğenme -->
                <?= $this->insert("Components/Interaction/VideoReaction", (array) new \App\Support\ViewProps\Components\Interaction\VideoReactionViewProp(
                    likeUrl: $likeUrl,
                    liked: $video->liked,
                    likeCount: $video->likeCount,
                    likeCountFormatted: $video->likeCountFormatted,
                    dislikeUrl: $dislikeUrl,
                    disliked: $video->disliked,
                    dislikeCount: $video->dislikeCount,
                    dislikeCountFormatted: $video->dislikeCountFormatted,
                )) ?>
                <!-- Daha Sonra İzleye Ekle -->
                <?= $this->insert("Components/Interaction/WatchLater", (array) new \App\Support\ViewProps\Components\Interaction\WatchLaterViewProp(
                    url: $watchLaterUrl,
                    inWatchLater: $video->inWatchLater,
                )) ?>
                <!-- Oynatma Listesine Ekle -->
                <?= $this->insert("Components/Interaction/AddToPlaylist", (array) new \App\Support\ViewProps\Components\Interaction\AddToPlaylistViewProp(
                    addData: $addData,
                    playlists: $playlists,
                )) ?>
            </div>
        </div>
    </div>

    <!-- Video Açıklaması -->
    <?= $this->insert("Components/Video/Description", (array) new \App\Support\ViewProps\Components\Video\DescriptionViewProp(
        description: $video->description,
    )) ?>

</section>