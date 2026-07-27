<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var string $url */
/** @var ?string $data */
/** @var string $title */
/** @var bool $disabled */
/** @var int $parentDepth */
?>

<!-- LAYOUT -->
<?= $this->layout("Components/Interaction/Button", (array) new \App\Support\ViewProps\Components\Interaction\ButtonViewProp(
    url: $url,
    data: $data,
    title: $title,
    class: "inline-flex items-center gap-1 text-xs font-bold text-slate-500 transition hover:text-red-600",
    disabled: $disabled,
    parentDepth: $parentDepth,
)) ?>

<!-- CONTENT -->
<i class="bi bi-trash3"></i>
<span>Sil</span>