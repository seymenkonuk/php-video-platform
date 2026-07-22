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
/** @var array<string> $nameError */
$nameError = (array) ($errorMessages["body"]["name"] ?? []);
/** @var string $nameValue */
$nameValue = $defaultValues["body"]["name"] ?? "";
/** @var array<string> $titleError */
$titleError = (array) ($errorMessages["body"]["title"] ?? []);
/** @var string $titleValue */
$titleValue = $defaultValues["body"]["title"] ?? "";
/** @var array<string> $descriptionError */
$descriptionError = (array) ($errorMessages["body"]["description"] ?? []);
/** @var string $descriptionValue */
$descriptionValue = $defaultValues["body"]["description"] ?? "";
/** @var array<string> $instagramUrlError */
$instagramUrlError = (array) ($errorMessages["body"]["instagramUrl"] ?? []);
/** @var string $instagramUrlValue */
$instagramUrlValue = $defaultValues["body"]["instagramUrl"] ?? "";
/** @var array<string> $twitterUrlError */
$twitterUrlError = (array) ($errorMessages["body"]["twitterUrl"] ?? []);
/** @var string $twitterUrlValue */
$twitterUrlValue = $defaultValues["body"]["twitterUrl"] ?? "";
/** @var array<string> $facebookUrlError */
$facebookUrlError = (array) ($errorMessages["body"]["facebookUrl"] ?? []);
/** @var string $facebookUrlValue */
$facebookUrlValue = $defaultValues["body"]["facebookUrl"] ?? "";
/** @var array<string> $linkedinUrlError */
$linkedinUrlError = (array) ($errorMessages["body"]["linkedinUrl"] ?? []);
/** @var string $linkedinUrlValue */
$linkedinUrlValue = $defaultValues["body"]["linkedinUrl"] ?? "";
/** @var array<string> $githubUrlError */
$githubUrlError = (array) ($errorMessages["body"]["githubUrl"] ?? []);
/** @var string $githubUrlValue */
$githubUrlValue = $defaultValues["body"]["githubUrl"] ?? "";
?>

<!-- LAYOUT -->
<?= $this->layout("Components/Form/Form", (array) new \App\Support\ViewProps\Components\Form\FormViewProp(
    action: "",
)) ?>

<!-- CONTENT -->
<!-- Form Başlığı -->
<?= $this->insert("Components/Form/Heading", (array) new \App\Support\ViewProps\Components\Form\HeadingViewProp(
    icon: "bi-person-check",
    text: "Kanalı Düzenle",
)) ?>

<!-- Kanal Adı -->
<?= $this->insert("Components/Form/TextInput", (array) new \App\Support\ViewProps\Components\Form\TextInputViewProp(
    name: "name",
    label: "Ad",
    icon: "bi-person-lines-fill",
    placeholder: "Kanal adını giriniz",
    description: "",
    errors: $nameError,
    value: $nameValue,
    required: true,
    disabled: true,
)) ?>

<!-- Başlık -->
<?= $this->insert("Components/Form/TextInput", (array) new \App\Support\ViewProps\Components\Form\TextInputViewProp(
    name: "title",
    label: "Başlık",
    icon: "bi-text-left",
    placeholder: "Kanal başlığınızı giriniz",
    description: "",
    errors: $titleError,
    value: $titleValue,
    required: true,
    disabled: false,
)) ?>

<!-- Açıklama -->
<?= $this->insert("Components/Form/Textarea", (array) new \App\Support\ViewProps\Components\Form\TextareaViewProp(
    name: "description",
    label: "Açıklama",
    icon: "bi-card-text",
    placeholder: "Açıklama giriniz",
    description: "",
    errors: $descriptionError,
    value: $descriptionValue,
    required: false,
    disabled: false,
)) ?>

<!-- Instagram -->
<?= $this->insert("Components/Form/TextInput", (array) new \App\Support\ViewProps\Components\Form\TextInputViewProp(
    name: "instagramUrl",
    label: "Instagram",
    icon: "bi-instagram",
    placeholder: "Instagram URL'ninizi giriniz",
    description: "",
    errors: $instagramUrlError,
    value: $instagramUrlValue,
    required: false,
    disabled: false,
)) ?>

<!-- Twitter -->
<?= $this->insert("Components/Form/TextInput", (array) new \App\Support\ViewProps\Components\Form\TextInputViewProp(
    name: "twitterUrl",
    label: "Twitter",
    icon: "bi-twitter",
    placeholder: "Twitter URL'ninizi giriniz",
    description: "",
    errors: $twitterUrlError,
    value: $twitterUrlValue,
    required: false,
    disabled: false,
)) ?>

<!-- Facebook -->
<?= $this->insert("Components/Form/TextInput", (array) new \App\Support\ViewProps\Components\Form\TextInputViewProp(
    name: "facebookUrl",
    label: "Facebook",
    icon: "bi-facebook",
    placeholder: "Facebook URL'ninizi giriniz",
    description: "",
    errors: $facebookUrlError,
    value: $facebookUrlValue,
    required: false,
    disabled: false,
)) ?>

<!-- LinkedIn -->
<?= $this->insert("Components/Form/TextInput", (array) new \App\Support\ViewProps\Components\Form\TextInputViewProp(
    name: "linkedinUrl",
    label: "LinkedIn",
    icon: "bi-linkedin",
    placeholder: "LinkedIn URL'ninizi giriniz",
    description: "",
    errors: $linkedinUrlError,
    value: $linkedinUrlValue,
    required: false,
    disabled: false,
)) ?>

<!-- GitHub -->
<?= $this->insert("Components/Form/TextInput", (array) new \App\Support\ViewProps\Components\Form\TextInputViewProp(
    name: "githubUrl",
    label: "GitHub",
    icon: "bi-github",
    placeholder: "GitHub URL'ninizi giriniz",
    description: "",
    errors: $githubUrlError,
    value: $githubUrlValue,
    required: false,
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