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
/** @var array<\App\Support\DTOs\UI\OptionDTO> $countries  */
?>

<!-- CONSTANTS -->
<?php
/** @var array<string> $nameError */
$nameError = (array) ($errorMessages["body"]["name"] ?? []);
/** @var string $nameValue */
$nameValue = $defaultValues["body"]["name"] ?? "";
/** @var array<string> $surnameError */
$surnameError = (array) ($errorMessages["body"]["surname"] ?? []);
/** @var string $surnameValue */
$surnameValue = $defaultValues["body"]["surname"] ?? "";
/** @var array<string> $usernameError */
$usernameError = (array) ($errorMessages["body"]["username"] ?? []);
/** @var string $usernameValue */
$usernameValue = $defaultValues["body"]["username"] ?? "";
/** @var array<string> $emailError */
$emailError = (array) ($errorMessages["body"]["email"] ?? []);
/** @var string $emailValue */
$emailValue = $defaultValues["body"]["email"] ?? "";
/** @var array<string> $passwordError */
$passwordError = (array) ($errorMessages["body"]["password"] ?? []);
/** @var array<string> $countryError */
$countryError = (array) ($errorMessages["body"]["country"] ?? []);
/** @var string $countryValue */
$countryValue = $defaultValues["body"]["country"] ?? "";
?>

<!-- LAYOUT -->
<?= $this->layout("Components/Form/Form", [
    "action" => $registerUri,
]) ?>

<!-- CONTENT -->
<!-- Form Başlığı -->
<?= $this->insert("Components/Form/Heading", (array) new \App\Support\ViewProps\Components\Form\HeadingViewProp(
    icon: "bi-person-check",
    text: "Kayıt Ol",
)) ?>

<!-- Ad -->
<?= $this->insert("Components/Form/TextInput", (array) new \App\Support\ViewProps\Components\Form\TextInputViewProp(
    name: "name",
    label: "Ad",
    icon: "bi-person-lines-fill",
    placeholder: "Adınızı giriniz",
    description: "",
    errors: $nameError,
    value: $nameValue,
    required: true,
    disabled: false,
)) ?>

<!-- Soyad -->
<?= $this->insert("Components/Form/TextInput", (array) new \App\Support\ViewProps\Components\Form\TextInputViewProp(
    name: "surname",
    label: "Soyad",
    icon: "bi-person-lines-fill",
    placeholder: "Soyadınızı giriniz",
    description: "",
    errors: $surnameError,
    value: $surnameValue,
    required: true,
    disabled: false,
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

<!-- Email -->
<?= $this->insert("Components/Form/EmailInput", (array) new \App\Support\ViewProps\Components\Form\EmailInputViewProp(
    name: "email",
    label: "E-Posta",
    icon: "bi-envelope-fill",
    placeholder: "E-posta adresinizi giriniz",
    description: "",
    errors: $emailError,
    value: $emailValue,
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

<!-- Ülke -->
<?= $this->insert("Components/Form/Select", (array) new \App\Support\ViewProps\Components\Form\SelectViewProp(
    name: "country",
    label: "Ülke",
    icon: "bi-globe",
    description: "",
    errors: $countryError,
    value: $countryValue,
    default: new \App\Support\DTOs\UI\OptionDTO("", "Seçiniz"),
    options: $countries,
    required: true,
    disabled: false,
)) ?>

<!-- Kayıt Ol -->
<?= $this->insert("Components/Form/Submit", (array) new \App\Support\ViewProps\Components\Form\SubmitViewProp(
    id: null,
    icon: "bi-person-plus-fill",
    text: "Kayıt Ol",
    color: "bg-red-500",
    hoverColor: "hover:bg-red-600",
    textColor: "text-white",
    fullWidth: true,
)) ?>

<!-- Zaten hesabın var mı? Giriş Yap -->
<?= $this->insert("Components/Form/TextLink", (array) new \App\Support\ViewProps\Components\Form\TextLinkViewProp(
    leftText: "Zaten hesabın var mı?",
    href: $loginUri,
    link: "Giriş Yap",
    rightText: null,
)) ?>