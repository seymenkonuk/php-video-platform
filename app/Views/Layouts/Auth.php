<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var string $brandName  */
/** @var string $title  */
/** @var ?string $description  */
/** @var ?string $csrfToken  */
/** @var string $dateYear  */
?>

<!-- DEFAULT VALUE -->
<?php
$description ??= "";
$csrfToken ??= "";
?>

<!-- LAYOUT -->
<?= $this->layout("Layouts/Document", [
    "brandName" => $brandName,
    "title" => $title,
    "description" => $description,
    "csrfToken" => $csrfToken,
]) ?>

<!-- CONTENT -->
<div class="grid min-h-screen w-full lg:grid-cols-2">
    <aside class="relative hidden overflow-hidden bg-slate-950 p-12 text-white lg:flex lg:flex-col lg:justify-between">
        <div class="absolute -right-28 -top-28 h-80 w-80 rounded-full bg-red-600 opacity-30 blur-3xl"></div>
        <div class="absolute -bottom-36 -left-24 h-96 w-96 rounded-full bg-orange-500 opacity-20 blur-3xl"></div>

        <!-- Marka (Masaüstü) -->
        <div class="relative z-10">
            <?= $this->insert("Partials/Brand", [
                "brandName" => $brandName,
                "textColor" => "text-white",
            ]) ?>
        </div>

        <div class="relative z-10 max-w-xl">
            <span class="mb-6 inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-white text-red-600 shadow-2xl">
                <i class="bi bi-play-fill text-4xl"></i>
            </span>
            <h1 class="text-4xl font-black leading-tight xl:text-5xl">İzle, paylaş ve kendi topluluğunu oluştur.</h1>
            <p class="mt-5 max-w-lg text-lg leading-8 text-slate-300">Videoları, kısa içerikleri, müzikleri ve oynatma listelerini tek bir modern platformda keşfet.</p>
        </div>

        <!-- Yıl ve Marka İsmi -->
        <p class="relative z-10 text-sm text-slate-400">© <?= $this->escape($dateYear) ?> <?= $this->escape($brandName) ?></p>
    </aside>

    <main class="relative flex min-h-screen items-center justify-center overflow-hidden px-4 py-10 sm:px-8">
        <div class="absolute -right-24 top-10 h-72 w-72 rounded-full bg-red-100 blur-3xl"></div>
        <div class="relative z-10 w-full max-w-xl">
            <!-- Marka (Mobil) -->
            <div class="mb-7 flex justify-center lg:hidden">
                <?= $this->insert("Partials/Brand", [
                    "brandName" => $brandName,
                ]) ?>
            </div>
            <!-- Content (Giriş ya da Kayıt Ol Formu) -->
            <?= $this->section('content') ?>
        </div>
    </main>
</div>

<!-- SCRIPT -->
<?= $this->start("scripts") ?>
<?= $this->section("scripts") ?>
<?= $this->stop() ?>

<!-- STYLE -->
<?= $this->start("styles") ?>
<?= $this->section("styles") ?>
<?= $this->stop() ?>