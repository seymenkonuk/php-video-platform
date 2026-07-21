<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var string $url */
/** @var bool $disliked */
/** @var int $dislikeCount */
/** @var string $dislikeCountFormatted */
/** @var ?int $parentDepth */
?>

<!-- DEFAULT VALUE -->
<?php
$parentDepth ??= 0;
?>

<!-- CONSTANTS -->
<?php
$title = $disliked ? "Beğenmemeyi kaldır" : "Beğenme";
$icon = $disliked ? "bi-hand-thumbs-down-fill" : "bi-hand-thumbs-down";
$class = $disliked ? "bg-red-50 text-red-700" : "text-slate-600 hover:bg-slate-100 hover:text-red-600";
?>

<!-- LAYOUT -->
<?= $this->layout("Components/Interaction/Button", [
    "url" => $url,
    "title" => $title,
    "class" => "inline-flex h-9 items-center justify-center gap-1.5 rounded-lg px-2.5 text-xs font-bold transition $class",
    "parentDepth" => $parentDepth,
]) ?>

<!-- CONTENT -->
<i class="bi <?= $this->escape($icon) ?>"></i>
<span title="<?= $dislikeCount ?> beğenmeme">
    <?= $this->escape($dislikeCountFormatted) ?>
</span>