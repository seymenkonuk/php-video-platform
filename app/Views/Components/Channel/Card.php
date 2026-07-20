<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var \App\Support\DTOs\Channel\CardDTO $channel  */
?>

<!-- LAYOUT -->
<?= $this->layout("Components/Common/Card") ?>

<!-- CONTENT -->
<div class="flex flex-1 flex-col items-center p-6 text-center">
    <a href="<?= $this->escape($channel->url) ?>" class="relative">
        <!-- Kanal Resmi -->
        <img src="<?= $this->escape($channel->avatar) ?>" alt="<?= $this->escape($channel->title) ?>" loading="lazy" class="h-24 w-24 rounded-full border-4 border-white object-cover shadow-lg ring-1 ring-slate-200">
        <!-- Sağ Altındaki İkon -->
        <span class="absolute bottom-1 right-1 flex h-7 w-7 items-center justify-center rounded-full bg-red-600 text-xs text-white ring-4 ring-white">
            <i class="bi bi-play-fill"></i>
        </span>
    </a>
    <!-- Kanal Başlığı -->
    <a href="<?= $this->escape($channel->url) ?>" title="<?= $this->escape($channel->title) ?>" class="mt-4 max-w-full truncate text-lg font-black text-slate-950 transition hover:text-red-600">
        <?= $this->escape($channel->title) ?>
    </a>
    <!-- Kanal Bilgileri -->
    <p title="<?= $channel->subscriberCount ?> abone · <?= $channel->videoCount ?> video" class="mt-1 text-sm text-slate-500">
        <?= $this->escape($channel->subscriberCountFormatted) ?> abone · <?= $this->escape($channel->videoCountFormatted) ?> video
    </p>
    <!-- Kanal Aksiyon Butonları  -->
    <!-- Kanalı Görüntüle, Abone Ol / Abonelikten Çık vb. -->
    <div class="mt-5 flex w-full flex-col gap-2 sm:flex-row [&>a]:min-w-0 [&>a]:flex-1 [&>span]:min-w-0 [&>span]:flex-1 [&>span>button]:w-full">
        <!-- Abone Ol -->
        <?= $this->insert("Components/Interaction/Subscribe", [
            "subscribed" => $channel->subscription->type === \App\Domain\Enums\SubscribeType::NORMAL,
            "channelUrl" => $channel->url,
            "subscription" => $channel->subscription,
        ]) ?>
        <!-- Kanalı Görüntüle -->
        <?= $this->insert("Components/Form/LinkButton", [
            "href" => $channel->url,
            "icon" => "bi-arrow-right",
            "text" => "Kanalı Aç",
            "color" => "bg-slate-100",
            "hoverColor" => "bg-slate-200",
            "textColor" => "text-slate-800",
        ]) ?>
    </div>
</div>