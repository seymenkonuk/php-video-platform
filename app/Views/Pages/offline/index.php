<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\ViewModels\Offline\IndexPageViewModel $model  */
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
<?= $this->layout("Layouts/Offline", [
    "brandName" => $brandName,
    "title" => "Çevrimdışı",
    "description" => "",
    "navMenus" => $navMenus,
    "dateYear" => $dateYear,
    "auth" => $auth,
]) ?>

<!-- CONTENT -->
<div class="relative flex min-h-[70vh] items-center justify-center overflow-hidden px-4 py-12">
    <!-- Arka plan detayları -->
    <div class="pointer-events-none absolute inset-0 overflow-hidden">
        <div class="absolute left-1/2 top-1/2 h-72 w-72 -translate-x-1/2 -translate-y-1/2 rounded-full bg-red-100/60 blur-3xl"></div>
        <div class="absolute -right-20 top-10 h-52 w-52 rounded-full bg-slate-100 blur-3xl"></div>
    </div>

    <div class="relative w-full max-w-lg">
        <div class="overflow-hidden rounded-3xl border border-slate-200/80 bg-white shadow-xl shadow-slate-200/50">
            <!-- Üst vurgu -->
            <div class="h-1.5 bg-gradient-to-r from-red-500 via-red-600 to-rose-500"></div>

            <div class="p-8 text-center sm:p-12">
                <!-- İkon -->
                <div class="relative mx-auto flex h-24 w-24 items-center justify-center">
                    <span class="absolute inset-0 rounded-full bg-red-100/70"></span>
                    <span class="absolute inset-3 rounded-full bg-red-50"></span>

                    <span class="relative flex h-16 w-16 items-center justify-center rounded-2xl bg-red-600 text-3xl text-white shadow-lg shadow-red-200">
                        <i class="bi bi-wifi-off"></i>
                    </span>
                </div>

                <!-- İçerik -->
                <span class="mt-7 inline-flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-600">
                    <span class="h-2 w-2 rounded-full bg-red-500"></span>
                    Çevrimdışı
                </span>

                <h1 class="mt-4 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">
                    İnternet bağlantısı yok
                </h1>

                <p class="mx-auto mt-4 max-w-sm text-sm leading-7 text-slate-500 sm:text-base">
                    Videolara ve diğer içeriklere erişebilmek için internet bağlantını kontrol et ve yeniden dene.
                </p>

                <!-- Bilgilendirme -->
                <div class="mt-7 flex items-start gap-3 rounded-2xl border border-slate-200 bg-slate-50 p-4 text-left">
                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-white text-slate-500 shadow-sm">
                        <i class="bi bi-info-circle"></i>
                    </span>

                    <p class="text-sm leading-6 text-slate-500">
                        Wi-Fi veya mobil veri bağlantının etkin olduğundan emin ol.
                    </p>
                </div>

                <!-- Buton -->
                <button
                    type="button"
                    onclick="updateStatus()"
                    class="group mt-7 inline-flex w-full items-center justify-center gap-2.5 rounded-2xl bg-red-600 px-6 py-3.5 text-sm font-bold text-white shadow-lg shadow-red-200 transition duration-200 hover:bg-red-700 hover:shadow-red-300 focus:outline-none focus:ring-4 focus:ring-red-100 active:scale-[0.98]">
                    <i class="bi bi-arrow-clockwise text-base transition-transform duration-300 group-hover:rotate-180"></i>
                    Bağlantıyı Kontrol Et
                </button>
            </div>
        </div>

        <p class="mt-5 text-center text-xs text-slate-400">
            Bağlantı kurulduğunda sayfa otomatik olarak yenilenebilir.
        </p>
    </div>
</div>

<!-- SCRIPT -->
<?= $this->start("scripts") ?>
<script>
    async function checkInternetConnection() {
        try {
            const response = await fetch('/ping', {
                method: 'GET',
                cache: 'no-store'
            });
            return response.ok;
        } catch (error) {
            return false;
        }
    }
    async function updateStatus() {
        if (await checkInternetConnection()) {
            window.location.href = new URL(window.location.href).pathname === '/offline' ? '/' : window.location.href;
        }
    }
    window.addEventListener('online', updateStatus);
    updateStatus();
</script>
<?= $this->stop() ?>

<!-- STYLE -->
<?= $this->start("styles") ?>
<?= $this->stop() ?>