<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var string $name  */
/** @var ?string $label  */
/** @var ?string $icon  */
/** @var ?string $text  */
/** @var ?string $description  */
/** @var ?string|array<string> $errors  */
/** @var ?string $value  */
/** @var ?bool $checked  */
/** @var ?bool $required  */
/** @var ?bool $disabled  */
?>

<!-- DEFAULT VALUE -->
<?php
$label ??= "";
$icon ??= "";
$text ??= "";
$description ??= "";
$errors ??= "";
$value ??= "";
$checked ??= false;
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
<label for="<?= $this->escape($name) ?>" class="flex min-w-0 flex-1 cursor-pointer items-center gap-3 py-3 text-sm text-slate-700">
    <input
        type="checkbox"
        id="<?= $this->escape($name) ?>"
        name="<?= $this->escape($name) ?>"
        <?php if ($value !== ""): ?>
        value="<?= $this->escape($value) ?>"
        <?php endif ?>
        class="h-5 w-5 rounded border-slate-300 text-red-600 focus:ring-red-500"
        <?= $checked ? 'checked' : '' ?>
        <?= $required ? 'required' : '' ?>
        <?= $disabled ? 'disabled' : '' ?>>
    <span><?= $this->escape($text) ?></span>
</label>