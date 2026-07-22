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
<section class="overflow-hidden rounded-2xl border border-slate-900 bg-black shadow-sm">
    <div class="aspect-video bg-black">
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
    </div>
</section>