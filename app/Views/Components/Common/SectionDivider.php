<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var string $text  */
/** @var string $icon  */
?>

<!-- CONTENT -->
<div class="flex items-center py-2" role="separator">
    <!-- Sol Çizgi -->
    <div class="h-px flex-1 bg-slate-200"></div>
    <span class="mx-4 inline-flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-500">
        <!-- İkon -->
        <i class="bi <?= $this->escape($icon) ?>"></i>
        <!-- Metin -->
        <?= $this->escape($text) ?>
    </span>
    <!-- Sağ Çizgi -->
    <div class="h-px flex-1 bg-slate-200"></div>
</div>