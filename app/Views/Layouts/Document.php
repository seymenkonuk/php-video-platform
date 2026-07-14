<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var string $brandName  */
/** @var string $title  */
/** @var ?string $description  */
/** @var ?string $csrfToken  */
?>

<!-- DEFAULT VALUE -->
<?php
$description ??= "";
$csrfToken ??= "";
?>

<!-- CONTENT -->
<!DOCTYPE html>
<html lang="tr">

<head>
    <!-- Meta Bilgileri -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#ffffff">
    <meta name="color-scheme" content="light">
    <!-- Açıklama -->
    <?php if ($description !== ""): ?>
        <meta name="description" content="<?= $this->escape($description) ?>">
    <?php endif ?>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?= $this->escape($csrfToken) ?>">
    <!-- Title -->
    <title><?= $this->escape($title) ?> · <?= $this->escape($brandName) ?></title>

    <!-- Manifest Dosyasını Yükle (PWA için) -->
    <link rel="manifest" href="/manifest.json">

    <!-- Global CSS Dosyaları -->
    <link rel="stylesheet" href="/static/css/tailwind.css">
    <link rel="stylesheet" href="/static/css/hideScrollbar.css">
    <link rel="stylesheet" href="/static/css/bootstrap-icons/bootstrap-icons.css">
    <!-- Sayfaya Özgü CSS Dosyaları ve Kodları -->
    <?= $this->section('styles') ?>
</head>

<body class="min-h-screen bg-slate-50 text-slate-900 antialiased selection:bg-red-100 selection:text-red-900">
    <!-- Sayfaya Özgü HTML İçeriği -->
    <?= $this->section('content') ?>

    <!-- Global JS Dosyaları -->
    <script src="/static/js/addCsrfToken.js"></script>
    <script src="/static/js/hamburgerMenu.js"></script>
    <script src="/static/js/replaceWithFetch.js"></script>
    <script src="/static/js/sanitizeForm.js"></script>
    <script src="/static/js/textareaAutoResize.js"></script>
    <script src="/static/js/togglePassword.js"></script>
    <script src="/static/js/swRegister.js"></script>
    <!-- Sayfaya Özgü JS Dosyaları ve Kodları -->
    <?= $this->section('scripts') ?>
</body>

</html>