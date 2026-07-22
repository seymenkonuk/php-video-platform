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
<?= $this->layout("Components/Form/Form", (array) new \App\Support\ViewProps\Components\Form\FormViewProp(
    action: $url,
)) ?>

<!-- CONTENT -->
<!-- Form Başlığı -->
<?= $this->insert("Components/Form/Heading", (array) new \App\Support\ViewProps\Components\Form\HeadingViewProp(
    icon: "bi-person-check",
    text: $title,
)) ?>

<!-- Açıklama -->
<p>
    <?= $this->escape($description) ?>
</p>

<!-- Sil -->
<?= $this->insert("Components/Form/Submit", (array) new \App\Support\ViewProps\Components\Form\SubmitViewProp(
    id: null,
    icon: "bi-trash",
    text: "Kalıcı Olarak Sil",
    color: "bg-red-500",
    hoverColor: "hover:bg-red-600",
    textColor: "text-white",
    fullWidth: true,
    disabled: $disabled,
)) ?>