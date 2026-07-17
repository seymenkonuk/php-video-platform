<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\ViewModels\Feed\IndexPageViewModel $model  */
?>

<!-- EXTRACT MODEL DATA -->
<?php
$brandName = $model->brandName;
$csrfToken = $model->csrfToken;
$dateYear = $model->dateYear;
$navMenus = $model->navMenus;
$auth = $model->auth;
?>

<!-- LAYOUT -->
<?= $this->layout("Layouts/App", [
    "brandName" => $brandName,
    "title" => "Sana Özel",
    "description" => "",
    "csrfToken" => $csrfToken,
    "activeNav" => "/feed",
    "navMenus" => $navMenus,
    "dateYear" => $dateYear,
    "auth" => $auth,
]) ?>

<!-- CONTENT -->
<!-- Sayfa Başlığı -->
<?= $this->insert("Components/Common/PageHeader", [
    "icon" => "bi-stars",
    "title" => "Sana Özel",
    "description" => "Tüm içeriklerin, aboneliklerin ve aktivitelerin tek bir yerde.",
]) ?>

<section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
    <!-- Kanalların -->
    <?= $this->insert("Components/Common/NavigationCard", [
        "href" => "/feed/channels",
        "icon" => "bi-person-video3",
        "title" => "Kanalların",
        "description" => "Takip ettiğin kanallar",
        "actionLabel" => "Aç",
    ]) ?>
    <!-- Abonelikler -->
    <?= $this->insert("Components/Common/NavigationCard", [
        "href" => "/feed/subscriptions",
        "icon" => "bi-bell",
        "title" => "Abonelikler",
        "description" => "Takip ettiğin kanalların en yeni içerikleri",
        "actionLabel" => "Aç",
    ]) ?>
    <!-- Daha Sonra İzle -->
    <?= $this->insert("Components/Common/NavigationCard", [
        "href" => "/feed/watch-later",
        "icon" => "bi-clock",
        "title" => "Daha Sonra İzle",
        "description" => "Sonra dönmek için kaydettiğin içerikler",
        "actionLabel" => "Aç",
    ]) ?>
    <!-- Geçmiş -->
    <?= $this->insert("Components/Common/NavigationCard", [
        "href" => "/feed/history",
        "icon" => "bi-clock-history",
        "title" => "Geçmiş",
        "description" => "Daha önce izlediğin içerikler",
        "actionLabel" => "Aç",
    ]) ?>
    <!-- Beğendiklerin -->
    <?= $this->insert("Components/Common/NavigationCard", [
        "href" => "/feed/liked",
        "icon" => "bi-hand-thumbs-up",
        "title" => "Beğendiklerin",
        "description" => "Beğendiğin tüm içerikler",
        "actionLabel" => "Aç",
    ]) ?>
    <!-- Oynatma Listeleri -->
    <?= $this->insert("Components/Common/NavigationCard", [
        "href" => "/feed/playlists",
        "icon" => "bi-collection",
        "title" => "Listelerin",
        "description" => "Oluşturduğun oynatma listeleri",
        "actionLabel" => "Aç",
    ]) ?>
    <!-- Yorumların -->
    <?= $this->insert("Components/Common/NavigationCard", [
        "href" => "/feed/comments",
        "icon" => "bi-chat-left-text",
        "title" => "Yorumların",
        "description" => "Paylaştığın yorumlar",
        "actionLabel" => "Aç",
    ]) ?>
    <!-- Yönetim -->
    <?= $this->insert("Components/Common/NavigationCard", [
        "href" => "/studio",
        "icon" => "bi-sliders2",
        "title" => "İçerik Yönetimi",
        "description" => "İçeriklerini ve kanalını yönet",
        "actionLabel" => "Aç",
    ]) ?>
</section>

<!-- SCRIPT -->
<?= $this->start("scripts") ?>
<?= $this->stop() ?>

<!-- STYLE -->
<?= $this->start("styles") ?>
<?= $this->stop() ?>