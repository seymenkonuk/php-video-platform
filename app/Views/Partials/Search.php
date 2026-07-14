<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var ?string $search  */
?>

<!-- DEFAULT VALUE -->
<?php
$search ??= "";
?>

<!-- CONTENT -->
<form action="/search" method="GET" role="search" class="flex w-full min-w-0 items-stretch">
    <!-- Ekran Okuyucuları için -->
    <label for="global-search" class="sr-only">Platformda ara</label>

    <div class="relative min-w-0 flex-1">
        <!-- Arama İkonu -->
        <i class="bi bi-search pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
        <!-- Arama Çubuğu -->
        <input
            id="global-search"
            type="search"
            name="q"
            value="<?= $this->escape($search) ?>"
            placeholder="Video, kanal, müzik veya liste ara"
            autocomplete="off"
            class="h-11 w-full rounded-l-2xl border border-slate-300 bg-slate-50 py-2 pl-11 pr-4 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-red-500 focus:bg-white focus:ring-4 focus:ring-red-100" />
    </div>

    <!-- Arama Butonu -->
    <button
        type="submit"
        aria-label="Ara"
        class="inline-flex h-11 shrink-0 items-center justify-center gap-2 rounded-r-2xl border border-l-0 border-slate-900 bg-slate-900 px-4 text-sm font-semibold text-white transition hover:bg-red-600 focus:outline-none focus:ring-4 focus:ring-red-100 sm:px-5">
        <i class="bi bi-search"></i>
        <span class="hidden lg:inline">Ara</span>
    </button>
</form>