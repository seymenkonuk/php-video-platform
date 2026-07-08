<!-- PARAMETERS -->
<?php

use App\Support\DTOs\SocialLinkDTO;

/** @var SocialLinkDTO $link  */

?>

<!-- CONTENT -->
<a href="<?= $this->escape($link->url) ?>" target="_blank" rel="noopener noreferrer" class="flex items-center gap-3 rounded-xl border border-slate-200 p-3 text-slate-700 transition hover:border-red-200 hover:bg-red-50 hover:text-red-700">
    <!-- İkon -->
    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-slate-100">
        <i class="bi <?= $this->escape($link->icon) ?>"></i>
    </span>
    <!-- Sosyal Medya İsmi -->
    <span class="min-w-0 flex-1 truncate text-sm font-bold"><?= $this->escape($link->name) ?></span>
    <!-- Bağlantı Olduğuna Dair İkon -->
    <i class="bi bi-box-arrow-up-right text-xs"></i>
</a>