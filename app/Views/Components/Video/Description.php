<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var ?string $description */
?>

<!-- CONSTANTS -->
<?php
$hasDescription = isset($description) && $description !== "";
?>

<!-- CONTENT -->
<?php if ($hasDescription): ?>
    <details class="group mt-5 rounded-2xl bg-slate-50 p-4 sm:p-5">
        <summary class="cursor-pointer list-none">
            <div class="flex items-center gap-3">
                <!-- İkon -->
                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white text-red-600 shadow-sm">
                    <i class="bi bi-card-text"></i>
                </span>
                <!-- Başlık -->
                <h2 class="text-base font-black text-slate-950">
                    Video açıklaması
                </h2>
            </div>

            <span class="mt-4 inline-flex items-center gap-2 text-sm font-bold text-slate-700 transition group-hover:text-red-600">
                <!-- Göster Butonu -->
                <span class="group-open:hidden">
                    Açıklamayı görüntüle
                </span>
                <!-- Gizle Butonu -->
                <span class="hidden group-open:inline">
                    Açıklamayı gizle
                </span>
                <!-- Açılır Menü İkonu -->
                <i class="bi bi-chevron-down text-xs transition-transform duration-200 group-open:rotate-180"></i>
            </span>
        </summary>

        <!-- Açıklama -->
        <p class="mt-4 whitespace-pre-line break-words text-sm leading-7 text-slate-600">
            <?= $this->escape($description) ?>
        </p>
    </details>
<?php else: ?>
    <div class="mt-5 rounded-2xl border border-dashed border-slate-200 bg-slate-50 p-4 sm:p-5">
        <div class="flex items-center gap-3">
            <!-- İkon -->
            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white text-slate-400 shadow-sm">
                <i class="bi bi-card-text"></i>
            </span>

            <div>
                <!-- Başlık -->
                <h2 class="text-base font-black text-slate-700">
                    Video açıklaması
                </h2>
                <!-- Açıklama -->
                <p class="mt-1 text-sm text-slate-400">
                    Bu video için bir açıklama eklenmemiş.
                </p>
            </div>
        </div>
    </div>
<?php endif ?>