import "./bootstrap";

document.addEventListener("DOMContentLoaded", () => {
    const players = Array.from(
        document.querySelectorAll(".custom-audio-player"),
    );
    let currentActivePlayer = null;
    let isShuffleOn = false;

    // Helper to format seconds to MM:SS
    function formatTime(seconds) {
        if (isNaN(seconds)) return "0:00";
        const mins = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return `${mins}:${secs < 10 ? "0" : ""}${secs}`;
    }

    // Shuffle Array algorithm (to avoid pure index bias)
    function getShuffledPlaylist(arr, currentIdx) {
        let indices = arr.map((_, i) => i).filter((i) => i !== currentIdx);
        for (let i = indices.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [indices[i], indices[j]] = [indices[j], indices[i]];
        }
        // Always maintain the next queue properly
        return indices;
    }

    function getNextTrackIndex(currentIdx) {
        if (players.length <= 1) return 0;

        if (isShuffleOn) {
            const shuffled = getShuffledPlaylist(players, currentIdx);
            return shuffled[0]; // Grab a random track that isn't the current one
        }

        // Linear fallback
        return (currentIdx + 1) % players.length;
    }

    function playNext(currentIdx) {
        const nextIdx = getNextTrackIndex(currentIdx);
        const nextPlayerElement = players[nextIdx];
        if (nextPlayerElement) {
            const nextAudio = nextPlayerElement.querySelector(".native-audio");
            const nextPlayBtn = nextPlayerElement.querySelector(".play-btn");

            // Trigger play mechanics on the next element
            nextPlayBtn.click();

            // Scroll neatly to view if it's off-screen
            nextPlayerElement.scrollIntoView({
                behavior: "smooth",
                block: "center",
            });
        }
    }

    players.forEach((player, index) => {
        const audio = player.querySelector(".native-audio");
        const playBtn = player.querySelector(".play-btn");
        const playIcon = player.querySelector(".play-icon");
        const pauseIcon = player.querySelector(".pause-icon");
        const progressContainer = player.querySelector(".progress-container");
        const progressBar = player.querySelector(".progress-bar");
        const currentTimeEl = player.querySelector(".current-time");
        const durationEl = player.querySelector(".total-duration");
        const nextBtn = player.querySelector(".next-btn");
        const shuffleBtn = player.querySelector(".shuffle-btn");

        // Play/Pause Action
        playBtn.addEventListener("click", () => {
            if (audio.paused) {
                // Pause any other playing track first
                if (currentActivePlayer && currentActivePlayer !== audio) {
                    currentActivePlayer.pause();
                }

                audio
                    .play()
                    .catch((err) =>
                        console.log("Autoplay prevented or no file found."),
                    );
                currentActivePlayer = audio;
            } else {
                audio.pause();
            }
        });

        // Update UI state when playing
        audio.addEventListener("play", () => {
            playIcon.classList.add("hidden");
            pauseIcon.classList.remove("hidden");
            player.classList.add("playing-active");
        });

        // Update UI state when paused
        audio.addEventListener("pause", () => {
            playIcon.classList.remove("hidden");
            pauseIcon.classList.add("hidden");
            player.classList.remove("playing-active");
        });

        // Track metadata loaded (sets true duration)
        audio.addEventListener("loadedmetadata", () => {
            durationEl.textContent = formatTime(audio.duration);
        });

        // Fallback in case loadedmetadata fails (cached assets)
        if (audio.readyState >= 1) {
            durationEl.textContent = formatTime(audio.duration);
        }

        // Perfect Indicator & Progress tracker
        audio.addEventListener("timeupdate", () => {
            const progress = (audio.currentTime / audio.duration) * 100;
            progressBar.style.width = `${progress}%`;
            currentTimeEl.textContent = formatTime(audio.currentTime);
        });

        // Click to seek progress bar
        progressContainer.addEventListener("click", (e) => {
            const rect = progressContainer.getBoundingClientRect();
            const pos = (e.clientX - rect.left) / rect.width;
            audio.currentTime = pos * audio.duration;
        });

        // Condition 5 & 6: Play next on end
        audio.addEventListener("ended", () => {
            playNext(index);
        });

        // Condition 7 & 8: Manual Shuffle Trigger across all players
        shuffleBtn.addEventListener("click", () => {
            isShuffleOn = !isShuffleOn;

            // Sync all UI shuffle buttons
            players.forEach((p) => {
                const sBtn = p.querySelector(".shuffle-btn");
                if (isShuffleOn) {
                    sBtn.classList.remove("text-zinc-400");
                    sBtn.classList.add("text-emerald-400");
                } else {
                    sBtn.classList.remove("text-emerald-400");
                    sBtn.classList.add("text-zinc-400");
                }
            });
        });

        // Manual Next Button Click
        nextBtn.addEventListener("click", () => {
            audio.pause();
            audio.currentTime = 0;
            playNext(index);
        });
    });
});
