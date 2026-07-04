<!-- PARAMETERS -->
<?php

/** @var string $id  */
/** @var ?string $icon  */
/** @var ?string $label  */
/** @var string $accept  */
/** @var ?string $description  */
/** @var ?array<string> $errors  */
/** @var ?bool $required  */
/** @var ?bool $disabled  */

?>

<!-- DEFAULT VALUE -->
<?php

$icon ??= "";
$label ??= "";
$description ??= "";
$errors ??= [];
$required ??= false;
$disabled ??= false;

?>

<!-- LAYOUT -->
<?= $this->layout("Components/Form/Field", [
    "id" => $id,
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
    id="<?= $this->escape($id) ?>"
    name="<?= $this->escape($id) ?>"
    accept="<?= $this->escape($accept) ?>"
    class="min-w-0 flex-1 cursor-pointer py-2 text-sm text-slate-600 file:mr-4 file:cursor-pointer file:rounded-lg file:border-0 file:bg-red-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-red-700 hover:file:bg-red-100"
    <?= $required ? 'required' : '' ?>
    <?= $disabled ? 'disabled' : '' ?> />