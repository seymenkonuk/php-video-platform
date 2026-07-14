<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var array<\App\Support\DTOs\OptionDTO> $commentTypes  */
/** @var array<\App\Support\DTOs\OptionDTO> $viewTypes  */
/** @var array<mixed> $errorMessages  */
/** @var array<mixed> $defaultValues  */
?>

<!-- LAYOUT -->
<?= $this->layout("Components/Form/Form", [
    "action" => "",
    "enctype" => "multipart/form-data",
]) ?>

<!-- CONTENT -->
<!-- Form Başlığı -->
<?= $this->insert("Components/Form/Heading", [
    "icon" => "bi-person-check",
    "text" => "Video Oluştur",
]) ?>

<!-- Başlık -->
<?= $this->insert("Components/Form/TextInput", [
    "name" => "title",
    "label" => "Başlık",
    "icon" => "bi-text-left",
    "placeholder" => "Video başlığınızı giriniz",
    "description" => "",
    "errors" => $errorMessages["body"]["title"] ?? "",
    "value" => $defaultValues["body"]["title"] ?? "",
    "required" => true,
    "disabled" => false,
]) ?>

<!-- Açıklama -->
<?= $this->insert("Components/Form/Textarea", [
    "name" => "description",
    "label" => "Açıklama",
    "icon" => "bi-card-text",
    "placeholder" => "Açıklama giriniz",
    "description" => "",
    "errors" => $errorMessages["body"]["description"] ?? "",
    "value" => $defaultValues["body"]["description"] ?? "",
    "required" => false,
    "disabled" => false,
]) ?>

<!-- Görüntüleme Türü -->
<?= $this->insert("Components/Form/Select", [
    "name" => "viewType",
    "label" => "Görünürlük",
    "icon" => "bi-globe",
    "description" => "",
    "errors" => $errorMessages["body"]["viewType"] ?? "",
    "value" => $defaultValues["body"]["viewType"] ?? "",
    "default" => new \App\Support\DTOs\OptionDTO("", "Seçiniz"),
    "options" => $viewTypes,
    "required" => true,
    "disabled" => false,
]) ?>

<!-- Yorum İzinleri -->
<?= $this->insert("Components/Form/Select", [
    "name" => "commentType",
    "label" => "Yorum İzni",
    "icon" => "bi-globe",
    "description" => "",
    "errors" => $errorMessages["body"]["commentType"] ?? "",
    "value" => $defaultValues["body"]["commentType"] ?? "",
    "default" => new \App\Support\DTOs\OptionDTO("", "Seçiniz"),
    "options" => $commentTypes,
    "required" => true,
    "disabled" => false,
]) ?>

<!-- Video File -->
<?= $this->insert("Components/Form/File", [
    "name" => "file",
    "label" => "Video Dosyası",
    "icon" => "bi-camera-video",
    "description" => "Yalnızca MP4 dosyaları yükleyebilirsiniz.",
    "errors" => $errorMessages["files"]["file"] ?? "",
    "accept" => ".mp4, video/mp4",
    "required" => true,
    "disabled" => false,
]) ?>

<!-- Thumbnail Photo -->
<?= $this->insert("Components/Form/File", [
    "name" => "thumbnail",
    "label" => "Kapak Fotoğrafı",
    "icon" => "bi-image",
    "description" => "Yalnızca PNG veya JPG dosyaları yükleyebilirsiniz.",
    "errors" => $errorMessages["files"]["thumbnail"] ?? "",
    "accept" => ".png, .jpg, .jpeg, image/png, image/jpeg",
    "required" => false,
    "disabled" => false,
]) ?>

<!-- Oluştur -->
<?= $this->insert("Components/Form/Submit", [
    "icon" => "bi-plus",
    "text" => "Oluştur",
    "color" => "bg-red-500",
    "hoverColor" => "hover:bg-red-600",
    "textColor" => "text-white",
    "fullWidth" => true,
]) ?>