<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var string $href  */
/** @var ?string $icon  */
/** @var string $text  */
/** @var string $color  */
/** @var string $hoverColor  */
/** @var string $textColor  */
/** @var bool $fullWidth  */
?>

<!-- CONSTANTS -->
<?php
$hasIcon = isset($icon) && $icon !== "";
$class
    = ($fullWidth ? "w-full" : "flex-1") . " "
    . $color . " " . $hoverColor . " " . $textColor;
?>

<!-- CONTENT -->
<a href="<?= $this->escape($href) ?>" class="inline-flex min-h-10 items-center justify-center gap-2 rounded-xl px-4 py-2.5 text-sm font-semibold shadow-sm transition focus:outline-none focus:ring-4 focus:ring-red-100 hover:-translate-y-0.5 hover:shadow-md <?= $this->escape($class) ?>">
    <!-- İkon (Varsa) -->
    <?php if ($hasIcon): ?>
        <i class="bi <?= $this->escape($icon) ?>"></i>
    <?php endif ?>
    <!-- Mesaj -->
    <span>
        <?= $this->escape($text) ?>
    </span>
</a>