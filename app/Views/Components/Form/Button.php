<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var ?string $id  */
/** @var string $type  */
/** @var ?string $icon  */
/** @var string $text  */
/** @var string $color  */
/** @var string $hoverColor  */
/** @var string $textColor  */
/** @var bool $fullWidth  */
/** @var bool $disabled  */
?>

<!-- CONSTANTS -->
<?php
$hasId = isset($id) && $id !== "";
$hasIcon = isset($icon) && $icon !== "";
$class
    = ($fullWidth ? "w-full" : "flex-1") . " "
    . ($disabled ? "cursor-not-allowed opacity-60" : "hover:-translate-y-0.5 hover:shadow-md") . " "
    . $color . " " . $hoverColor . " " . $textColor;
?>

<!-- CONTENT -->
<button
    <?php if ($hasId): ?>
    id="<?= $this->escape($id) ?>"
    <?php endif ?>

    type="<?= $this->escape($type) ?>"
    class="inline-flex min-h-10 items-center justify-center gap-2 rounded-xl px-4 py-2.5 text-sm font-semibold shadow-sm transition focus:outline-none focus:ring-4 focus:ring-red-100 <?= $this->escape($class) ?>"

    <?= $disabled ? 'disabled' : '' ?>>
    <!-- İkon (Varsa) -->
    <?php if ($hasIcon): ?>
        <i class="bi <?= $this->escape($icon) ?>"></i>
    <?php endif ?>
    <!-- Mesaj -->
    <span>
        <?= $this->escape($text) ?>
    </span>
</button>