<!-- PARAMETERS -->
<?php

/** @var string $id  */
/** @var ?string $label  */
/** @var ?string $icon  */
/** @var ?string $description  */
/** @var ?string|array<string> $errors  */
/** @var ?bool $required  */
/** @var ?bool $disabled  */

?>

<!-- DEFAULT VALUE -->
<?php

$label ??= "";
$icon ??= "";
$description ??= "";
$errors = array_values(array_filter((array)($errors ?? []), static fn($message): bool => $message !== null && $message !== ""));
$required ??= false;
$disabled ??= false;

?>

<!-- CONSTANTS -->
<?php

$hasError = $errors !== [];
// Field Disable ise Eklenecek Classlar
$disabledClass = "cursor-not-allowed border-slate-200 bg-slate-100 text-slate-400 opacity-70";
// Field'da Hata Varsa Eklenecek Classlar
$errorClass = "border-red-400 bg-red-50 focus-within:ring-4 focus-within:ring-red-100";
// Normal Durumlarda Eklenecek Classlar
$normalClass = "border-slate-300 bg-white text-slate-900 focus-within:border-red-500 focus-within:ring-4 focus-within:ring-red-100";
// Mevcut Durumda Eklenecek Classlar
$currentClass = $disabled ? $disabledClass : ($hasError ? $errorClass : $normalClass);

?>

<!-- CONTENT -->
<div class="space-y-1.5">
    <!-- Field'in Labeli (Varsa) -->
    <?php if ($label !== ""): ?>
        <label for="<?= $this->escape($id) ?>" class="block text-sm font-semibold text-slate-700">
            <?= $this->escape($label) ?><?= $required ? ' *' : '' ?>
        </label>
    <?php endif ?>

    <div class="flex min-h-12 items-center rounded-xl border px-3.5 transition <?= $currentClass ?>">
        <!-- Field İkon (Varsa) -->
        <?php if ($icon !== ""): ?>
            <i class="bi <?= $this->escape($icon) ?> mr-3 shrink-0 text-lg text-slate-400"></i>
        <?php endif ?>
        <!-- GERÇEK INPUTUN GELECEĞİ ALAN -->
        <?= $this->section("content") ?>
    </div>

    <!-- Field Açıklaması (Varsa) -->
    <?php if ($description !== ""): ?>
        <p class="text-xs leading-5 text-slate-500">
            <?= $this->escape($description) ?>
        </p>
    <?php endif ?>

    <!-- Field Errorleri (Varsa) -->
    <?php foreach ($errors as $message): ?>
        <p class="flex items-center gap-1.5 text-xs font-medium text-red-600">
            <!-- Hata İkonu -->
            <i class="bi bi-exclamation-circle"></i>
            <!-- Hata Mesajı -->
            <?= $this->escape($message) ?>
        </p>
    <?php endforeach ?>
</div>