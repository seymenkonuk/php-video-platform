<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var string $url */
/** @var ?string $data */
/** @var \App\Support\DTOs\Playlist\OptionDTO $playlist */
?>

<!-- LAYOUT -->
<?= $this->layout("Components/Interaction/Checkbox", (array) new \App\Support\ViewProps\Components\Interaction\CheckboxViewProp(
    url: $url,
    data: $data,
    title: $playlist->title,
    class: "flex cursor-pointer items-center gap-3 rounded-xl px-3 py-3 transition hover:bg-slate-50",
    inputClass: "h-5 w-5 rounded border-slate-300 text-red-600 focus:ring-red-500",
    checked: $playlist->checked,
    parentDepth: 0,
)) ?>

<!-- CONTENT -->
<span class="min-w-0 flex-1">
    <span title="<?= $this->escape($playlist->title) ?>" class="block truncate text-sm font-bold text-slate-800">
        <?= $this->escape($playlist->title) ?>
    </span>

    <span class="mt-1 flex items-center gap-2 text-xs text-slate-500">
        <span class="inline-flex items-center gap-1">
            <i class="bi <?= $this->escape($playlist->viewType->icon()) ?>"></i>
            <?= $this->escape($playlist->viewType->label()) ?>
        </span>
        <span class="text-slate-300">•</span>
        <span><?= $this->escape($playlist->videoCountFormatted) ?> video</span>
    </span>
</span>