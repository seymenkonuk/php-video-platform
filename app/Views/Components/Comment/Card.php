<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\DTOs\Comment\CardDTO $comment */
?>

<!-- LAYOUT -->
<?= $this->layout("Components/Common/Card", (array) new \App\Support\ViewProps\Components\Common\CardViewProp()) ?>

<!-- CONTENT -->
<a href="<?= $this->escape($comment->videoUrl) ?>" class="group flex min-w-0 gap-3 p-4 outline-none focus-visible:ring-4 focus-visible:ring-inset focus-visible:ring-red-100 sm:gap-4 sm:p-5">
    <!-- Kanal Resmi -->
    <img src="<?= $this->escape($comment->channel->avatar) ?>" alt="<?= $this->escape($comment->channel->title) ?>" loading="lazy" class="h-10 w-10 shrink-0 rounded-full bg-slate-100 object-cover sm:h-11 sm:w-11">

    <div class="min-w-0 flex-1">
        <div class="flex min-w-0 items-start justify-between gap-3">
            <div class="flex min-w-0 flex-wrap items-center gap-x-2 gap-y-1">
                <!-- Kanal Başlığı -->
                <span class="truncate text-sm font-bold text-slate-950">
                    <?= $this->escape($comment->channel->title) ?>
                </span>
                <!-- Yorum Tarihi -->
                <span title="<?= $this->escape($comment->date) ?>" class="text-xs text-slate-500">
                    <?= $this->escape($comment->dateFormatted) ?>
                </span>
                <!-- Düzenlendi Badge -->
                <?php if ($comment->edited): ?>
                    <span class="text-xs text-slate-400">
                        Düzenlendi
                    </span>
                <?php endif ?>
            </div>
            <!-- İkon -->
            <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-slate-400 transition group-hover:bg-red-50 group-hover:text-red-600">
                <i class="bi bi-arrow-up-right"></i>
            </span>
        </div>

        <!-- Yorum İçeriği -->
        <p class="mt-2 whitespace-pre-line break-words text-sm leading-6 text-slate-700">
            <?= $this->escape($comment->message) ?>
        </p>
    </div>
</a>