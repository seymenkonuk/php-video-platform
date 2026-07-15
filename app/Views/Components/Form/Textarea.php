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
/** @var ?int $rows  */
/** @var ?bool $required  */
/** @var ?bool $disabled  */
?>

<!-- DEFAULT VALUE -->
<?php
$label ??= "";
$icon ??= "";
$description ??= "";
$errors ??= "";
$value ??= "";
$rows ??= 1;
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
<textarea
    id="<?= $this->escape($name) ?>"
    name="<?= $this->escape($name) ?>"
    placeholder="<?= $this->escape($placeholder) ?>"
    rows="<?= $rows ?>"
    oninput="autoResize(this)"
    class="min-h-24 min-w-0 flex-1 resize-none border-0 bg-transparent py-3 text-sm text-slate-900 outline-none placeholder:text-slate-400 focus:ring-0"
    <?= $disabled ? 'disabled' : '' ?>
    <?= $required ? 'required' : '' ?>>

    <!-- Otomatik Doldur (Varsa) -->
    <?= $this->escape($value) ?>

</textarea>