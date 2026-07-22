<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var string $url  */
/** @var string $channelCode  */
/** @var bool $disabled  */
?>

<!-- LAYOUT -->
<?= $this->layout("Components/Form/Form", (array) new \App\Support\ViewProps\Components\Form\FormViewProp(
    action: $url,
)) ?>

<!-- CONTENT -->
<!-- Form Başlığı -->
<?= $this->insert("Components/Form/Heading", (array) new \App\Support\ViewProps\Components\Form\HeadingViewProp(
    icon: "bi-person-check",
    text: "Hesap Değiştir",
)) ?>

<!-- Açıklama -->
<p>Bu işlem sonrasında seçtiğiniz kanala geçiş yapacaksınız.</p>

<!-- Kanal Kodu (Gizli Input) -->
<input type="hidden" name="channelCode" value="<?= $channelCode; ?>">

<!-- Değiştir -->
<?= $this->insert("Components/Form/Submit", (array) new \App\Support\ViewProps\Components\Form\SubmitViewProp(
    id: null,
    icon: "bi-check",
    text: "Aktif Kanal Olarak Belirle",
    color: "bg-red-500",
    hoverColor: "hover:bg-red-600",
    textColor: "text-white",
    fullWidth: true,
    disabled: $disabled,
)) ?>