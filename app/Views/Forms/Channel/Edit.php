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

<!-- LAYOUT -->
<?= $this->layout("Components/Form/Form", [
    "action" => "",
]) ?>

<!-- CONTENT -->
<!-- Form Başlığı -->
<?= $this->insert("Components/Form/Heading", [
    "icon" => "bi-person-check",
    "text" => "Kanalı Düzenle",
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
    "disabled" => true,
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

<!-- Değişiklikleri Kaydet -->
<?= $this->insert("Components/Form/Submit", [
    "icon" => "bi-pencil-square",
    "text" => "Değişiklikleri Kaydet",
    "color" => "bg-red-500",
    "hoverColor" => "hover:bg-red-600",
    "textColor" => "text-white",
    "fullWidth" => true,
]) ?>