<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var string $name  */
/** @var ?string $label  */
/** @var ?string $icon  */
/** @var string $placeholder  */
/** @var ?string $description  */
/** @var ?string|array<string> $errors  */
/** @var ?string $value  */
/** @var ?bool $required  */
/** @var ?bool $disabled  */
/** @var ?string $autocomplete  */
/** @var ?string $min  */
/** @var ?string $max  */
/** @var ?string $step  */
?>

<!-- DEFAULT VALUE -->
<?php
$label ??= "";
$icon ??= "";
$description ??= "";
$errors ??= "";
$value ??= "";
$required ??= false;
$disabled ??= false;
$autocomplete ??= null;
$min ??= null;
$max ??= null;
$step ??= null;
?>

<!-- CONTENT -->
<?= $this->insert("Components/Form/Input", [
    "name" => $name,
    "type" => "text",
    "label" => $label,
    "icon" => $icon,
    "placeholder" => $placeholder,
    "description" => $description,
    "errors" => $errors,
    "value" => $value,
    "required" => $required,
    "disabled" => $disabled,
    "autocomplete" => $autocomplete,
    "min" => $min,
    "max" => $max,
    "step" => $step,
]) ?>