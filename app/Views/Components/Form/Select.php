<!-- PARAMETERS -->
<?php

use App\Support\DTOs\OptionDTO;

/** @var string $id  */
/** @var ?string $icon  */
/** @var ?string $label  */
/** @var ?string $description  */
/** @var ?string $value  */
/** @var ?OptionDTO $default  */
/** @var ?array<OptionDTO> $options  */
/** @var ?array<string> $errors  */
/** @var ?bool $required  */
/** @var ?bool $disabled  */

?>

<!-- DEFAULT VALUE -->
<?php

$icon ??= "";
$label ??= "";
$description ??= "";
$value ??= "";
$options ??= [];
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
<select
    id="<?= $this->escape($id) ?>"
    name="<?= $this->escape($id) ?>"
    class="min-w-0 flex-1 cursor-pointer border-0 bg-transparent py-3 text-sm text-slate-900 outline-none focus:ring-0"
    <?= $required ? 'required' : '' ?>
    <?= $disabled ? 'disabled' : '' ?>>

    <!-- Varsayılan Değerini Ekle -->
    <?php if ($default !== null): ?>
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