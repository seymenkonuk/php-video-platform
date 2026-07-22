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
/** @var array<\App\Support\DTOs\UI\OptionDTO> $commentTypes  */
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
/** @var array<string> $commentTypeError */
$commentTypeError = (array) ($errorMessages["body"]["commentType"] ?? []);
/** @var string $commentTypeValue */
$commentTypeValue = $defaultValues["body"]["commentType"] ?? "";
/** @var array<string> $fileError */
$fileError = (array) ($errorMessages["files"]["file"] ?? []);
/** @var array<string> $thumbnailError */
$thumbnailError = (array) ($errorMessages["files"]["thumbnail"] ?? []);
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
    text: "Kısa Video Oluştur",
)) ?>

<!-- Başlık -->
<?= $this->insert("Components/Form/TextInput", (array) new \App\Support\ViewProps\Components\Form\TextInputViewProp(
    name: "title",
    label: "Başlık",
    icon: "bi-text-left",
    placeholder: "Kısa video başlığınızı giriniz",
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

<!-- Yorum İzinleri -->
<?= $this->insert("Components/Form/Select", (array) new \App\Support\ViewProps\Components\Form\SelectViewProp(
    name: "commentType",
    label: "Yorum İzni",
    icon: "bi-globe",
    description: "",
    errors: $commentTypeError,
    value: $commentTypeValue,
    default: new \App\Support\DTOs\UI\OptionDTO("", "Seçiniz"),
    options: $commentTypes,
    required: true,
    disabled: false,
)) ?>

<!-- Video File -->
<?= $this->insert("Components/Form/File", (array) new \App\Support\ViewProps\Components\Form\FileViewProp(
    name: "file",
    label: "Kısa Video Dosyası",
    icon: "bi-camera-video",
    description: "Yalnızca MP4 dosyaları yükleyebilirsiniz.",
    errors: $fileError,
    accept: ".mp4, video/mp4",
    required: true,
    disabled: false,
)) ?>

<!-- Thumbnail Photo -->
<?= $this->insert("Components/Form/File", (array) new \App\Support\ViewProps\Components\Form\FileViewProp(
    name: "thumbnail",
    label: "Kapak Fotoğrafı",
    icon: "bi-image",
    description: "Yalnızca PNG veya JPG dosyaları yükleyebilirsiniz.",
    errors: $thumbnailError,
    accept: ".png, .jpg, .jpeg, image/png, image/jpeg",
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