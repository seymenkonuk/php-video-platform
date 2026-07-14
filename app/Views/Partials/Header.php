<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var string $brandName  */
/** @var ?string $search  */
/** @var ?\App\Support\DTOs\AuthDTO $auth  */
?>

<!-- DEFAULT VALUE -->
<?php
$search ??= "";
$auth ??= null;
?>

<!-- CONTENT -->
<header class="fixed inset-x-0 top-0 z-40 border-b border-slate-200 bg-white bg-opacity-95 backdrop-blur xl:left-72">
    <div class="flex h-16 w-full items-center gap-3 px-4 sm:gap-4 sm:px-6 xl:h-20 xl:px-8">
        <!-- Marka (Mobil) -->
        <div class="shrink-0 xl:hidden">
            <?= $this->insert("Partials/Brand", [
                "brandName" => $brandName,
            ]) ?>
        </div>

        <!-- Arama Çubuğu (Masaüstü) -->
        <div class="hidden min-w-0 flex-1 justify-center md:flex">
            <div class="w-full max-w-2xl">
                <?= $this->insert("Partials/Search", [
                    "search" => $search,
                ]) ?>
            </div>
        </div>

        <!-- Hesap Menüsü (Masaüstü) -->
        <div class="ml-auto hidden shrink-0 items-center gap-3 xl:flex">
            <?= $this->insert("Partials/AccountMenu", [
                "auth" => $auth,
            ]) ?>
        </div>

        <!-- Hamburger Menu Butonu -->
        <button
            id="mobile-menu-button"
            type="button"
            aria-label="Menüyü aç"
            class="ml-auto flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-700 shadow-sm transition hover:border-slate-300 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 xl:hidden md:ml-0">
            <i class="bi bi-list text-2xl"></i>
        </button>
    </div>

    <!-- Arama Çubuğu (Mobil) -->
    <div class="border-t border-slate-100 px-4 py-3 sm:px-6 md:hidden">
        <?= $this->insert("Partials/Search", [
            "search" => $search,
        ]) ?>
    </div>
</header>