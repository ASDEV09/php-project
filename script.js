document.addEventListener('DOMContentLoaded', function () {
    const audio = new Audio();
    let isPlaying = false;
    let isShuffled = false;
    let shuffledIndexes = [];
    let currentSongIndex = 0;

    const playButtons = document.querySelectorAll('.play-button');
    const playPauseButton = document.getElementById('playPauseButton');
    const progressBar = document.querySelector('.progress-bar');
    const progress = document.querySelector('.progress');
    const prevButton = document.getElementById('prevButton');
    const nextButton = document.getElementById('nextButton');
    const shuffleButton = document.getElementById('shuffleButton');
    const undoButton = document.getElementById('undoButton');
    const volumeSlider = document.getElementById('volumeSlider');
    const currentTimeDisplay = document.getElementById('currentTime');
    const durationDisplay = document.getElementById('duration');
    const downloadButton = document.getElementById('downloadCurrentSong');

    function playSong(filePath, artistName, songTitle, clickedButton) {
        audio.src = filePath;
        audio.play();
        updateNowPlayingText(artistName, songTitle);
        updateButtonStates(clickedButton);
        updateDownloadLink(filePath);
        currentSongIndex = Array.from(playButtons).indexOf(clickedButton);
        isPlaying = true;
    }

    function pauseSong(clickedButton) {
        audio.pause();
        updateButtonStates(clickedButton);
        isPlaying = false;

    }

    function updateNowPlayingText(artistName, songTitle) {
        document.getElementById('nowPlaying').innerText = `Now Playing: ${artistName} - ${songTitle}`;
    }

    function updateButtonStates(clickedButton) {
        playButtons.forEach(function (button) {
            if (button !== clickedButton) {
                button.innerText = 'Play';
            } else {
                if (audio.paused) {
                    button.innerText = 'Play';
                    document.getElementById('playPauseButton').style.color = 'white';
                    playPauseButton.innerHTML = '<i class="fas fa-play fa-lg"></i>';
                } else {
                    button.innerText = 'Pause';
                    document.getElementById('playPauseButton').style.color = 'white';
                    playPauseButton.innerHTML = '<i class="fas fa-pause fa-lg"></i>';
                }
            }
        });
    }


    function updateDownloadLink(filePath) {
        downloadButton.href = filePath;
    }

    playButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            var filePath = this.getAttribute('data-file-path');
            var artistName = this.getAttribute('data-artist');
            var songTitle = this.getAttribute('data-song');
            if (audio.src.includes(filePath)) {
                if (audio.paused) {
                    audio.play();
                    updateNowPlayingText(artistName, songTitle);
                    updateButtonStates(button);
                    currentSongIndex = Array.from(playButtons).indexOf(button);
                    isPlaying = true;
                } else {
                    audio.pause();
                    updateButtonStates(button);
                    isPlaying = false;
                }
            } else {
                playSong(filePath, artistName, songTitle, button);
            }
        });
    });

    playPauseButton.addEventListener('click', function () {
        if (audio.src) {
            if (audio.paused) {
                audio.play();
                document.getElementById('playPauseButton').style.color = 'white';
                playPauseButton.innerHTML = '<i class="fas fa-pause fa-lg"></i>';

                isPlaying = true;
            } else {
                audio.pause();
                isPlaying = false;
                document.getElementById('playPauseButton').style.color = 'white';

                playPauseButton.innerHTML = '<i class="fas fa-play fa-lg"></i>';

            }
        }
    });

    prevButton.addEventListener('click', function () {
        if (isShuffled) {
            currentSongIndex = shuffledIndexes[currentSongIndex];
        } else {
            currentSongIndex = (currentSongIndex - 1 + playButtons.length) % playButtons.length;
        }
        const button = playButtons[currentSongIndex];
        const filePath = button.getAttribute('data-file-path');
        const artistName = button.getAttribute('data-artist');
        const songTitle = button.getAttribute('data-song');
        playSong(filePath, artistName, songTitle, button);
    });

    nextButton.addEventListener('click', function () {
        if (isShuffled) {
            currentSongIndex = shuffledIndexes[currentSongIndex];
        } else {
            currentSongIndex = (currentSongIndex + 1) % playButtons.length;
        }
        const button = playButtons[currentSongIndex];
        const filePath = button.getAttribute('data-file-path');
        const artistName = button.getAttribute('data-artist');
        const songTitle = button.getAttribute('data-song');
        playSong(filePath, artistName, songTitle, button);
    });

    shuffleButton.addEventListener('click', function () {
        isShuffled = !isShuffled;
        if (isShuffled) {
            shuffledIndexes = shuffleArray(playButtons.length);
            shuffleButton.style.color = '#4285F4'; // Change color to indicate shuffle mode
        } else {
            shuffleButton.style.color = '#fff'; // Reset color
        }
    });

    function shuffleArray(length) {
        const indexes = Array.from(Array(length).keys());
        for (let i = length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [indexes[i], indexes[j]] = [indexes[j], indexes[i]];
        }
        return indexes;
    }

    function updateTimeDisplay() {
        const currentTime = formatTime(audio.currentTime);
        const duration = formatTime(audio.duration);
        currentTimeDisplay.textContent = currentTime;
        durationDisplay.textContent = duration;
    }

    function updateProgress() {
        const progressPercent = (audio.currentTime / audio.duration) * 100;
        progress.style.width = `${progressPercent}%`;
    }

    function formatTime(seconds) {
        const min = Math.floor(seconds / 60);
        const sec = Math.floor(seconds % 60);
        return `${min}:${sec < 10 ? '0' : ''}${sec}`;
    }

    audio.addEventListener('timeupdate', function () {
        updateProgress();
        updateTimeDisplay();
    });

    audio.addEventListener('ended', function () {
        isPlaying = false;
        if (isShuffled) {
            currentSongIndex = shuffledIndexes[currentSongIndex];
        } else {
            currentSongIndex = (currentSongIndex + 1) % playButtons.length;
        }
        const button = playButtons[currentSongIndex];
        const filePath = button.getAttribute('data-file-path');
        const artistName = button.getAttribute('data-artist');
        const songTitle = button.getAttribute('data-song');
        playSong(filePath, artistName, songTitle, button);
    });

    volumeSlider.addEventListener('input', function () {
        const volume = this.value / 100;
        audio.volume = volume;
    });

    undoButton.addEventListener('click', function () {
        audio.currentTime = 0;
    });

    progressBar.addEventListener('click', function (event) {
        const progressBarWidth = progressBar.clientWidth;
        const clickPositionX = event.offsetX;
        const newTime = (clickPositionX / progressBarWidth) * audio.duration;
        audio.currentTime = newTime;
    });

    downloadButton.addEventListener('click', function (event) {
        if (!isPlaying) {
            event.preventDefault();
            alert('No song is currently playing. Please select a song to play before downloading.');
        }
    });
});
