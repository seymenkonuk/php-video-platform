<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var ?string $id  */
/** @var ?string $icon  */
/** @var string $text  */
/** @var string $color  */
/** @var string $hoverColor  */
/** @var string $textColor  */
/** @var bool $fullWidth  */
/** @var bool $disabled  */
?>

<!-- CONTENT -->
<?= $this->insert("Components/Form/Button", (array) new \App\Support\ViewProps\Components\Form\ButtonViewProp(
    id: $id,
    type: "submit",
    icon: $icon,
    text: $text,
    color: $color,
    hoverColor: $hoverColor,
    textColor: $textColor,
    fullWidth: $fullWidth,
    disabled: $disabled,
)) ?>