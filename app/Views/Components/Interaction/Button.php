<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var string $url */
/** @var ?string $data */
/** @var string $title */
/** @var string $class */
/** @var ?bool $disabled */
/** @var ?bool $grouped */
?>

<!-- DEFAULT VALUE -->
<?php
$data ??= "";
$disabled ??= false;
$grouped ??= false;
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
        onclick="replaceWithFetch(this, this.parentElement<?= $grouped ? '.parentElement' : ''  ?>)"
        class="<?= $this->escape($class) ?>"
        <?= $disabled ? 'disabled' : '' ?>>
        <?= $this->section("content") ?>
    </button>
</span>