<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var string $poster */
/** @var string $source */
/** @var int $startTime */
/** @var ?string $nextUrl */
?>

<!-- CONSTANTS -->
<?php
$hasNextUrl = isset($nextUrl) && $nextUrl !== "";
?>

<!-- CONTENT -->
<section class="relative mx-auto w-full max-w-md overflow-hidden rounded-3xl border border-slate-200 bg-black shadow-xl shadow-slate-950/10">
    <div class="relative aspect-[9/16] max-h-[calc(100vh-8rem)] bg-black">
        <video
            class="h-full w-full bg-black object-contain"
            poster="<?= $this->escape($poster) ?>"
            controls

            <?php if ($startTime > 0): ?>
            data-start-time="<?= $startTime ?>"
            onloadedmetadata="this.currentTime = this.dataset.startTime"
            <?php endif; ?>

            <?php if ($hasNextUrl): ?>
            data-next-url="<?= $this->escape($nextUrl) ?>"
            onended="window.location.href = this.dataset.nextUrl"
            <?php endif; ?>>

            <source src="<?= $this->escape($source) ?>">
            Tarayıcınız video oynatmayı desteklemiyor.
        </video>

        <span class="pointer-events-none absolute left-4 top-4 inline-flex h-10 w-10 items-center justify-center rounded-full bg-red-600 text-white shadow-lg shadow-black/20">
            <i class="bi bi-lightning-charge-fill"></i>
        </span>
    </div>
</section>