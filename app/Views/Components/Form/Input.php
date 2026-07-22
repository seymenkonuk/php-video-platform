<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var string $name  */
/** @var string $type  */
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

<!-- CONSTANTS -->
<?php
$class = $disabled ? "cursor-not-allowed" : "";
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
<input
    id="<?= $this->escape($name) ?>"
    type="<?= $this->escape($type) ?>"
    name="<?= $this->escape($name) ?>"
    placeholder="<?= $this->escape($placeholder) ?>"
    value="<?= $this->escape($value) ?>"
    class="min-w-0 flex-1 border-0 bg-transparent py-3 text-sm text-slate-900 outline-none placeholder:text-slate-400 focus:ring-0 <?= $this->escape($class) ?>"
    <?php if ($autocomplete !== null): ?>autocomplete="<?= $this->escape($autocomplete) ?>" <?php endif ?>
    <?php if ($min !== null): ?>min="<?= $this->escape($min) ?>" <?php endif ?>
    <?php if ($max !== null): ?>max="<?= $this->escape($max) ?>" <?php endif ?>
    <?php if ($step !== null): ?>step="<?= $this->escape($step) ?>" <?php endif ?>
    <?= $required ? 'required' : '' ?>
    <?= $disabled ? 'disabled' : '' ?> />

<!-- Parolaysa Gizle/Göster Butonu Ekle -->
<?php if ($type === "password"): ?>
    <button
        type="button"
        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg text-slate-400 transition hover:bg-slate-100 hover:text-slate-700 focus:outline-none"
        onclick="togglePassword(this)"
        aria-label="Parolayı göster veya gizle"
        <?= $disabled ? 'disabled' : '' ?>>
        <i class="bi bi-eye-slash"></i>
    </button>
<?php endif ?>