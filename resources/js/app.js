document.addEventListener("DOMContentLoaded", () => {
    const playButtons = document.querySelectorAll(".row-play-btn");
    const masterPlayer = document.getElementById("master-player");
    const audio = document.getElementById("global-audio");

    const playBtn = document.getElementById("master-play-btn");
    const playIcon = document.getElementById("m-play-icon");
    const pauseIcon = document.getElementById("m-pause-icon");

    const progressContainer = document.getElementById("m-progress-container");
    const progressBar = document.getElementById("m-progress-bar");
    const currentTimeEl = document.getElementById("m-current-time");
    const durationEl = document.getElementById("m-total-duration");

    const titleEl = document.getElementById("active-title");
    const reciterEl = document.getElementById("active-reciter");

    const prevBtn = document.getElementById("master-prev");
    const nextBtn = document.getElementById("master-next");
    const shuffleBtn = document.getElementById("master-shuffle");
    const repeatBtn = document.getElementById("master-repeat");
    const volumeSlider = document.getElementById("volume-slider");

    let currentTrackIndex = 0;
    let isShuffle = false;
    let isRepeat = false;

    // Build functional array of available tracks
    const tracks = Array.from(playButtons).map((btn) => {
        const row = btn.closest(".grid");
        return {
            src: btn.dataset.src,
            title: row.querySelector(".recitation-title").textContent.trim(),
            reciter: row.querySelector(".reciter-name").textContent.trim(),
        };
    });

    function formatTime(seconds) {
        if (isNaN(seconds) || seconds === Infinity || seconds < 0)
            return "0:00";
        const mins = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return `${mins}:${secs < 10 ? "0" : ""}${secs}`;
    }

    function loadTrack(index) {
        if (index < 0 || index >= tracks.length) return;
        currentTrackIndex = index;
        const track = tracks[index];

        audio.src = track.src;
        titleEl.textContent = track.title;
        reciterEl.textContent = track.reciter;

        // Expose the fixed bar
        masterPlayer.classList.remove("translate-y-full");

        audio
            .play()
            .catch(() => console.log("Playback delayed by browser policies."));
    }

    function getNextIndex() {
        if (isRepeat) return currentTrackIndex;
        if (isShuffle && tracks.length > 1) {
            let rand;
            do {
                rand = Math.floor(Math.random() * tracks.length);
            } while (rand === currentTrackIndex);
            return rand;
        }
        return (currentTrackIndex + 1) % tracks.length;
    }

    // Row Triggers
    playButtons.forEach((btn) => {
        btn.addEventListener("click", () => {
            const index = parseInt(btn.dataset.index);
            loadTrack(index);
        });
    });

    // Controls
    playBtn.addEventListener("click", () => {
        if (audio.paused) audio.play();
        else audio.pause();
    });

    audio.addEventListener("play", () => {
        playIcon.classList.add("hidden");
        pauseIcon.classList.remove("hidden");
    });

    audio.addEventListener("pause", () => {
        playIcon.classList.remove("hidden");
        pauseIcon.classList.add("hidden");
    });

    audio.addEventListener("timeupdate", () => {
        if (!isNaN(audio.duration) && audio.duration > 0) {
            const progress = (audio.currentTime / audio.duration) * 100;

            progressBar.style.width = `${progress}%`;
            currentTimeEl.textContent = formatTime(audio.currentTime);
            durationEl.textContent = formatTime(audio.duration);
        } else {
            currentTimeEl.textContent = formatTime(audio.currentTime);
        }
    });

    audio.addEventListener("loadeddata", () => {
        if (audio.duration) {
            durationEl.textContent = formatTime(audio.duration);
        }
    });

    audio.addEventListener("canplay", () => {
        if (audio.duration) {
            durationEl.textContent = formatTime(audio.duration);
        }
    });

    audio.addEventListener("loadedmetadata", () => {
        durationEl.textContent = formatTime(audio.duration);
    });

    progressContainer.addEventListener("click", (e) => {
        const rect = progressContainer.getBoundingClientRect();
        const pos = (e.clientX - rect.left) / rect.width;
        audio.currentTime = pos * audio.duration;
    });

    nextBtn.addEventListener("click", () => loadTrack(getNextIndex()));

    // Condition 2: Solved Previous Button
    prevBtn.addEventListener("click", () => {
        let prevIndex = currentTrackIndex - 1;
        if (prevIndex < 0) prevIndex = tracks.length - 1;
        loadTrack(prevIndex);
    });

    audio.addEventListener("ended", () => loadTrack(getNextIndex()));

    shuffleBtn.addEventListener("click", () => {
        isShuffle = !isShuffle;
        shuffleBtn.classList.toggle("text-emerald-500", isShuffle);
        shuffleBtn.classList.toggle("text-zinc-400", !isShuffle);
    });

    repeatBtn.addEventListener("click", () => {
        isRepeat = !isRepeat;
        repeatBtn.classList.toggle("text-emerald-500", isRepeat);
        repeatBtn.classList.toggle("text-zinc-400", !isRepeat);
    });

    volumeSlider.addEventListener("input", (e) => {
        audio.volume = e.target.value;
    });
});
