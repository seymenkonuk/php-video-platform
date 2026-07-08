<!-- PARAMETERS -->
<?php

use App\Support\DTOs\ChannelDetailsDTO;

/** @var ChannelDetailsDTO $details  */

?>

<!-- CONSTANTS -->
<?php

$hasDescription = isset($details->description) && $details->description !== "";
$description = $hasDescription ? $details->description : "Bu kanal henüz bir açıklama eklememiş.";
$descriptionClass = $hasDescription ? "" : "italic";

?>

<!-- CONTENT -->
<div class="grid gap-6 lg:grid-cols-[minmax(0,1fr)_22rem]">
    <div class="space-y-6">
        <!-- Hakkında Alanı -->
        <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
            <div class="mb-4 flex items-center gap-3">
                <!-- Hakkında İkonu -->
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-red-50 text-red-600"><i class="bi bi-info-circle"></i></span>
                <!-- Hakkında Başlığı -->
                <h2 class="text-xl font-black text-slate-950">Hakkında</h2>
            </div>
            <!-- Hakkında Metni -->
            <p class="whitespace-pre-line text-sm leading-7 text-slate-600 <?= $this->escape($descriptionClass) ?>">
                <?= $this->escape($description) ?>
            </p>
        </section>

        <!-- Sosyal Medya Hesapları Alanı -->
        <?php if (count($details->links) > 0): ?>
            <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
                <!-- Bağlantılar Başlığı -->
                <h2 class="mb-4 text-xl font-black text-slate-950">Bağlantılar</h2>
                <div class="grid gap-3 sm:grid-cols-2">
                    <!-- Bağlantılar -->
                    <?php foreach ($details->links as $link): ?>
                        <?= $this->insert("Components/Channel/SocialLink", ["link" => $link]) ?>
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
            <?= $this->insert("Components/Channel/Stat", [
                "title" => "Abone",
                "value" => $details->subscriberCount,
                "valueFormatted" => $details->subscriberCountFormatted,
            ]) ?>
            <!-- Görüntüleme Sayısı -->
            <?= $this->insert("Components/Channel/Stat", [
                "title" => "Görüntülenme",
                "value" => $details->viewCount,
                "valueFormatted" => $details->viewCountFormatted,
            ]) ?>
            <!-- Video Sayısı -->
            <?= $this->insert("Components/Channel/Stat", [
                "title" => "Video",
                "value" => $details->videoCount,
                "valueFormatted" => $details->videoCountFormatted,
            ]) ?>
            <!-- Katılma Tarihi -->
            <?= $this->insert("Components/Channel/Stat", [
                "title" => "Katılma tarihi",
                "value" => $details->joinDate,
                "valueFormatted" => $details->joinDateFormatted,
            ]) ?>
        </div>
    </aside>
</div>