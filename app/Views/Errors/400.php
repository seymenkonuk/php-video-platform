<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\ViewModels\ErrorViewModel $model  */
?>

<!-- DEFAULT VALUE -->
<?php
$model->title ??= "Geçersiz İstek";
$model->message ??= "Gönderilen istek işlenemedi. Lütfen bilgileri kontrol ederek tekrar deneyin.";
$model->auth ??= null;
?>

<!-- EXTRACT MODEL DATA -->
<?php
$layout = $model->layout;
$title = $model->title;
$message = $model->message;
$brandName = $model->brandName;
$dateYear = $model->dateYear;
$auth = $model->auth;
?>

<!-- LAYOUT -->
<?= $this->layout($layout, [
    "brandName" => $brandName,
    "title" => $title,
    "dateYear" => $dateYear,
    "auth" => $auth,
]) ?>

<!-- CONTENT -->
<?= $this->insert("Components/Common/ErrorPage", [
    "icon" => "bi-file-earmark-x",
    "code" => "400",
    "title" => $title,
    "message" => $message
]) ?>