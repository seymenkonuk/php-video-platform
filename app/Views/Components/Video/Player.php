<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\DTOs\Video\DetailsDTO $video */
/** @var int $startTime */
/** @var ?string $nextVideoUrl */
?>

<!-- DEFAULT VALUE -->
<?php
$nextVideoUrl ??= "";
?>

<!-- CONTENT -->
<section class="overflow-hidden rounded-2xl border border-slate-900 bg-black shadow-sm">
    <div class="aspect-video bg-black">
        <video
            class="h-full w-full bg-black object-contain"
            poster="<?= $this->escape($video->thumbnail) ?>"
            controls
            <?php if ($startTime > 0): ?>
            onloadedmetadata="this.currentTime = <?= $startTime ?>"
            <?php endif; ?>
            <?php if ($nextVideoUrl !== ""): ?>
            onended="window.location.href = '<?= $this->escape($nextVideoUrl) ?>'"
            <?php endif; ?>>
            <source src="<?= $this->escape($video->sourceUrl) ?>">
            Tarayıcınız video oynatmayı desteklemiyor.
        </video>
    </div>
</section>