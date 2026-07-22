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

<!-- CONSTANTS -->
<?php
/** @var array<string> $usernameError */
$usernameError = (array) ($errorMessages["body"]["username"] ?? []);
/** @var string $usernameValue */
$usernameValue = $defaultValues["body"]["username"] ?? "";
/** @var array<string> $passwordError */
$passwordError = (array) ($errorMessages["body"]["password"] ?? []);
?>

<!-- LAYOUT -->
<?= $this->layout("Components/Form/Form", (array) new \App\Support\ViewProps\Components\Form\FormViewProp(
    action: $loginUri,
)) ?>

<!-- CONTENT -->
<!-- Form Başlığı -->
<?= $this->insert("Components/Form/Heading", (array) new \App\Support\ViewProps\Components\Form\HeadingViewProp(
    icon: "bi-person-check",
    text: "Giriş Yap",
)) ?>

<!-- Kullanıcı Adı -->
<?= $this->insert("Components/Form/TextInput", (array) new \App\Support\ViewProps\Components\Form\TextInputViewProp(
    name: "username",
    label: "Kullanıcı Adı",
    icon: "bi-person-fill",
    placeholder: "Kullanıcı adınızı giriniz",
    description: "",
    errors: $usernameError,
    value: $usernameValue,
    required: true,
    disabled: false,
)) ?>

<!-- Parola -->
<?= $this->insert("Components/Form/PasswordInput", (array) new \App\Support\ViewProps\Components\Form\PasswordInputViewProp(
    name: "password",
    label: "Parola",
    icon: "bi-lock-fill",
    placeholder: "Parolanızı giriniz",
    description: "",
    errors: $passwordError,
    value: "",
    required: true,
    disabled: false,
)) ?>

<!-- Giriş Yap -->
<?= $this->insert("Components/Form/Submit", (array) new \App\Support\ViewProps\Components\Form\SubmitViewProp(
    id: null,
    icon: "bi-box-arrow-in-right",
    text: "Giriş Yap",
    color: "bg-red-500",
    hoverColor: "hover:bg-red-600",
    textColor: "text-white",
)) ?>

<!-- Hesabın yok mu? Kayıt Ol -->
<?= $this->insert("Components/Form/TextLink", (array) new \App\Support\ViewProps\Components\Form\TextLinkViewProp(
    leftText: "Hesabın yok mu?",
    href: $registerUri,
    link: "Kayıt Ol",
    rightText: null,
)) ?>