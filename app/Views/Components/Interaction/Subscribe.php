<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var string $subscribed */
/** @var string $channelUrl */
/** @var \App\Support\DTOs\Channel\SubscriptionDTO $subscription */
?>

<!-- CONSTANTS -->
<?php
$title = $subscription->type->title();
$text = $subscription->title ?? $subscription->type->text();
$icon = $subscription->type->icon();
$disabled = $subscription->type->disabled();
$url = $disabled ? "" : ($subscribed ? $channelUrl . "/unsubscribe" : $channelUrl . "/subscribe");
$class = $subscribed ? "bg-slate-100 text-slate-700 hover:bg-slate-200" : "bg-red-500 text-white hover:-translate-y-0.5 hover:bg-red-600 hover:shadow-md";
?>

<!-- LAYOUT -->
<?= $this->layout("Components/Interaction/Button", [
    "url" => $url,
    "title" => $title,
    "class" => "inline-flex min-h-10 shrink-0 items-center justify-center gap-2 rounded-xl px-4 py-2.5 text-sm font-semibold shadow-sm transition focus:outline-none focus:ring-4 focus:ring-red-100 $class",
    "grouped" => false,
    "disabled" => $disabled,
]) ?>

<!-- CONTENT -->
<i class="bi <?= $this->escape($icon) ?>"></i>
<span>
    <?= $this->escape($text) ?>
</span>