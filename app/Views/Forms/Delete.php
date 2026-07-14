<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var string $url  */
/** @var string $title  */
/** @var string $description  */
/** @var bool $disabled  */
?>

<!-- LAYOUT -->
<?= $this->layout("Components/Form/Form", [
    "action" => $url,
]) ?>

<!-- CONTENT -->
<!-- Form Başlığı -->
<?= $this->insert("Components/Form/Heading", [
    "icon" => "bi-person-check",
    "text" => $title,
]) ?>

<!-- Açıklama -->
<p>
    <?= $this->escape($description) ?>
</p>

<!-- Sil -->
<?= $this->insert("Components/Form/Submit", [
    "icon" => "bi-trash",
    "text" => "Kalıcı Olarak Sil",
    "color" => "bg-red-500",
    "hoverColor" => "hover:bg-red-600",
    "textColor" => "text-white",
    "fullWidth" => true,
    "disabled" => $disabled,
]) ?>