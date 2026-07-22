<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var ?string $leftText  */
/** @var string $href  */
/** @var string $link  */
/** @var ?string $rightText  */
?>

<!-- CONSTANTS -->
<?php
$hasLeftText = isset($leftText) && $leftText !== "";
$hasRightText = isset($rightText) && $rightText !== "";
?>

<!-- CONTENT -->
<p class="pt-1 text-center text-sm text-slate-500">
    <!-- Soldaki Normal Yazı -->
    <?php if ($hasLeftText): ?>
        <?= $this->escape($leftText) ?>
    <?php endif ?>
    <!-- Tıklanabilir Yazı -->
    <a href="<?= $this->escape($href) ?>" class="font-bold text-red-600 transition hover:text-red-700 hover:underline">
        <?= $this->escape($link) ?>
    </a>
    <!-- Sağdaki Normal Yazı -->
    <?php if ($hasRightText): ?>
        <?= $this->escape($rightText) ?>
    <?php endif ?>
</p>