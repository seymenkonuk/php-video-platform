<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- CONTENT -->
<section class="relative overflow-hidden rounded-3xl bg-slate-950 px-6 py-12 text-white shadow-xl sm:px-10 sm:py-16 lg:px-14">
    <!-- Arkaplan Dekorasyon -->
    <div class="absolute -right-20 -top-24 h-72 w-72 rounded-full bg-red-600 opacity-35 blur-3xl"></div>
    <div class="absolute -bottom-24 left-1/3 h-64 w-64 rounded-full bg-orange-500 opacity-20 blur-3xl"></div>

    <div class="relative z-10 max-w-3xl">
        <!-- Badge -->
        <span class="inline-flex items-center gap-2 rounded-full border border-white border-opacity-20 bg-white bg-opacity-10 px-3 py-1.5 text-xs font-bold uppercase tracking-widest backdrop-blur">
            <i class="bi bi-stars text-red-400"></i>
            Keşfetmeye başla
        </span>
        <!-- Başlık -->
        <h1 class="mt-5 text-3xl font-black leading-tight tracking-tight sm:text-5xl">
            İzlemek istediğin her şey tek bir yerde.
        </h1>
        <!-- Açıklama -->
        <p class="mt-5 max-w-2xl text-base leading-8 text-slate-300 sm:text-lg">
            Videoları, kısa içerikleri, müzikleri, kanalları ve özenle hazırlanmış oynatma listelerini keşfet.
        </p>
        <!-- Butonlar -->
        <div class="mt-8 flex flex-col gap-3 sm:flex-row">
            <!-- Videolar -->
            <a href="/videos" class="inline-flex items-center justify-center gap-2 rounded-xl bg-red-600 px-5 py-3 text-sm font-bold text-white shadow-lg transition hover:bg-red-700">
                <i class="bi bi-play-fill"></i>
                Videoları Keşfet
            </a>
            <!-- Kanallar -->
            <a href="/channels" class="inline-flex items-center justify-center gap-2 rounded-xl border border-white border-opacity-25 bg-white bg-opacity-10 px-5 py-3 text-sm font-bold text-white backdrop-blur transition hover:bg-white hover:bg-opacity-20">
                <i class="bi bi-people"></i>
                Kanalları Gör
            </a>
        </div>
    </div>
</section>