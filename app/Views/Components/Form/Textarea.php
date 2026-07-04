<!-- PARAMETERS -->
<?php

/** @var string $id  */
/** @var ?string $icon  */
/** @var ?string $label  */
/** @var string $placeholder  */
/** @var int $rows  */
/** @var ?string $value  */
/** @var ?string $description  */
/** @var ?array<string> $errors  */
/** @var ?bool $required  */
/** @var ?bool $disabled  */

?>

<!-- DEFAULT VALUE -->
<?php

$icon ??= "";
$label ??= "";
$value ??= "";
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
<textarea
    id="<?= $this->escape($id) ?>"
    name="<?= $this->escape($id) ?>"
    placeholder="<?= $this->escape($placeholder) ?>"
    rows="<?= $this->escape($rows) ?>"
    oninput="autoResize(this)"
    class="min-h-24 min-w-0 flex-1 resize-none border-0 bg-transparent py-3 text-sm text-slate-900 outline-none placeholder:text-slate-400 focus:ring-0"
    <?= $disabled ? 'disabled' : '' ?>
    <?= $required ? 'required' : '' ?>>

    <!-- Otomatik Doldur (Varsa) -->
    <?= $this->escape($value) ?>

</textarea>