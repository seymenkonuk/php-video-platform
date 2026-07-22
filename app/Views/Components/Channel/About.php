<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\DTOs\Channel\AboutDTO $about  */
?>

<!-- CONSTANTS -->
<?php
$hasDescription = isset($about->description) && $about->description !== "";
$hasLinks = count($about->links) > 0;
?>

<!-- CONTENT -->
<div class="grid gap-6 lg:grid-cols-[minmax(0,1fr)_22rem]">
    <div class="space-y-6">
        <!-- Hakkında Alanı -->
        <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
            <div class="mb-4 flex items-center gap-3">
                <!-- Hakkında İkonu -->
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-red-50 text-red-600">
                    <i class="bi bi-info-circle"></i>
                </span>
                <!-- Hakkında Başlığı -->
                <h2 class="text-xl font-black text-slate-950">Hakkında</h2>
            </div>
            <!-- Hakkında Metni -->
            <?php if ($hasDescription): ?>
                <p class="whitespace-pre-line text-sm leading-7 text-slate-600">
                    <?= $this->escape($about->description) ?>
                </p>
            <?php else: ?>
                <p class="whitespace-pre-line text-sm leading-7 text-slate-600 italic">
                    Bu kanal henüz bir açıklama eklememiş.
                </p>
            <?php endif ?>
        </section>

        <!-- Sosyal Medya Hesapları Alanı -->
        <?php if ($hasLinks): ?>
            <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
                <!-- Bağlantılar Başlığı -->
                <h2 class="mb-4 text-xl font-black text-slate-950">Bağlantılar</h2>
                <div class="grid gap-3 sm:grid-cols-2">
                    <!-- Bağlantılar -->
                    <?php foreach ($about->links as $link): ?>
                        <?= $this->insert("Components/Channel/SocialLink", (array) new \App\Support\ViewProps\Components\Channel\SocialLinkViewProp(
                            link: $link,
                        )) ?>
                    <?php endforeach ?>
                </div>
            </section>
        <?php endif ?>
    </div>

    <!-- İstatistikler Alanı -->
    <aside class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
        <!-- İstatistikler Başlığı -->
        <h2 class="mb-4 text-xl font-black text-slate-950">İstatistikler</h2>
        <div class="space-y-3">
            <!-- Abone Sayısı -->
            <?= $this->insert("Components/Channel/Stat", (array) new \App\Support\ViewProps\Components\Channel\StatViewProp(
                title: "Abone",
                value: (string)$about->subscriberCount,
                valueFormatted: $about->subscriberCountFormatted,
            )) ?>
            <!-- Görüntüleme Sayısı -->
            <?= $this->insert("Components/Channel/Stat", (array) new \App\Support\ViewProps\Components\Channel\StatViewProp(
                title: "Görüntülenme",
                value: (string)$about->viewCount,
                valueFormatted: $about->viewCountFormatted,
            )) ?>
            <!-- Video Sayısı -->
            <?= $this->insert("Components/Channel/Stat", (array) new \App\Support\ViewProps\Components\Channel\StatViewProp(
                title: "Video",
                value: (string)$about->videoCount,
                valueFormatted: $about->videoCountFormatted,
            )) ?>
            <!-- Katılma Tarihi -->
            <?= $this->insert("Components/Channel/Stat", (array) new \App\Support\ViewProps\Components\Channel\StatViewProp(
                title: "Katılma tarihi",
                value: $about->joinDate,
                valueFormatted: $about->joinDateFormatted,
            )) ?>
        </div>
    </aside>
</div>