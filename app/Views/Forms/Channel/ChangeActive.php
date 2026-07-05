<!-- PARAMETERS -->
<?php

/** @var string $url  */
/** @var string $title  */
/** @var string $description  */
/** @var string $channelCode  */
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

<!-- Kanal Kodu (Gizli Input) -->
<input type="hidden" name="channelCode" value="<?= $channelCode; ?>">

<!-- Değiştir -->
<?= $this->insert("Components/Form/Submit", [
    "icon" => "bi-check",
    "text" => "Aktif Kanal Olarak Belirle",
    "color" => "bg-red-500",
    "hoverColor" => "hover:bg-red-600",
    "textColor" => "text-white",
    "fullWidth" => true,
    "disabled" => $disabled,
]) ?>