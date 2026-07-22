<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var string $name  */
/** @var ?string $label  */
/** @var ?string $icon  */
/** @var string $placeholder  */
/** @var ?string $description  */
/** @var ?array<string> $errors  */
/** @var string $value  */
/** @var ?string $autocomplete  */
/** @var ?string $min  */
/** @var ?string $max  */
/** @var ?string $step  */
/** @var bool $required  */
/** @var bool $disabled  */
?>

<!-- CONTENT -->
<?= $this->insert("Components/Form/Input", (array) new \App\Support\ViewProps\Components\Form\InputViewProp(
    name: $name,
    type: "email",
    label: $label,
    icon: $icon,
    placeholder: $placeholder,
    description: $description,
    errors: $errors,
    value: $value,
    autocomplete: $autocomplete,
    min: $min,
    max: $max,
    step: $step,
    required: $required,
    disabled: $disabled,
)) ?>