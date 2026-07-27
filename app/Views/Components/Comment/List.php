<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\DTOs\Comment\ListDTO $commentList */
?>

<!-- CONTENT -->
<section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
    <!-- Başlık -->
    <div class="flex items-center gap-3">
        <!-- İkon -->
        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-red-50 text-red-600">
            <i class="bi bi-chat-left-text text-lg"></i>
        </span>
        <div>
            <h2 class="text-xl font-black text-slate-950">Yorumlar</h2>
            <!-- Bilgiler -->
            <p title="<?= $commentList->count ?> yorum" class="mt-0.5 text-sm text-slate-500">
                <?= $this->escape($commentList->countFormatted) ?> yorum
            </p>
        </div>
    </div>

    <!-- Yorum Yapma Formu -->
    <?= $this->insert("Components/Comment/Composer", (array) new \App\Support\ViewProps\Components\Comment\ComposerViewProp(
        data: $commentList->data,
        enabled: $commentList->enabled,
        loggedIn: $commentList->loggedIn,
        allowed: $commentList->allowed,
    )) ?>

    <?php if ($commentList->comments->valid()): ?>
        <!-- Yorumları Göster -->
        <div class="mt-7 divide-y divide-slate-100">
            <?php foreach ($commentList->comments as $comment): ?>
                <?= $this->insert("Components/Comment/Item", (array) new \App\Support\ViewProps\Components\Comment\ItemViewProp(
                    comment: $comment,
                )) ?>
            <?php endforeach ?>
        </div>
    <?php elseif ($commentList->allowed): ?>
        <!-- Yorum Bulunamadı -->
        <div class="mt-7 rounded-2xl border border-dashed border-slate-300 px-5 py-10 text-center">
            <span class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-red-50 text-xl text-red-600">
                <i class="bi bi-chat-left-text"></i>
            </span>
            <h3 class="mt-4 text-sm font-black text-slate-950">Henüz yorum yapılmamış</h3>
            <p class="mt-1 text-sm leading-6 text-slate-500">
                Bu video hakkındaki ilk yorumu sen yapabilirsin.
            </p>
        </div>
    <?php endif ?>
</section>