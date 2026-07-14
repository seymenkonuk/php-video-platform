<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var ?\App\Support\DTOs\AuthDTO $auth  */
?>

<!-- DEFAULT VALUE -->
<?php
$auth ??= null;
?>

<!-- CONTENT -->
<?php if ($auth === null): ?>
    <!-- Çıkış Yap Butonu -->
    <?= $this->insert("Components/Form/LinkButton", [
        "href" => "/login",
        "icon" => "bi-person",
        "text" => "Giriş Yap",
        "color" => "bg-slate-900",
        "hoverColor" => "hover:bg-red-600",
        "textColor" => "text-white",
    ]); ?>
<?php else: ?>
    <!-- Kanal Bilgileri -->
    <a href="<?= $this->escape($auth->channel->url) ?>" title="<?= $this->escape($auth->channel->title) ?>" class="flex min-w-0 items-center gap-2 rounded-xl px-2 py-1.5 text-slate-700 transition hover:bg-slate-100 hover:text-red-600">
        <!-- Kanal Resmi -->
        <span class="flex h-9 w-9 shrink-0 items-center justify-center overflow-hidden rounded-full bg-slate-100">
            <img
                src="<?= $this->escape($auth->channel->avatar) ?>"
                alt="<?= $this->escape($auth->channel->title) ?>"
                class="h-full w-full object-cover">
        </span>

        <!-- Kanal İsmi -->
        <span class="hidden max-w-[16rem] truncate text-sm font-semibold 2xl:block">
            <?= $this->escape($auth->channel->title) ?>
        </span>
    </a>
    <!-- Çıkış Yap -->
    <?= $this->insert("Forms/Auth/Logout") ?>
<?php endif ?>