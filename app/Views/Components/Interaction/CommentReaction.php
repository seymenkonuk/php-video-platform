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
<div class="mt-3 flex items-center gap-1">
    <?= $this->insert("Components/Interaction/CommentLike", [
        "url" => $likeUrl,
        "liked" => $liked,
        "likeCount" => $likeCount,
        "likeCountFormatted" => $likeCountFormatted,
    ]) ?>

    <?= $this->insert("Components/Interaction/CommentDislike", [
        "url" => $dislikeUrl,
        "disliked" => $disliked,
        "dislikeCount" => $dislikeCount,
        "dislikeCountFormatted" => $dislikeCountFormatted,
    ]) ?>
</div>