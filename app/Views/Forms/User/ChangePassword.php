<!-- PARAMETERS -->
<?php

/** @var array<mixed> $errorMessages  */
/** @var array<mixed> $defaultValues  */

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
    "required" => false,
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