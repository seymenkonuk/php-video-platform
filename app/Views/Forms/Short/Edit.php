<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var ?array<\App\Support\DTOs\UI\OptionDTO> $captions  */
/** @var array<\App\Support\DTOs\UI\OptionDTO> $commentTypes  */
/** @var array<\App\Support\DTOs\UI\OptionDTO> $viewTypes  */
/** @var array<mixed> $errorMessages  */
/** @var array<mixed> $defaultValues  */
?>

<!-- DEFAULT VALUE -->
<?php
$captions ??= [];
?>

<!-- LAYOUT -->
<?= $this->layout("Components/Form/Form", [
    "action" => "",
]) ?>

<!-- CONTENT -->
<!-- Form Başlığı -->
<?= $this->insert("Components/Form/Heading", [
    "icon" => "bi-person-check",
    "text" => "Kısa Videoyu Düzenle",
]) ?>

<!-- Başlık -->
<?= $this->insert("Components/Form/TextInput", [
    "name" => "title",
    "label" => "Başlık",
    "icon" => "bi-text-left",
    "placeholder" => "Kısa video başlığınızı giriniz",
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
    "default" => new \App\Support\DTOs\UI\OptionDTO("", "Seçiniz"),
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
    "default" => new \App\Support\DTOs\UI\OptionDTO("", "Seçiniz"),
    "options" => $commentTypes,
    "required" => true,
    "disabled" => false,
]) ?>

<!-- Transkript -->
<?= $this->insert("Components/Form/Select", [
    "name" => "transcript",
    "label" => "Transkript",
    "icon" => "bi-file-text",
    "description" => "",
    "errors" => $errorMessages["body"]["transcript"] ?? "",
    "value" => $defaultValues["body"]["transcript"] ?? "",
    "default" => new \App\Support\DTOs\UI\OptionDTO("", "Seçiniz"),
    "options" => $captions,
    "required" => false,
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