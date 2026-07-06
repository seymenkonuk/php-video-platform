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

$title ??= "Sunucu Hatası";
$message ??= "İsteğiniz işlenirken beklenmeyen bir hata oluştu. Lütfen daha sonra tekrar deneyin.";
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
    "icon" => "bi-server",
    "code" => "500",
    "title" => $title,
    "message" => $message
]) ?>