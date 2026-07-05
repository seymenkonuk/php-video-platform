<!-- PARAMETERS -->
<?php

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
    "text" => "Yeni Kanal Oluştur",
]) ?>

<!-- Kanal Adı -->
<?= $this->insert("Components/Form/TextInput", [
    "name" => "name",
    "label" => "Ad",
    "icon" => "bi-person-lines-fill",
    "placeholder" => "Kanal adını giriniz",
    "description" => "",
    "errors" => $errorMessages["body"]["name"] ?? "",
    "value" => $defaultValues["body"]["name"] ?? "",
    "required" => true,
    "disabled" => false,
]) ?>

<!-- Başlık -->
<?= $this->insert("Components/Form/TextInput", [
    "name" => "title",
    "label" => "Başlık",
    "icon" => "bi-text-left",
    "placeholder" => "Kanal başlığınızı giriniz",
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

<!-- Instagram -->
<?= $this->insert("Components/Form/TextInput", [
    "name" => "instagramUrl",
    "label" => "Instagram",
    "icon" => "bi-instagram",
    "placeholder" => "Instagram URL'ninizi giriniz",
    "description" => "",
    "errors" => $errorMessages["body"]["instagramUrl"] ?? "",
    "value" => $defaultValues["body"]["instagramUrl"] ?? "",
    "required" => false,
    "disabled" => false,
]) ?>

<!-- Twitter -->
<?= $this->insert("Components/Form/TextInput", [
    "name" => "twitterUrl",
    "label" => "Twitter",
    "icon" => "bi-twitter",
    "placeholder" => "Twitter URL'ninizi giriniz",
    "description" => "",
    "errors" => $errorMessages["body"]["twitterUrl"] ?? "",
    "value" => $defaultValues["body"]["twitterUrl"] ?? "",
    "required" => false,
    "disabled" => false,
]) ?>

<!-- Facebook -->
<?= $this->insert("Components/Form/TextInput", [
    "name" => "facebookUrl",
    "label" => "Facebook",
    "icon" => "bi-facebook",
    "placeholder" => "Facebook URL'ninizi giriniz",
    "description" => "",
    "errors" => $errorMessages["body"]["facebookUrl"] ?? "",
    "value" => $defaultValues["body"]["facebookUrl"] ?? "",
    "required" => false,
    "disabled" => false,
]) ?>

<!-- LinkedIn -->
<?= $this->insert("Components/Form/TextInput", [
    "name" => "linkedinUrl",
    "label" => "LinkedIn",
    "icon" => "bi-linkedin",
    "placeholder" => "LinkedIn URL'ninizi giriniz",
    "description" => "",
    "errors" => $errorMessages["body"]["linkedinUrl"] ?? "",
    "value" => $defaultValues["body"]["linkedinUrl"] ?? "",
    "required" => false,
    "disabled" => false,
]) ?>

<!-- GitHub -->
<?= $this->insert("Components/Form/TextInput", [
    "name" => "githubUrl",
    "label" => "GitHub",
    "icon" => "bi-github",
    "placeholder" => "GitHub URL'ninizi giriniz",
    "description" => "",
    "errors" => $errorMessages["body"]["githubUrl"] ?? "",
    "value" => $defaultValues["body"]["githubUrl"] ?? "",
    "required" => false,
    "disabled" => false,
]) ?>

<!-- Avatar -->
<?= $this->insert("Components/Form/File", [
    "name" => "avatar",
    "label" => "Profil Fotoğrafı",
    "icon" => "bi-image",
    "description" => "Yalnızca PNG veya JPG dosyaları yükleyebilirsiniz.",
    "errors" => $errorMessages["files"]["avatar"] ?? "",
    "accept" => ".png, .jpg, .jpeg, image/png, image/jpeg",
    "required" => true,
    "disabled" => false,
]) ?>

<!-- Banner -->
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