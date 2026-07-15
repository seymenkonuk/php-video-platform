<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var string $loginUri  */
/** @var string $registerUri  */
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