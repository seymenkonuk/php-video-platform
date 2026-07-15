<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\ViewModels\ErrorViewModel $model  */
?>

<!-- DEFAULT VALUE -->
<?php
$model->title ??= "Erişim Reddedildi";
$model->message ??= "Bu sayfayı görüntülemek için gerekli yetkiye sahip değilsiniz.";
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
    "dateYear" => $dateYear,
    "csrfToken" => $csrfToken,
    "navMenus" => $navMenus,
    "auth" => $auth,
]) ?>

<!-- CONTENT -->
<?= $this->insert("Components/Common/ErrorPage", [
    "icon" => "bi-shield-lock",
    "code" => "403",
    "title" => $title,
    "message" => $message
]) ?>