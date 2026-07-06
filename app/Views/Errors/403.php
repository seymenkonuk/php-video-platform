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

$title ??= "Erişim Reddedildi";
$message ??= "Bu sayfayı görüntülemek için gerekli yetkiye sahip değilsiniz.";
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
    "icon" => "bi-shield-lock",
    "code" => "403",
    "title" => $title,
    "message" => $message
]) ?>