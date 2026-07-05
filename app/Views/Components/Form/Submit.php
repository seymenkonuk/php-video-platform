<!-- PARAMETERS -->
<?php

/** @var ?string $id  */
/** @var ?string $icon  */
/** @var string $text  */
/** @var string $color  */
/** @var string $hoverColor  */
/** @var string $textColor  */
/** @var ?bool $fullWidth  */
/** @var ?bool $disabled  */

?>

<!-- DEFAULT VALUE -->
<?php

$id ??= "";
$icon ??= "";
$fullWidth ??= true;
$disabled ??= false;

?>

<!-- CONTENT -->
<?= $this->insert("Components/Form/Button", [
    "id" => $id,
    "type" => "submit",
    "icon" => $icon,
    "text" => $text,
    "color" => $color,
    "hoverColor" => $hoverColor,
    "textColor" => $textColor,
    "fullWidth" => $fullWidth,
    "disabled" => $disabled,
]) ?>