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
$title = $model->title ?? "Geçersiz İstek";
$description = $model->description ?? "Gönderilen istek işlenemedi. Lütfen bilgileri kontrol ederek tekrar deneyin.";
?>

<!-- LAYOUT -->
<?= $this->layout($layout, $layoutData) ?>

<!-- CONTENT -->
<?= $this->insert("Components/Common/ErrorPage", (array) new \App\Support\ViewProps\Components\Common\ErrorPageViewProp(
    icon: "bi-file-earmark-x",
    code: "400",
    title: $title,
    description: $description
)) ?>