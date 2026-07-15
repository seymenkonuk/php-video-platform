<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\ViewModels\ErrorViewModel $model  */
?>

<!-- DEFAULT VALUE -->
<?php
$model->title ??= "Oturum Gerekli";
$model->message ??= "Bu sayfaya erişebilmek için hesabınıza giriş yapmanız gerekiyor.";
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
    "icon" => "bi-person-lock",
    "code" => "401",
    "title" => $title,
    "message" => $message
]) ?>