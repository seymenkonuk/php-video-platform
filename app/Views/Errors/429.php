<!-- PARAMETERS -->
<?php

use App\Support\DTOs\AuthDTO;

/** @var string $brandName  */
/** @var string $layout  */
/** @var ?string $title  */
/** @var ?string $message  */
/** @var string $dateYear  */
/** @var ?AuthDTO $auth  */

?>

<!-- DEFAULT VALUE -->
<?php

$title ??= "Çok Fazla İstek";
$message ??= "Kısa süre içinde çok fazla istek gönderdiniz. Lütfen bir süre bekleyip tekrar deneyin.";
$auth ??= null;

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