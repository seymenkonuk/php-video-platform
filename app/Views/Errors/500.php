<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\ViewModels\ErrorViewModel $model  */
?>

<!-- EXTRACT MODEL DATA -->
<?php
$layout = $model->layout;
$layoutData = $model->layoutData;
$title = $model->title ?? "Sunucu Hatası";
$description = $model->description ?? "İsteğiniz işlenirken beklenmeyen bir hata oluştu. Lütfen daha sonra tekrar deneyin.";
?>

<!-- LAYOUT -->
<?= $this->layout($layout, $layoutData) ?>

<!-- CONTENT -->
<?= $this->insert("Components/Common/ErrorPage", (array) new \App\Support\ViewProps\Components\Common\ErrorPageViewProp(
    icon: "bi-server",
    code: "500",
    title: $title,
    description: $description
)) ?>