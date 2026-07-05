<!-- PARAMETERS -->
<?php

/** @var string $loginUri  */
/** @var string $registerUri  */
/** @var array<mixed> $errorMessages  */
/** @var array<mixed> $defaultValues  */

?>

<!-- LAYOUT -->
<?= $this->layout("Components/Form/Form", [
    "action" => $loginUri,
]) ?>

<!-- CONTENT -->
<!-- Form Başlığı -->
<?= $this->insert("Components/Form/Heading", [
    "icon" => "bi-person-check",
    "text" => "Giriş Yap",
]) ?>

<!-- Kullanıcı Adı -->
<?= $this->insert("Components/Form/TextInput", [
    "name" => "username",
    "label" => "Kullanıcı Adı",
    "icon" => "bi-person-fill",
    "placeholder" => "Kullanıcı adınızı giriniz",
    "description" => "",
    "errors" => $errorMessages["body"]["username"] ?? "",
    "value" => $defaultValues["body"]["username"] ?? "",
    "required" => true,
    "disabled" => false,
]) ?>

<!-- Parola -->
<?= $this->insert("Components/Form/PasswordInput", [
    "name" => "password",
    "label" => "Parola",
    "icon" => "bi-lock-fill",
    "placeholder" => "Parolanızı giriniz",
    "description" => "",
    "errors" => $errorMessages["body"]["password"] ?? "",
    "value" => $defaultValues["body"]["password"] ?? "",
    "required" => true,
    "disabled" => false,
]) ?>

<!-- Giriş Yap -->
<?= $this->insert("Components/Form/Submit", [
    "icon" => "bi-box-arrow-in-right",
    "text" => "Giriş Yap",
    "color" => "bg-red-500",
    "hoverColor" => "hover:bg-red-600",
    "textColor" => "text-white",
    "fullWidth" => true,
]) ?>

<!-- Hesabın yok mu? Kayıt Ol -->
<?= $this->insert("Components/Form/TextLink", [
    "leftText" => "Hesabın yok mu?",
    "href" => $registerUri,
    "link" => "Kayıt Ol",
]) ?>