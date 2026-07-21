<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var string $url */
/** @var bool $liked */
/** @var int $likeCount */
/** @var string $likeCountFormatted */
/** @var ?int $parentDepth */
?>

<!-- DEFAULT VALUE -->
<?php
$parentDepth ??= 0;
?>

<!-- CONSTANTS -->
<?php
$title = $liked ? "Beğenmekten vazgeç" : "Beğen";
$icon = $liked ? "bi-hand-thumbs-up-fill" : "bi-hand-thumbs-up";
$class = $liked ? "bg-red-50 text-red-700" : "text-slate-600 hover:bg-slate-100 hover:text-red-600";
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
<span title="<?= $likeCount ?> beğeni">
    <?= $this->escape($likeCountFormatted) ?>
</span>