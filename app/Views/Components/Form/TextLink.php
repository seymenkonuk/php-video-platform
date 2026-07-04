<!-- PARAMETERS -->
<?php

/** @var string $label  */
/** @var string $href  */
/** @var string $text  */

?>

<!-- CONTENT -->
<p class="pt-1 text-center text-sm text-slate-500">
    <!-- Normal Yazı -->
    <?= $this->escape($label) ?>
    <!-- Tıklanabilir Yazı -->
    <a href="<?= $this->escape($href) ?>" class="font-bold text-red-600 transition hover:text-red-700 hover:underline">
        <?= $this->escape($text) ?>
    </a>
</p>