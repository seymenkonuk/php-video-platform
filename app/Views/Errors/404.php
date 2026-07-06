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

$title ??= "Sayfa Bulunamadı";
$message ??= "Aradığınız sayfa kaldırılmış, taşınmış veya hiç var olmamış olabilir.";
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
    "icon" => "bi-search",
    "code" => "404",
    "title" => $title,
    "message" => $message
]) ?>