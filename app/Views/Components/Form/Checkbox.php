<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var string $name  */
/** @var ?string $label  */
/** @var ?string $icon  */
/** @var string $text  */
/** @var ?string $description  */
/** @var ?array<string> $errors  */
/** @var string $value  */
/** @var bool $checked  */
/** @var bool $required  */
/** @var bool $disabled  */
?>

<!-- CONSTANTS -->
<?php
$hasValue = $value !== "";
?>

<!-- LAYOUT -->
<?= $this->layout("Components/Form/Field", (array) new \App\Support\ViewProps\Components\Form\FieldViewProp(
    id: $name,
    label: $label,
    icon: $icon,
    description: $description,
    errors: $errors,
    required: $required,
    disabled: $disabled,
)) ?>

<!-- CONTENT -->
<label for="<?= $this->escape($name) ?>" class="flex min-w-0 flex-1 cursor-pointer items-center gap-3 py-3 text-sm text-slate-700">
    <input
        type="checkbox"
        id="<?= $this->escape($name) ?>"
        name="<?= $this->escape($name) ?>"
        <?php if ($hasValue): ?>
        value="<?= $this->escape($value) ?>"
        <?php endif ?>
        class="h-5 w-5 rounded border-slate-300 text-red-600 focus:ring-red-500"
        <?= $checked ? 'checked' : '' ?>
        <?= $required ? 'required' : '' ?>
        <?= $disabled ? 'disabled' : '' ?>>
    <span><?= $this->escape($text) ?></span>
</label>