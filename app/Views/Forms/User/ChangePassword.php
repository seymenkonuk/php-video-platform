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

<!-- LAYOUT -->
<?= $this->layout("Components/Form/Form", [
    "action" => "",
]) ?>

<!-- CONTENT -->
<!-- Form Başlığı -->
<?= $this->insert("Components/Form/Heading", [
    "icon" => "bi-person-check",
    "text" => "Parolayı Değiştir",
]) ?>

<!-- Eski Parola -->
<?= $this->insert("Components/Form/PasswordInput", [
    "name" => "oldPassword",
    "label" => "Mevcut Parola",
    "icon" => "bi-lock-fill",
    "placeholder" => "Mevcut parolanızı giriniz",
    "description" => "",
    "errors" => $errorMessages["body"]["oldPassword"] ?? "",
    "value" => $defaultValues["body"]["oldPassword"] ?? "",
    "required" => true,
    "disabled" => false,
]) ?>

<!-- Yeni Parola -->
<?= $this->insert("Components/Form/PasswordInput", [
    "name" => "newPassword",
    "label" => "Yeni Parola",
    "icon" => "bi-lock-fill",
    "placeholder" => "Yeni parolanızı giriniz",
    "description" => "",
    "errors" => $errorMessages["body"]["newPassword"] ?? "",
    "value" => $defaultValues["body"]["newPassword"] ?? "",
    "required" => true,
    "disabled" => false,
]) ?>

<!-- Değişiklikleri Kaydet -->
<?= $this->insert("Components/Form/Submit", [
    "icon" => "bi-pencil-square",
    "text" => "Değişiklikleri Kaydet",
    "color" => "bg-red-500",
    "hoverColor" => "hover:bg-red-600",
    "textColor" => "text-white",
    "fullWidth" => true,
]) ?>