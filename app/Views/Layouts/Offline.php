<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var string $brandName  */
/** @var string $title  */
/** @var ?string $description  */
/** @var array<string, array<\App\Support\DTOs\UI\MenuItemDTO>> $navMenus  */
/** @var string $dateYear  */
?>

<!-- DEFAULT VALUE -->
<?php
$description ??= "";
?>

<!-- LAYOUT -->
<?= $this->layout("Layouts/App", [
    "brandName" => $brandName,
    "title" => $title,
    "description" => $description,
    "navMenus" => $navMenus,
    "dateYear" => $dateYear,
]) ?>

<!-- CONTENT -->
<?= $this->section('content') ?>

<!-- SCRIPT -->
<?= $this->start("scripts") ?>
<?= $this->section("scripts") ?>
<?= $this->stop() ?>

<!-- STYLE -->
<?= $this->start("styles") ?>
<?= $this->section("styles") ?>
<?= $this->stop() ?>