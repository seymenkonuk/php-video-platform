<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var string $url */
/** @var ?string $data */
/** @var string $title */
/** @var string $class */
/** @var string $inputClass */
/** @var bool $checked */
/** @var bool $disabled */
/** @var int $parentDepth */
?>

<!-- CONSTANTS -->
<?php
$hasData = isset($data) && $data !== "";
$parentDepth += 2;
$targetElement = "this" . str_repeat(".parentElement", $parentDepth);
?>

<!-- CONTENT -->
<span>
    <label class="<?= $this->escape($class) ?>">
        <input
            type="checkbox"

            data-url="<?= $this->escape($url) ?>"
            <?php if ($hasData): ?>
            data-data="<?= $this->escape($data) ?>"
            <?php endif ?>

            title="<?= $this->escape($title) ?>"
            class="<?= $this->escape($inputClass) ?>"

            onchange="replaceWithFetch(this, <?= $targetElement ?>)"

            <?= $checked ? 'checked' : '' ?>
            <?= $disabled ? 'disabled' : '' ?>>
        <?= $this->section("content") ?>
    </label>
</span>