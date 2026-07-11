<!-- PARAMETERS -->
<?php

use App\Support\ViewModels\ErrorViewModel;

/** @var ErrorViewModel $model  */

?>

<!-- DEFAULT VALUE -->
<?php

$model->title ??= "Oturum Gerekli";
$model->message ??= "Bu sayfaya erişebilmek için hesabınıza giriş yapmanız gerekiyor.";
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
    "icon" => "bi-person-lock",
    "code" => "401",
    "title" => $title,
    "message" => $message
]) ?>