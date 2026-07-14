<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var ?string $icon  */
/** @var string $code  */
/** @var string $title  */
/** @var string $message  */
?>

<!-- DEFAULT VALUE -->
<?php
$icon ??= "bi-exclamation-triangle";
?>

<!-- CONTENT -->
<div class="flex min-h-[70vh] items-center justify-center px-4 py-10 sm:px-6 lg:px-8">
    <section class="relative w-full max-w-3xl overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-xl shadow-slate-200/60">
        <!-- Arka plan dekorları -->
        <div class="pointer-events-none absolute -right-24 -top-24 h-72 w-72 rounded-full bg-red-100/80 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-28 -left-20 h-72 w-72 rounded-full bg-slate-100 blur-3xl"></div>

        <div class="relative z-10 px-6 py-12 sm:px-12 sm:py-16 lg:px-16 lg:py-20">
            <div class="mx-auto flex max-w-2xl flex-col items-center text-center">
                <!-- İkon -->
                <div class="flex h-20 w-20 items-center justify-center rounded-3xl bg-red-50 text-4xl text-red-600 ring-1 ring-red-100 sm:h-24 sm:w-24 sm:text-5xl">
                    <i class="bi <?= $this->escape($icon) ?>"></i>
                </div>

                <!-- Hata kodu -->
                <span class="mt-8 inline-flex items-center rounded-full border border-red-100 bg-red-50 px-4 py-2 text-sm font-extrabold uppercase tracking-[0.2em] text-red-700 sm:text-base">
                    Hata <?= $this->escape($code) ?>
                </span>

                <!-- Başlık -->
                <h1 class="mt-6 text-3xl font-black leading-tight tracking-tight text-slate-950 sm:text-4xl lg:text-5xl">
                    <?= $this->escape($title) ?>
                </h1>

                <!-- Mesaj -->
                <p class="mt-5 max-w-xl text-base leading-8 text-slate-600 sm:text-lg sm:leading-9">
                    <?= $this->escape($message) ?>
                </p>

                <!-- Butonlar -->
                <div class="mt-10 flex w-full flex-col justify-center gap-3 sm:w-auto sm:flex-row">
                    <!-- Ana Sayfaya Dön -->
                    <a href="/" class="inline-flex min-h-14 items-center justify-center gap-3 rounded-2xl bg-red-600 px-7 py-4 text-base font-bold text-white shadow-lg shadow-red-600/20 transition duration-200 hover:-translate-y-0.5 hover:bg-red-700 hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-red-100">
                        <i class="bi bi-house-door-fill text-lg"></i>Ana Sayfaya Dön
                    </a>
                    <!-- Geri Git -->
                    <button type="button" onclick="history.back()" class="inline-flex min-h-14 items-center justify-center gap-3 rounded-2xl border border-slate-200 bg-white px-7 py-4 text-base font-bold text-slate-700 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:border-slate-300 hover:bg-slate-50 hover:text-slate-950 focus:outline-none focus:ring-4 focus:ring-slate-100">
                        <i class="bi bi-arrow-left text-lg"></i>Önceki Sayfaya Dön
                    </button>
                </div>
            </div>
        </div>
    </section>
</div>