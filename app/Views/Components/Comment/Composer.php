<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var string $data */
/** @var bool $enabled */
/** @var bool $loggedIn */
/** @var bool $allowed */
?>

<!-- CONSTANTS -->
<?php
$url = "/comments";
?>

<!-- CONTENT -->
<?php if (!$enabled): ?>
    <!-- Yorum Yapma Özelliği Kapalı -->
    <div class="mt-5 flex items-start gap-4 rounded-2xl border border-slate-200 bg-slate-50 p-5">
        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white text-slate-500 shadow-sm">
            <i class="bi bi-chat-square-x text-lg"></i>
        </span>
        <div>
            <h3 class="text-sm font-black text-slate-950">Yorumlar kapatıldı</h3>
            <p class="mt-1 text-sm leading-6 text-slate-500">
                Bu video için yorum yapma özelliği kapatılmıştır.
            </p>
        </div>
    </div>
<?php elseif ($allowed): ?>
    <!-- Yorum Yapma Formu  -->
    <div class="mt-6 flex items-start gap-3 rounded-2xl border border-slate-200 bg-slate-50 p-4">
        <div class="min-w-0 flex-1">
            <label for="comment-message" class="sr-only">Yorum</label>
            <textarea
                name="message"
                placeholder="Yorum ekle..."
                oninput="autoResize(this)"
                class="min-h-11 w-full resize-none border-0 border-b border-slate-300 bg-transparent px-0 py-2 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-red-500 focus:ring-0"
                required></textarea>

            <div class="mt-3 flex justify-end">
                <!-- Yorum Yap Butonu Eklenecek -->
            </div>
        </div>
    </div>
<?php elseif (!$loggedIn): ?>
    <!-- Yorum Yapmak için Giriş Yapmalısın -->
    <div class="mt-5 flex items-start gap-4 rounded-2xl border border-slate-200 bg-slate-50 p-5">
        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white text-slate-500 shadow-sm">
            <i class="bi bi-person-lock text-lg"></i>
        </span>
        <div>
            <h3 class="text-sm font-black text-slate-950">Yorum yapmak için giriş yapmalısın</h3>
            <p class="mt-1 text-sm leading-6 text-slate-500">
                Hesabına giriş yaptıktan sonra videoya yorum yapabilirsin.
            </p>
            <a href="/login" class="mt-3 inline-flex min-h-10 items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-red-200 hover:bg-red-50 hover:text-red-700">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Giriş yap</span>
            </a>
        </div>
    </div>
<?php else: ?>
    <!-- Yorum Yapma İznin Yok -->
    <div class="mt-5 flex items-start gap-4 rounded-2xl border border-slate-200 bg-slate-50 p-5">
        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white text-slate-500 shadow-sm">
            <i class="bi bi-chat-square-x text-lg"></i>
        </span>
        <div>
            <h3 class="text-sm font-black text-slate-950">Yorum yapma iznin bulunmuyor</h3>
            <p class="mt-1 text-sm leading-6 text-slate-500">
                Bu videoya yeni bir yorum gönderemezsin.
            </p>
        </div>
    </div>
<?php endif ?>