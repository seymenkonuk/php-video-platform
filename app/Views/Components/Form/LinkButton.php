<!-- PARAMETERS -->
<?php

/** @var string $href  */
/** @var ?string $icon  */
/** @var string $text  */
/** @var string $color  */
/** @var string $hoverColor  */
/** @var string $textColor  */
/** @var ?bool $fullWidth  */

?>

<!-- DEFAULT VALUE -->
<?php

$icon ??= "";
$fullWidth ??= true;

?>

<!-- CONSTANTS -->
<?php

$currentClass = "inline-flex min-h-10 items-center justify-center gap-2 rounded-xl px-4 py-2.5 text-sm font-semibold shadow-sm transition focus:outline-none focus:ring-4 focus:ring-red-100 " .
    ($fullWidth ? "w-full " : "flex-1 ") . $color . " " . $hoverColor . " " . $textColor . " " .
    "hover:-translate-y-0.5 hover:shadow-md";

?>

<!-- CONTENT -->
<a href="<?= $this->escape($href) ?>" class="<?= $this->escape($currentClass) ?>">
    <!-- İkon (Varsa) -->
    <?php if ($icon !== ""): ?>
        <i class="bi <?= $this->escape($icon) ?>"></i>
    <?php endif ?>
    <!-- Mesaj -->
    <span>
        <?= $this->escape($text) ?>
    </span>
</a>