<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\ViewModels\Home\IndexPageViewModel $model  */
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
    "title" => "Anasayfa",
    "description" => "",
    "csrfToken" => $csrfToken,
    "activeNav" => "/",
    "navMenus" => $navMenus,
    "dateYear" => $dateYear,
    "auth" => $auth,
]) ?>

<!-- CONTENT -->
<!-- Sayfa Header'ı -->
<?= $this->insert("Components/Home/Hero") ?>

<section>
    <!-- Sayfa Başlığı -->
    <?= $this->insert("Components/Common/PageHeader", [
        "icon" => "bi-compass",
        "title" => "İçerik türleri",
        "description" => "İlgini çeken içerik formatına doğrudan geç.",
    ]) ?>

    <div class="mt-5 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <!-- Videolar -->
        <?= $this->insert("Components/Common/NavigationCard", [
            "href" => "/videos",
            "icon" => "bi-play-btn",
            "title" => "Videolar",
            "description" => "Uzun format içerikler",
            "actionLabel" => "Keşfet",
        ]) ?>
        <!-- Kısa Videolar -->
        <?= $this->insert("Components/Common/NavigationCard", [
            "href" => "/shorts",
            "icon" => "bi-lightning-charge",
            "title" => "Shorts",
            "description" => "Kısa ve hızlı içerikler",
            "actionLabel" => "Keşfet",
        ]) ?>
        <!-- Müzikler -->
        <?= $this->insert("Components/Common/NavigationCard", [
            "href" => "/musics",
            "icon" => "bi-music-note-beamed",
            "title" => "Müzikler",
            "description" => "Müzik ve ses içerikleri",
            "actionLabel" => "Keşfet",
        ]) ?>
        <!-- Oynatma Listeleri  -->
        <?= $this->insert("Components/Common/NavigationCard", [
            "href" => "/playlists",
            "icon" => "bi-collection-play",
            "title" => "Listeler",
            "description" => "Düzenlenmiş koleksiyonlar",
            "actionLabel" => "Keşfet",
        ]) ?>
    </div>
</section>

<!-- SCRIPT -->
<?= $this->start("scripts") ?>
<?= $this->stop() ?>

<!-- STYLE -->
<?= $this->start("styles") ?>
<?= $this->stop() ?>