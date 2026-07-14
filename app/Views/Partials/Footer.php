<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var string $brandName  */
/** @var string $dateYear  */
?>

<!-- CONTENT -->
<footer class="mt-auto border-t border-slate-200 bg-white px-4 py-6 sm:px-6 xl:px-8">
    <div class="mx-auto flex w-full max-w-[1600px] flex-col items-center justify-between gap-3 text-center text-sm text-slate-500 sm:flex-row sm:text-left">
        <p>© <?= $dateYear ?> <?= $this->escape($brandName) ?>. Tüm hakları saklıdır.</p>
    </div>
</footer>