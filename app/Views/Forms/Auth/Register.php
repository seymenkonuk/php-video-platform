<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var array<\App\Support\DTOs\UI\OptionDTO> $countries  */
/** @var string $loginUri  */
/** @var string $registerUri  */
/** @var array<mixed> $errorMessages  */
/** @var array<mixed> $defaultValues  */
?>

<!-- LAYOUT -->
<?= $this->layout("Components/Form/Form", [
    "action" => $registerUri,
]) ?>

<!-- CONTENT -->
<!-- Form Başlığı -->
<?= $this->insert("Components/Form/Heading", [
    "icon" => "bi-person-check",
    "text" => "Kayıt Ol",
]) ?>

<!-- Ad -->
<?= $this->insert("Components/Form/TextInput", [
    "name" => "name",
    "label" => "Ad",
    "icon" => "bi-person-lines-fill",
    "placeholder" => "Adınızı giriniz",
    "description" => "",
    "errors" => $errorMessages["body"]["name"] ?? "",
    "value" => $defaultValues["body"]["name"] ?? "",
    "required" => true,
    "disabled" => false,
]) ?>

<!-- Soyad -->
<?= $this->insert("Components/Form/TextInput", [
    "name" => "surname",
    "label" => "Soyad",
    "icon" => "bi-person-lines-fill",
    "placeholder" => "Soyadınızı giriniz",
    "description" => "",
    "errors" => $errorMessages["body"]["surname"] ?? "",
    "value" => $defaultValues["body"]["surname"] ?? "",
    "required" => true,
    "disabled" => false,
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

<!-- Email -->
<?= $this->insert("Components/Form/EmailInput", [
    "name" => "email",
    "label" => "E-Posta",
    "icon" => "bi-envelope-fill",
    "placeholder" => "E-posta adresinizi giriniz",
    "description" => "",
    "errors" => $errorMessages["body"]["email"] ?? "",
    "value" => $defaultValues["body"]["email"] ?? "",
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
    "value" => "",
    "required" => true,
    "disabled" => false,
]) ?>

<!-- Ülke -->
<?= $this->insert("Components/Form/Select", [
    "name" => "country",
    "label" => "Ülke",
    "icon" => "bi-globe",
    "description" => "",
    "errors" => $errorMessages["body"]["country"] ?? "",
    "value" => $defaultValues["body"]["country"] ?? "",
    "default" => new \App\Support\DTOs\UI\OptionDTO("", "Seçiniz"),
    "options" => $countries,
    "required" => true,
    "disabled" => false,
]) ?>

<!-- Kayıt Ol -->
<?= $this->insert("Components/Form/Submit", [
    "icon" => "bi-person-plus-fill",
    "text" => "Kayıt Ol",
    "color" => "bg-red-500",
    "hoverColor" => "hover:bg-red-600",
    "textColor" => "text-white",
    "fullWidth" => true,
]) ?>

<!-- Zaten hesabın var mı? Giriş Yap -->
<?= $this->insert("Components/Form/TextLink", [
    "leftText" => "Zaten hesabın var mı?",
    "href" => $loginUri,
    "link" => "Giriş Yap",
]) ?>