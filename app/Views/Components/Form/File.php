<!-- PARAMETERS -->
<?php

/** @var string $name  */
/** @var ?string $label  */
/** @var ?string $icon  */
/** @var ?string $description  */
/** @var ?string|array<string> $errors  */
/** @var string $accept  */
/** @var ?bool $required  */
/** @var ?bool $disabled  */

?>

<!-- DEFAULT VALUE -->
<?php

$label ??= "";
$icon ??= "";
$description ??= "";
$errors ??= [];
$required ??= false;
$disabled ??= false;

?>

<!-- LAYOUT -->
<?= $this->layout("Components/Form/Field", [
    "id" => $name,
    "icon" =>  $icon,
    "label" =>  $label,
    "description" =>  $description,
    "errors" =>  $errors,
    "required" =>  $required,
    "disabled" =>  $disabled,
]) ?>

<!-- CONTENT -->
<input
    type="file"
    id="<?= $this->escape($name) ?>"
    name="<?= $this->escape($name) ?>"
    accept="<?= $this->escape($accept) ?>"
    class="min-w-0 flex-1 cursor-pointer py-2 text-sm text-slate-600 file:mr-4 file:cursor-pointer file:rounded-lg file:border-0 file:bg-red-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-red-700 hover:file:bg-red-100"
    <?= $required ? 'required' : '' ?>
    <?= $disabled ? 'disabled' : '' ?> />