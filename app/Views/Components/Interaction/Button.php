<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var string $url */
/** @var ?string $data */
/** @var string $title */
/** @var string $class */
/** @var bool $disabled */
/** @var int $parentDepth */
?>

<!-- CONSTANTS -->
<?php
$hasData = isset($data) && $data !== "";
$parentDepth += 1;
$targetElement = "this" . str_repeat(".parentElement", $parentDepth);
?>

<!-- CONTENT -->
<span>
    <button
        type="button"

        data-url="<?= $this->escape($url) ?>"
        <?php if ($hasData): ?>
        data-data="<?= $this->escape($data) ?>"
        <?php endif ?>

        title="<?= $this->escape($title) ?>"
        class="<?= $this->escape($class) ?>"

        onclick="replaceWithFetch(this, <?= $targetElement ?>)"

        <?= $disabled ? 'disabled' : '' ?>>
        <?= $this->section("content") ?>
    </button>
</span>