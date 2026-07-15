<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var string $brandName  */
/** @var string $title  */
/** @var ?string $description  */
/** @var ?string $csrfToken  */
/** @var ?string $search  */
/** @var ?string $activeNav  */
/** @var array<string, array<\App\Support\DTOs\UI\MenuItemDTO>> $navMenus  */
/** @var string $dateYear  */
/** @var ?\App\Support\DTOs\AuthDTO $auth  */
?>

<!-- DEFAULT VALUE -->
<?php
$description ??= "";
$csrfToken ??= "";
$search ??= "";
$activeNav ??= "";
$auth ??= null;
?>

<!-- LAYOUT -->
<?= $this->layout("Layouts/Document", [
    "brandName" => $brandName,
    "title" => $title,
    "description" => $description,
    "csrfToken" => $csrfToken,
]) ?>

<!-- CONTENT -->
<!-- Header -->
<?= $this->insert("Partials/Header", [
    "brandName" => $brandName,
    "search" => $search,
    "auth" => $auth,
]) ?>
<!-- Sidebar -->
<?= $this->insert("Partials/Sidebar", [
    "brandName" => $brandName,
    "activeNav" => $activeNav,
    "navMenus" => $navMenus,
    "auth" => $auth,
]) ?>

<div class="flex min-h-screen flex-col xl:pl-72">
    <main class="mx-auto flex w-full max-w-[1600px] flex-1 flex-col gap-6 px-4 pb-10 pt-36 sm:px-6 md:pt-24 xl:px-8">
        <!-- Content -->
        <?= $this->section('content') ?>
    </main>
    <!-- Footer -->
    <?= $this->insert("Partials/Footer", [
        "brandName" => $brandName,
        "dateYear" => $dateYear,
    ]) ?>
</div>

<!-- SCRIPT -->
<?= $this->start("scripts") ?>
<?= $this->section("scripts") ?>
<?= $this->stop() ?>

<!-- STYLE -->
<?= $this->start("styles") ?>
<?= $this->section("styles") ?>
<?= $this->stop() ?>