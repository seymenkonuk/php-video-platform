<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\ViewModels\Studio\Dashboard\IndexPageViewModel $model  */
?>

<!-- EXTRACT MODEL DATA -->
<?php
$editUrl = $model->editUrl;
$changePasswordUrl = $model->changePasswordUrl;
$deleteUrl = $model->deleteUrl;
$brandName = $model->brandName;
$csrfToken = $model->csrfToken;
$dateYear = $model->dateYear;
$navMenus = $model->navMenus;
$auth = $model->auth;
?>

<!-- LAYOUT -->
<?= $this->layout("Layouts/Studio", (array) new \App\Support\ViewProps\Layouts\StudioViewProp(
    brandName: $brandName,
    title: "Yönetim",
    description: "",
    csrfToken: $csrfToken,
    search: "",
    activeNav: "/studio",
    navMenus: $navMenus,
    dateYear: $dateYear,
    auth: $auth,
)) ?>

<!-- CONTENT -->
<section class="grid grid-cols-1 gap-4">
    <?= $this->insert("Components/Common/SettingsLink", (array) new \App\Support\ViewProps\Components\Common\SettingsLinkViewProp(
        href: $editUrl,
        icon: "bi-person-lines-fill",
        title: "Hesap Bilgileri",
        description: "Profil ve hesap bilgilerini güncelle",
    )); ?>
    <?= $this->insert("Components/Common/SettingsLink", (array) new \App\Support\ViewProps\Components\Common\SettingsLinkViewProp(
        href: $changePasswordUrl,
        icon: "bi-key-fill",
        title: "Parolayı Değiştir",
        description: "Hesabın için yeni parola belirle",
    )); ?>
</section>

<!-- SCRIPT -->
<?= $this->start("scripts") ?>
<?= $this->stop() ?>

<!-- STYLE -->
<?= $this->start("styles") ?>
<?= $this->stop() ?>