<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\ViewModels\Search\IndexPageViewModel $model  */
?>

<!-- EXTRACT MODEL DATA -->
<?php
$search = $model->search;
$brandName = $model->brandName;
$csrfToken = $model->csrfToken;
$dateYear = $model->dateYear;
$navMenus = $model->navMenus;
$auth = $model->auth;
?>

<!-- LAYOUT -->
<?= $this->layout("Layouts/App", (array) new \App\Support\ViewProps\Layouts\AppViewProp(
    brandName: $brandName,
    title: $search !== "" ? $search : "Arama",
    description: "",
    csrfToken: $csrfToken,
    search: $search,
    activeNav: "",
    navMenus: $navMenus,
    dateYear: $dateYear,
    auth: $auth,
)) ?>

<!-- CONTENT -->
<?php if ($search !== ""): ?>
    <!-- Başlık -->
    <?= $this->insert("Components/Common/PageHeader", (array) new \App\Support\ViewProps\Components\Common\PageHeaderViewProp(
        icon: "bi-search",
        title: "\"$search\" için sonuçlar",
        description: "Video, kanal, müzik ve listelerde arama yapılıyor.",
    )) ?>
    <!-- Arama Sonucu -->
    <?= $this->insert("Components/Common/EmptyState", (array) new \App\Support\ViewProps\Components\Common\EmptyStateViewProp(
        icon: "bi-search",
        title: "Arama sonuçları burada görünecek",
        description: "Arama sonucu veri modeli bağlandığında içerikler bu alanda listelenecek.",
    )) ?>
<?php else: ?>
    <!-- Başlık -->
    <?= $this->insert("Components/Common/PageHeader", (array) new \App\Support\ViewProps\Components\Common\PageHeaderViewProp(
        icon: "bi-search",
        title: "Arama",
        description: "Bulmak istediğin içeriği yukarıdaki arama alanına yaz.",
    )) ?>
    <!-- Arama Sonucu -->
    <?= $this->insert("Components/Common/EmptyState", (array) new \App\Support\ViewProps\Components\Common\EmptyStateViewProp(
        icon: "bi-search",
        title: "Ne izlemek istiyorsun?",
        description: "Bir başlık, kanal veya kategori yazarak aramaya başla.",
    )) ?>
<?php endif ?>

<!-- SCRIPT -->
<?= $this->start("scripts") ?>
<?= $this->stop() ?>

<!-- STYLE -->
<?= $this->start("styles") ?>
<?= $this->stop() ?>