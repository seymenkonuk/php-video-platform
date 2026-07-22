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
/** @var array<\App\Support\DTOs\UI\OptionDTO> $viewTypes  */
?>

<!-- CONSTANTS -->
<?php
/** @var array<string> $titleError */
$titleError = (array) ($errorMessages["body"]["title"] ?? []);
/** @var string $titleValue */
$titleValue = $defaultValues["body"]["title"] ?? "";
/** @var array<string> $descriptionError */
$descriptionError = (array) ($errorMessages["body"]["description"] ?? []);
/** @var string $descriptionValue */
$descriptionValue = $defaultValues["body"]["description"] ?? "";
/** @var array<string> $viewTypeError */
$viewTypeError = (array) ($errorMessages["body"]["viewType"] ?? []);
/** @var string $viewTypeValue */
$viewTypeValue = $defaultValues["body"]["viewType"] ?? "";
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
    text: "Oynatma Listesi Oluştur",
)) ?>

<!-- Başlık -->
<?= $this->insert("Components/Form/TextInput", (array) new \App\Support\ViewProps\Components\Form\TextInputViewProp(
    name: "title",
    label: "Başlık",
    icon: "bi-text-left",
    placeholder: "Oynatma listesi başlığınızı giriniz",
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

<!-- Görüntüleme Türü -->
<?= $this->insert("Components/Form/Select", (array) new \App\Support\ViewProps\Components\Form\SelectViewProp(
    name: "viewType",
    label: "Görünürlük",
    icon: "bi-globe",
    description: "",
    errors: $viewTypeError,
    value: $viewTypeValue,
    default: new \App\Support\DTOs\UI\OptionDTO("", "Seçiniz"),
    options: $viewTypes,
    required: true,
    disabled: false,
)) ?>

<!-- Banner Photo -->
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