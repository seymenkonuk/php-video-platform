<!-- PARAMETERS -->
<?php

use App\Support\DTOs\OptionDTO;

/** @var array<OptionDTO> $viewTypes  */
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
    "text" => "Oynatma Listesi Oluştur",
]) ?>

<!-- Başlık -->
<?= $this->insert("Components/Form/TextInput", [
    "name" => "title",
    "label" => "Başlık",
    "icon" => "bi-text-left",
    "placeholder" => "Oynatma listesi başlığınızı giriniz",
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
    "default" => new OptionDTO("", "Seçiniz"),
    "options" => $viewTypes,
    "required" => true,
    "disabled" => false,
]) ?>

<!-- Banner Photo -->
<?= $this->insert("Components/Form/File", [
    "name" => "banner",
    "label" => "Banner Fotoğrafı",
    "icon" => "bi-image",
    "description" => "Yalnızca PNG, JPG veya GIF dosyaları yükleyebilirsiniz.",
    "errors" => $errorMessages["files"]["banner"] ?? "",
    "accept" => ".png, .jpg, .jpeg, .gif, image/png, image/jpeg, image/gif",
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