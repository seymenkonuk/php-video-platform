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
/** @var array<string> $avatarError */
$avatarError = (array) ($errorMessages["files"]["avatar"] ?? []);
/** @var array<string> $bannerError */
$bannerError = (array) ($errorMessages["files"]["banner"] ?? []);
?>

<!-- LAYOUT -->
<?= $this->layout("Components/Form/Form", (array) new \App\Support\ViewProps\Components\Form\FormViewProp(
    action: "",
    enctype: "multipart/form-data"
)) ?>

<!-- CONTENT -->
<!-- Form Başlığı -->
<?= $this->insert("Components/Form/Heading", (array) new \App\Support\ViewProps\Components\Form\HeadingViewProp(
    icon: "bi-person-check",
    text: "Yeni Kanal Oluştur",
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
    disabled: false,
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

<!-- Avatar -->
<?= $this->insert("Components/Form/File", (array) new \App\Support\ViewProps\Components\Form\FileViewProp(
    name: "avatar",
    label: "Profil Fotoğrafı",
    icon: "bi-image",
    description: "Yalnızca PNG veya JPG dosyaları yükleyebilirsiniz.",
    errors: $avatarError,
    accept: ".png, .jpg, .jpeg, image/png, image/jpeg",
    required: false,
    disabled: false,
)) ?>

<!-- Banner -->
<?= $this->insert("Components/Form/File", (array) new \App\Support\ViewProps\Components\Form\FileViewProp(
    name: "banner",
    label: "Banner Fotoğrafı",
    icon: "bi-image",
    description: "Yalnızca PNG, JPG veya GIF dosyaları yükleyebilirsiniz.",
    errors: $bannerError,
    accept: ".png, .jpg, .jpeg, .gif, image/png, image/jpeg, image/gif",
    required: false,
    disabled: false,
)) ?>

<!-- Oluştur -->
<?= $this->insert("Components/Form/Submit", (array) new \App\Support\ViewProps\Components\Form\SubmitViewProp(
    id: null,
    icon: "bi-plus",
    text: "Oluştur",
    color: "bg-red-500",
    hoverColor: "hover:bg-red-600",
    textColor: "text-white",
    fullWidth: true,
)) ?>