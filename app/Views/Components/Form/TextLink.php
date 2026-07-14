<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var ?string $leftText  */
/** @var string $href  */
/** @var string $link  */
/** @var ?string $rightText  */
?>

<!-- DEFAULT VALUE -->
<?php
$leftText ??= "";
$rightText ??= "";
?>

<!-- CONTENT -->
<p class="pt-1 text-center text-sm text-slate-500">
    <!-- Normal Yazı -->
    <?= $this->escape($leftText) ?>
    <!-- Tıklanabilir Yazı -->
    <a href="<?= $this->escape($href) ?>" class="font-bold text-red-600 transition hover:text-red-700 hover:underline">
        <?= $this->escape($link) ?>
    </a>
    <!-- Normal Yazı -->
    <?= $this->escape($rightText) ?>
</p>