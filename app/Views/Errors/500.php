<!-- PARAMETERS -->
<?php

use App\Support\ViewModels\ErrorViewModel;

/** @var ErrorViewModel $model  */

?>

<!-- DEFAULT VALUE -->
<?php

$title ??= "Sunucu Hatası";
$message ??= "İsteğiniz işlenirken beklenmeyen bir hata oluştu. Lütfen daha sonra tekrar deneyin.";
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
    "icon" => "bi-server",
    "code" => "500",
    "title" => $title,
    "message" => $message
]) ?>