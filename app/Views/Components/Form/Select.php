<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var string $name  */
/** @var ?string $label  */
/** @var ?string $icon  */
/** @var ?string $description  */
/** @var ?array<string> $errors  */
/** @var string $value  */
/** @var ?\App\Support\DTOs\UI\OptionDTO $default  */
/** @var array<\App\Support\DTOs\UI\OptionDTO> $options  */
/** @var bool $required  */
/** @var bool $disabled  */
?>

<!-- CONSTANTS -->
<?php
$hasDefault = isset($default);
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
<select
    id="<?= $this->escape($name) ?>"
    name="<?= $this->escape($name) ?>"
    class="min-w-0 flex-1 cursor-pointer border-0 bg-transparent py-3 text-sm text-slate-900 outline-none focus:ring-0"
    <?= $required ? 'required' : '' ?>
    <?= $disabled ? 'disabled' : '' ?>>

    <!-- Varsayılan Değerini Ekle -->
    <?php if ($hasDefault): ?>
        <option value="<?= $this->escape($default->value) ?>">
            <?= $this->escape($default->title) ?>
        </option>
    <?php endif ?>

    <!-- Seçeneklerini Ekle -->
    <?php foreach ($options as $option): ?>
        <option value="<?= $this->escape($option->value) ?>" <?= $value === $option->value ? 'selected' : '' ?>>
            <?= $this->escape($option->title) ?>
        </option>
    <?php endforeach ?>
</select>