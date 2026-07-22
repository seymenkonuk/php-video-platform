<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\DTOs\UI\PaginationDTO $pagination  */
?>

<!-- CONSTANTS -->
<?php
// Sayfa Numarasından Url Üretir
$paginationUrl = static function (int $pageNumber): string {
    $query = $_GET;
    $query['page'] = $pageNumber;
    return '?' . http_build_query($query);
};

// Hangi Sayfalar için Buton Üretileceğini Döner
$visiblePages = static function (int $currentPage, int $lastPage, int $delta = 3): array {
    $pages = [1];
    $start = max(2, $currentPage - $delta);
    $end = min($lastPage - 1, $currentPage + $delta);

    // Arada Gösterilmeyen Sayfalar Varsa
    if ($start > 2)
        $pages[] = '...';

    // Sayfaları Ekle
    for ($page = $start; $page <= $end; $page++)
        $pages[] = $page;

    // Arada Gösterilmeyen Sayfalar Varsa
    if ($end < $lastPage - 1)
        $pages[] = '...';

    // Son Sayfayı Ekle
    if ($lastPage > 1)
        $pages[] = $lastPage;

    return $pages;
};

// Önceki / Sonraki Butonu
$navButton = function (bool $enabled, string $href, string $icon, string $text, bool $iconFirst = true): string {
    $classes = 'inline-flex h-10 items-center justify-center gap-2 rounded-xl px-3 text-sm font-bold transition sm:px-4';
    if (!$enabled) {
        return '<span class="' . $classes . ' cursor-not-allowed bg-slate-100 text-slate-300">' .
            ($iconFirst ? '<i class="bi ' . $this->escape($icon) . '"></i>' : '') .
            $this->escape($text) .
            (!$iconFirst ? '<i class="bi ' . $this->escape($icon) . '"></i>' : '') . '</span>';
    }
    return '<a href="' . $this->escape($href) . '" class="' . $classes . ' border border-slate-200 bg-white text-slate-700 hover:border-red-200 hover:bg-red-50 hover:text-red-700">' .
        ($iconFirst ? '<i class="bi ' . $this->escape($icon) . '"></i>' : '') .
        $this->escape($text) .
        (!$iconFirst ? '<i class="bi ' . $this->escape($icon) . '"></i>' : '') . '</a>';
};
?>

<!-- CONTENT -->
<?php if ($pagination->lastPage > 1): ?>
    <nav class="flex items-center justify-between gap-3 rounded-2xl border border-slate-200 bg-white p-3 shadow-sm" aria-label="Sayfalama">
        <!-- Önceki Butonu -->
        <?= $navButton($pagination->currentPage > 1, $paginationUrl($pagination->currentPage - 1), 'bi-chevron-left', 'Önceki', true) ?>

        <!-- Masaüstü İçin Sayfa Butonları -->
        <div class="hidden flex-1 flex-wrap justify-center gap-1.5 md:flex">
            <?php foreach ($visiblePages($pagination->currentPage, $pagination->lastPage) as $page): ?>
                <?php if ($page === '...'): ?>
                    <span class="flex h-10 min-w-8 items-center justify-center text-sm font-bold text-slate-400">...</span>
                <?php elseif ($page === $pagination->currentPage): ?>
                    <span aria-current="page" class="flex h-10 min-w-10 items-center justify-center rounded-xl bg-red-600 px-3 text-sm font-black text-white shadow-sm">
                        <?= $page ?>
                    </span>
                <?php else: ?>
                    <a href="<?= $this->escape($paginationUrl($page)) ?>" class="flex h-10 min-w-10 items-center justify-center rounded-xl border border-slate-200 bg-white px-3 text-sm font-bold text-slate-600 transition hover:border-red-200 hover:bg-red-50 hover:text-red-700">
                        <?= $page ?>
                    </a>
                <?php endif ?>
            <?php endforeach ?>
        </div>

        <!-- Mobil İçin Sayfa Numarası -->
        <span class="inline-flex h-10 flex-1 items-center justify-center rounded-xl bg-slate-100 px-4 text-sm font-bold text-slate-600 md:hidden">
            <?= $pagination->currentPage ?> / <?= $pagination->lastPage ?>
        </span>

        <!-- Sonraki Butonu -->
        <?= $navButton($pagination->currentPage < $pagination->lastPage, $paginationUrl($pagination->currentPage + 1), 'bi-chevron-right', 'Sonraki', false) ?>
    </nav>
<?php endif ?>