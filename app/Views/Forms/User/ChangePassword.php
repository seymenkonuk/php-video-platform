<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var array{
 *     body?: array<string, mixed>,
 *     query?: array<string, mixed>,
 *     params?: array<string, mixed>,
 *     files?: array<string, mixed>,
 * } $errorMessages */
/** @var array{
 *     body?: array<string, mixed>,
 *     query?: array<string, mixed>,
 *     params?: array<string, mixed>,
 *     files?: array<string, mixed>,
 * } $defaultValues */
?>

<!-- CONSTANTS -->
<?php
/** @var array<string> $oldPasswordError */
$oldPasswordError = (array) ($errorMessages["body"]["oldPassword"] ?? []);
/** @var array<string> $newPasswordError */
$newPasswordError = (array) ($errorMessages["body"]["newPassword"] ?? []);
?>

<!-- LAYOUT -->
<?= $this->layout("Components/Form/Form", (array) new \App\Support\ViewProps\Components\Form\FormViewProp(
    action: "",
)) ?>

<!-- CONTENT -->
<!-- Form Başlığı -->
<?= $this->insert("Components/Form/Heading", (array) new \App\Support\ViewProps\Components\Form\HeadingViewProp(
    icon: "bi-person-check",
    text: "Parolayı Değiştir",
)) ?>

<!-- Eski Parola -->
<?= $this->insert("Components/Form/PasswordInput", (array) new \App\Support\ViewProps\Components\Form\PasswordInputViewProp(
    name: "oldPassword",
    label: "Mevcut Parola",
    icon: "bi-lock-fill",
    placeholder: "Mevcut parolanızı giriniz",
    description: "",
    errors: $oldPasswordError,
    value: "",
    required: true,
    disabled: false,
)) ?>

<!-- Yeni Parola -->
<?= $this->insert("Components/Form/PasswordInput", (array) new \App\Support\ViewProps\Components\Form\PasswordInputViewProp(
    name: "newPassword",
    label: "Yeni Parola",
    icon: "bi-lock-fill",
    placeholder: "Yeni parolanızı giriniz",
    description: "",
    errors: $newPasswordError,
    value: "",
    required: true,
    disabled: false,
)) ?>

<!-- Değişiklikleri Kaydet -->
<?= $this->insert("Components/Form/Submit", (array) new \App\Support\ViewProps\Components\Form\SubmitViewProp(
    id: null,
    icon: "bi-pencil-square",
    text: "Değişiklikleri Kaydet",
    color: "bg-red-500",
    hoverColor: "hover:bg-red-600",
    textColor: "text-white",
    fullWidth: true,
)) ?>