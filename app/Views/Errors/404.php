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
$title = $model->title ?? "Sayfa Bulunamadı";
$description = $model->description ?? "Aradığınız sayfa kaldırılmış, taşınmış veya hiç var olmamış olabilir.";
?>

<!-- LAYOUT -->
<?= $this->layout($layout, $layoutData) ?>

<!-- CONTENT -->
<?= $this->insert("Components/Common/ErrorPage", (array) new \App\Support\ViewProps\Components\Common\ErrorPageViewProp(
    icon: "bi-search",
    code: "404",
    title: $title,
    description: $description
)) ?>