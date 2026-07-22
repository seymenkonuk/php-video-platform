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

<!-- LAYOUT -->
<?= $this->layout("Layouts/App", (array) new \App\Support\ViewProps\Layouts\AppViewProp(
    brandName: $brandName,
    title: $title,
    description: $description,
    csrfToken: "",
    search: "",
    activeNav: null,
    navMenus: $navMenus,
    dateYear: $dateYear,
    auth: null,
)) ?>

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