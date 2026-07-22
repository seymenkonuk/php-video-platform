<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var string $url */
/** @var bool $liked */
/** @var int $likeCount */
/** @var string $likeCountFormatted */
/** @var int $parentDepth */
?>

<!-- CONSTANTS -->
<?php
$title = $liked ? "Beğenmekten vazgeç" : "Beğen";
$icon = $liked ? "bi-hand-thumbs-up-fill" : "bi-hand-thumbs-up";
$class = $liked ? "bg-red-50 text-red-700" : "text-slate-700 hover:bg-slate-50 hover:text-red-600";
?>

<!-- LAYOUT -->
<?= $this->layout("Components/Interaction/Button", (array) new \App\Support\ViewProps\Components\Interaction\ButtonViewProp(
    url: $url,
    data: null,
    title: $title,
    class: "inline-flex min-h-10 items-center justify-center gap-2 px-4 py-2.5 text-sm font-semibold transition $class",
    disabled: false,
    parentDepth: $parentDepth,
)) ?>

<!-- CONTENT -->
<i class="bi <?= $this->escape($icon) ?>"></i>
<span title="<?= $likeCount ?> beğeni">
    <?= $this->escape($likeCountFormatted) ?>
</span>