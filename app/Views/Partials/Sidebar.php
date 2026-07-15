<!-- CONTEXT -->
<?php /** @var \League\Plates\Template\Template $this */ ?>

<!-- PARAMETERS -->
<?php
/** @var string $brandName  */
/** @var ?string $activeNav  */
/** @var ?array<string, array<\App\Support\DTOs\UI\MenuItemDTO>> $navMenus  */
/** @var ?\App\Support\DTOs\AuthDTO $auth  */
?>

<!-- DEFAULT VALUE -->
<?php
$activeNav ??= "";
$navMenus ??= [];
$auth ??= null;
?>

<!-- CONTENT -->
<aside id="sidebar" class="fixed inset-y-0 left-0 z-50 flex w-72 -translate-x-full flex-col border-r border-slate-200 bg-white shadow-2xl transition-transform duration-200 xl:translate-x-0 xl:shadow-none">
    <div class="flex h-20 items-center justify-between border-b border-slate-100 px-5">
        <!-- Marka -->
        <?= $this->insert("Partials/Brand", [
            "brandName" => $brandName,
        ]) ?>
        <!-- Menüyü Kapat -->
        <button type="button" class="flex h-9 w-9 items-center justify-center rounded-lg text-slate-500 hover:bg-slate-100 xl:hidden" onclick="document.getElementById('sidebar').classList.add('-translate-x-full')" aria-label="Menüyü kapat">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>

    <nav class="flex-1 space-y-5 overflow-y-auto px-3 py-5">
        <?php foreach ($navMenus as $menuName => $navItems): ?>
            <section>
                <!-- Menü İsmi -->
                <?php if ($menuName !== ''): ?>
                    <h2 class="mb-2 px-3 text-xs font-bold uppercase tracking-widest text-slate-400">
                        <?= $this->escape($menuName) ?>
                    </h2>
                <?php endif ?>

                <!-- Menü İtemleri -->
                <div class="space-y-1">
                    <?php foreach ($navItems as $item): ?>
                        <!-- Aktif Olan Menü Mü? -->
                        <?php $isActive = $activeNav === $item->href; ?>
                        <!-- Menüyü Yaz -->
                        <a href="<?= $this->escape($item->href) ?>" title="<?= $this->escape($item->text) ?>" class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition <?= $isActive ? 'bg-red-50 text-red-700' : 'text-slate-700 hover:bg-slate-100 hover:text-slate-950' ?>">
                            <!-- Menü İkon -->
                            <span class="flex h-8 w-8 items-center justify-center rounded-lg <?= $isActive ? 'bg-red-600 text-white shadow-sm' : 'bg-slate-100 text-slate-500 group-hover:bg-white group-hover:text-red-600' ?>">
                                <i class="bi <?= $this->escape($item->icon) ?> text-base"></i>
                            </span>
                            <!-- Menü Başlık -->
                            <span class="truncate">
                                <?= $this->escape($item->text) ?>
                            </span>
                        </a>
                    <?php endforeach ?>
                </div>
            </section>
        <?php endforeach ?>
    </nav>

    <!-- Hesap Menüsü (Mobil) -->
    <div class="border-t border-slate-100 p-4 xl:hidden">
        <div class="flex items-center gap-2">
            <?= $this->insert("Partials/AccountMenu", [
                "auth" => $auth,
            ]) ?>
        </div>
    </div>
</aside>