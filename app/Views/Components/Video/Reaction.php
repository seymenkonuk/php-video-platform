<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var string $likeUrl */
/** @var bool $liked */
/** @var int $likeCount */
/** @var string $likeCountFormatted */
/** @var string $dislikeUrl */
/** @var bool $disliked */
/** @var int $dislikeCount */
/** @var string $dislikeCountFormatted */
?>

<!-- CONTENT -->
<div class="inline-flex overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
    <?= $this->insert("Components/Interaction/Like", [
        "url" => $likeUrl,
        "liked" => $liked,
        "likeCount" => $likeCount,
        "likeCountFormatted" => $likeCountFormatted,
    ]) ?>

    <span class="my-2 w-px bg-slate-200"></span>

    <?= $this->insert("Components/Interaction/Dislike", [
        "url" => $dislikeUrl,
        "disliked" => $disliked,
        "dislikeCount" => $dislikeCount,
        "dislikeCountFormatted" => $dislikeCountFormatted,
    ]) ?>
</div>