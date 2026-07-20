<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var string $url */
/** @var bool $inWatchLater */
?>

<!-- CONSTANTS -->
<?php
$title = $inWatchLater ? "Daha sonra izle listesinden kaldır" : "Daha sonra izle listesine ekle";
$text = $inWatchLater ? "Kaydedildi" : "Daha sonra izle";
$icon = $inWatchLater ? "bi-clock-fill" : "bi-clock";
$class = $inWatchLater ? "bg-red-50 text-red-700 hover:bg-red-100" : "bg-white text-slate-700 hover:border-red-200 hover:bg-red-50 hover:text-red-700";
?>

<!-- LAYOUT -->
<?= $this->layout("Components/Interaction/Button", [
    "url" => $url,
    "title" => $title,
    "class" => "inline-flex min-h-10 items-center justify-center gap-2 rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-semibold shadow-sm transition focus:outline-none focus:ring-4 focus:ring-red-100 $class",
    "grouped" => false,
]) ?>

<!-- CONTENT -->
<i class="bi <?= $this->escape($icon) ?>"></i>
<span class="hidden sm:inline">
    <?= $this->escape($text) ?>
</span>