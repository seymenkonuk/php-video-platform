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

$title ??= "Oturum Gerekli";
$message ??= "Bu sayfaya erişebilmek için hesabınıza giriş yapmanız gerekiyor.";
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
    "icon" => "bi-person-lock",
    "code" => "401",
    "title" => $title,
    "message" => $message
]) ?>