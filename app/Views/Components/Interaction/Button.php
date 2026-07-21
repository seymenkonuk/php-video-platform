<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var string $url */
/** @var ?string $data */
/** @var string $title */
/** @var string $class */
/** @var ?bool $disabled */
/** @var ?int $parentDepth */
?>

<!-- DEFAULT VALUE -->
<?php
$data ??= "";
$disabled ??= false;
$parentDepth ??= 0;
?>

<!-- CONSTANTS -->
<?php
$parentDepth += 1;
$targetElement = "this" . str_repeat(".parentElement", $parentDepth);
?>

<!-- CONTENT -->
<span>
    <button
        type="button"
        data-url="<?= $this->escape($url) ?>"
        <?php if ($data !== ""): ?>
        data-data="<?= $this->escape($data) ?>"
        <?php endif ?>
        title="<?= $this->escape($title) ?>"
        onclick="replaceWithFetch(this, <?= $targetElement ?>)"
        class="<?= $this->escape($class) ?>"
        <?= $disabled ? 'disabled' : '' ?>>
        <?= $this->section("content") ?>
    </button>
</span>