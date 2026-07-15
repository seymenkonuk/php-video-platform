<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\ViewModels\ErrorViewModel $model  */
?>

<!-- DEFAULT VALUE -->
<?php
$model->title ??= "Sayfa Bulunamadı";
$model->message ??= "Aradığınız sayfa kaldırılmış, taşınmış veya hiç var olmamış olabilir.";
?>

<!-- EXTRACT MODEL DATA -->
<?php
$layout = $model->layout;
$title = $model->title;
$message = $model->message;
$brandName = $model->brandName;
$csrfToken = $model->csrfToken;
$dateYear = $model->dateYear;
$navMenus = $model->navMenus;
$auth = $model->auth;
?>

<!-- LAYOUT -->
<?= $this->layout($layout, [
    "brandName" => $brandName,
    "title" => $title,
    "navMenus" => $navMenus,
    "dateYear" => $dateYear,
    "csrfToken" => $csrfToken,
    "auth" => $auth,
]) ?>

<!-- CONTENT -->
<?= $this->insert("Components/Common/ErrorPage", [
    "icon" => "bi-search",
    "code" => "404",
    "title" => $title,
    "message" => $message
]) ?>