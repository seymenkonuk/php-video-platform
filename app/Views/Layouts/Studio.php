<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var string $brandName  */
/** @var string $title  */
/** @var ?string $description  */
/** @var string $csrfToken  */
/** @var string $search  */
/** @var ?string $activeNav  */
/** @var array<string, array<\App\Support\DTOs\UI\MenuItemDTO>> $navMenus  */
/** @var string $dateYear  */
/** @var ?\App\Support\DTOs\AuthDTO $auth  */
?>

<!-- LAYOUT -->
<?= $this->layout("Layouts/App", (array) new \App\Support\ViewProps\Layouts\AppViewProp(
    brandName: $brandName,
    title: $title,
    description: $description,
    csrfToken: $csrfToken,
    search: $search,
    activeNav: $activeNav,
    navMenus: $navMenus,
    dateYear: $dateYear,
    auth: $auth,
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