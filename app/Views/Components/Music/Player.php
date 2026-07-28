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
<section
    data-music-player

    data-start-time="<?= $startTime ?>"

    <?php if ($hasNextUrl): ?>
    data-next-url="<?= $this->escape($nextUrl) ?>"
    <?php endif; ?>

    class="overflow-hidden rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
    <audio data-audio preload="metadata" onloadedmetadata="setupPlayer(this.parentElement)">
        <source src="<?= $this->escape($source) ?>">
        Tarayıcınız ses oynatmayı desteklemiyor.
    </audio>

    <!-- Müzik Resmi -->
    <div class="mx-auto aspect-square w-full max-w-72 overflow-hidden rounded-2xl bg-slate-100 shadow-md">
        <img src="<?= $this->escape($poster) ?>" alt="Müzik resmi" class="h-full w-full object-cover">
    </div>

    <!-- İlerleme Çubuğu -->
    <div class="mt-6">
        <!-- Çubuk -->
        <input data-progress type="range" min="0" max="0" value="0" step="0.1" class="h-1.5 w-full cursor-pointer accent-red-600">
        <!-- Süre Bilgileri -->
        <div class="mt-2 flex justify-between text-xs tabular-nums text-slate-500">
            <span data-current-time>00:00</span>
            <span data-duration>00:00</span>
        </div>
    </div>

    <!-- Kontroller -->
    <div class="mt-5 flex items-center justify-center gap-4">
        <!-- Geri Sar -->
        <button data-backward title="10 saniye geri" class="flex h-10 w-10 items-center justify-center rounded-full text-lg text-slate-500 transition hover:bg-slate-100 hover:text-slate-950">
            <i class="bi bi-arrow-counterclockwise" aria-hidden="true"></i>
        </button>
        <!-- Oynat/Duraklat -->
        <button data-play title="Oynat" class="flex h-14 w-14 items-center justify-center rounded-full bg-red-600 text-2xl text-white transition hover:bg-red-700 active:scale-95">
            <i data-play-icon class="bi bi-play-fill"></i>
            <i data-pause-icon class="bi bi-pause-fill hidden"></i>
        </button>
        <!-- İleri Al -->
        <button data-forward title="10 saniye ileri" class="flex h-10 w-10 items-center justify-center rounded-full text-lg text-slate-500 transition hover:bg-slate-100 hover:text-slate-950">
            <i class="bi bi-arrow-clockwise" aria-hidden="true"></i>
        </button>
    </div>
</section>

<!-- SCRIPT -->
<script>
    function setupPlayer(player) {
        // Değişkenler
        const audio = player.querySelector("[data-audio]");
        const progress = player.querySelector("[data-progress]");
        const currentTime = player.querySelector("[data-current-time]");
        const duration = player.querySelector("[data-duration]");
        const backwardButton = player.querySelector("[data-backward]");
        const forwardButton = player.querySelector("[data-forward]");
        const playButton = player.querySelector("[data-play]");
        const playIcon = player.querySelector("[data-play-icon]");
        const pauseIcon = player.querySelector("[data-pause-icon]");

        // Durum Güncellemesi
        const updateState = () => {
            const isPlaying = !audio.paused;
            // Oynat Butonunu Güncelle
            playIcon.classList.toggle("hidden", isPlaying);
            pauseIcon.classList.toggle("hidden", !isPlaying);
            playButton.title = isPlaying ? "Duraklat" : "Oynat";
            // Süreyi Güncelle
            progress.value = audio.currentTime;
            currentTime.textContent = formatTime(audio.currentTime);
        };

        // Zaman Formatlama Fonksiyonu
        const formatTime = (sec) => {
            let result = "";

            const hours = Math.floor(sec / 3600);
            const minutes = Math.floor((sec % 3600) / 60);
            const seconds = Math.floor(sec % 60);

            if (hours > 0) {
                result += hours.toString() + ":";
            }
            result += minutes.toString().padStart(2, "0") + ":";
            result += seconds.toString().padStart(2, "0");
            return result;
        };

        // Gerekli Değişkenleri Yapılandır
        progress.max = audio.duration;
        audio.currentTime = Math.min(audio.duration, player.dataset.startTime);
        duration.textContent = formatTime(audio.duration);

        // İlerleme Çubuğu Değiştirildiğinde
        progress.addEventListener("input", () => {
            audio.currentTime = Number(progress.value);
        });

        // Oynat/Duraklat Butonuna Tıklandığında
        playButton.addEventListener("click", () => {
            if (audio.paused) {
                audio.play();
            } else {
                audio.pause();
            }
        });

        // Geri Sar Butonuna Tıklandığında
        backwardButton.addEventListener("click", () => {
            audio.currentTime = Math.max(0, audio.currentTime - 10);
        });

        // İleri Sar Butonuna Tıklandığında
        forwardButton.addEventListener("click", () => {
            audio.currentTime = Math.min(audio.duration, audio.currentTime + 10);
        });

        // Durum Güncellemesi Gereken Olaylar
        audio.addEventListener("timeupdate", updateState);
        audio.addEventListener("play", updateState);
        audio.addEventListener("pause", updateState);
        audio.addEventListener("ended", updateState);

        // Sonraki Url Varsa Bittiğinde Otomatik Oynat
        audio.addEventListener("ended", () => {
            if (player.dataset.nextUrl) {
                window.location.href = player.dataset.nextUrl;
            }
        });
    }
</script>