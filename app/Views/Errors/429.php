<!-- PARAMETERS -->
<?php

use App\Support\ViewModels\ErrorViewModel;

/** @var ErrorViewModel $model  */

?>

<!-- DEFAULT VALUE -->
<?php

$title ??= "Çok Fazla İstek";
$message ??= "Kısa süre içinde çok fazla istek gönderdiniz. Lütfen bir süre bekleyip tekrar deneyin.";
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
    "icon" => "bi-speedometer2",
    "code" => "429",
    "title" => $title,
    "message" => $message
]) ?>