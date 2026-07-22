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
$title = $model->title ?? "Çok Fazla İstek";
$description = $model->description ?? "Kısa süre içinde çok fazla istek gönderdiniz. Lütfen bir süre bekleyip tekrar deneyin.";
?>

<!-- LAYOUT -->
<?= $this->layout($layout, $layoutData) ?>

<!-- CONTENT -->
<?= $this->insert("Components/Common/ErrorPage", (array) new \App\Support\ViewProps\Components\Common\ErrorPageViewProp(
    icon: "bi-speedometer2",
    code: "429",
    title: $title,
    description: $description
)) ?>