<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var array<\App\Support\DTOs\UI\OptionDTO> $countries  */
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
    "text" => "Kullanıcıyı Düzenle",
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
    "disabled" => true,
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
    "disabled" => true,
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
    "disabled" => true,
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

<!-- Değişiklikleri Kaydet -->
<?= $this->insert("Components/Form/Submit", [
    "icon" => "bi-pencil-square",
    "text" => "Değişiklikleri Kaydet",
    "color" => "bg-red-500",
    "hoverColor" => "hover:bg-red-600",
    "textColor" => "text-white",
    "fullWidth" => true,
]) ?>