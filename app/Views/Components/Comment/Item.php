<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\DTOs\Comment\ItemDTO $comment */
?>

<!-- CONSTANTS -->
<?php
$likeUrl = $comment->url . "/like";
$dislikeUrl = $comment->url . "/dislike";
$deleteUrl = $comment->url . "/delete";
?>

<!-- CONTENT -->
<article class="flex min-w-0 items-start gap-3 py-5 first:pt-0 last:pb-0">
    <!-- Kanal Resmi -->
    <a href="<?= $this->escape($comment->channel->url) ?>" class="shrink-0">
        <img src="<?= $this->escape($comment->channel->avatar) ?>" alt="<?= $this->escape($comment->channel->title) ?>" class="h-10 w-10 rounded-full border border-slate-200 object-cover">
    </a>

    <div class="min-w-0 flex-1">
        <div class="flex flex-wrap items-center gap-x-2 gap-y-1">
            <!-- Kanal İsmi -->
            <a href="<?= $this->escape($comment->channel->url) ?>" title="<?= $this->escape($comment->channel->title) ?>" class="text-sm font-black text-slate-950 transition hover:text-red-600">
                <?= $this->escape($comment->channel->title) ?>
            </a>
            <!-- İçerik Sahibi Badge -->
            <?php if ($comment->isVideoOwner): ?>
                <span class="rounded bg-slate-900 px-1.5 py-0.5 text-[10px] font-bold uppercase tracking-wide text-white">
                    Sahibi
                </span>
            <?php endif ?>
            <!-- Tarih -->
            <span title="<?= $this->escape($comment->date) ?>" class="text-xs text-slate-400">
                <?= $this->escape($comment->dateFormatted) ?>
            </span>
            <!-- Düzenlendi Badge -->
            <?php if ($comment->edited): ?>
                <span class="text-xs text-slate-400">düzenlendi</span>
            <?php endif ?>
        </div>
        <!-- Mesaj -->
        <p class="mt-2 whitespace-pre-line break-words text-sm leading-6 text-slate-700">
            <?= $this->escape($comment->message) ?>
        </p>
        <!-- Beğen ve Beğenme Butonu -->
        <?= $this->insert("Components/Interaction/CommentReaction", (array) new \App\Support\ViewProps\Components\Interaction\CommentReactionViewProp(
            likeUrl: $likeUrl,
            liked: $comment->liked,
            likeCount: $comment->likeCount,
            likeCountFormatted: $comment->likeCountFormatted,
            dislikeUrl: $dislikeUrl,
            disliked: $comment->disliked,
            dislikeCount: $comment->dislikeCount,
            dislikeCountFormatted: $comment->dislikeCountFormatted,
        )) ?>
        <!-- Silme Butonu -->
        <?php if ($comment->isOwner): ?>
            <?= $this->insert("Components/Interaction/Delete", (array) new \App\Support\ViewProps\Components\Interaction\DeleteViewProp(
                url: $deleteUrl,
                data: "",
                title: "Sil",
                parentDepth: 2,
            )) ?>
        <?php endif ?>
    </div>
</article>