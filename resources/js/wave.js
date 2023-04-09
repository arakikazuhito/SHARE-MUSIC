import WaveSurfer from "wavesurfer.js";
import jQuery from "jquery";
window.$ = jQuery;
const session_url = "music";
const session_html = "music_item";
var session_geturl = window.sessionStorage.getItem([session_url]);
var session_gethtml = window.sessionStorage.getItem([session_html]);
let play = document.querySelector(".play");
let pause = document.querySelector(".pause");
let next = document.querySelector(".playnext");
let back = document.querySelector(".playback");
let playpause = document.querySelector(".playpause");
let duration = document.querySelector(".duration");
let current = document.querySelector(".current");
let links = document.querySelectorAll(".list-group-item");
let linksname = document.querySelector(".music-player-info");
let currentTrack = 0;

var wavesurfer = WaveSurfer.create({
    container: ".waveform",
    waveColor: "rgba(150,150,150,0.7)",
    progressColor: "black",
    barWidth: 3,
    barRadius: 3,
    height: 50,
    responsive: true,
});
play.addEventListener("click", function () {
    play.style.display = "none";
    pause.style.display = "";
    wavesurfer.playPause();
});
pause.addEventListener("click", function () {
    play.style.display = "";
    pause.style.display = "none";
    wavesurfer.playPause();
});
$(".volume").on("mouseup", function () {
    let newVolume = $(this).val();
    wavesurfer.setVolume(newVolume);
});
wavesurfer.on("finish", function () {
    play.style.display = "";
    pause.style.display = "none";
});
if (playpause != null) {
    playpause.addEventListener("click", function () {
        $(".music-player").show();
        links[currentTrack].classList.add("active");
        wavesurfer.load(links[currentTrack].href);
        linksname.innerHTML = links[currentTrack].innerHTML;
        window.sessionStorage.setItem(
            [session_url],
            [links[currentTrack].href]
        );
        window.sessionStorage.setItem(
            [session_html],
            [links[currentTrack].innerHTML]
        );
    });
    wavesurfer.on("ready", function () {
        let durationtime = wavesurfer.getDuration(links[currentTrack].href);
        let dminute = Math.floor(durationtime / 60);
        let dsecond = Math.floor(durationtime % 60);
        if (dsecond < 10) {
            dsecond = "0" + dsecond;
        }
        duration.innerText = `${dminute}:${dsecond}`;
    });
    wavesurfer.on("audioprocess", function () {
        let currentime = wavesurfer.getCurrentTime(links[currentTrack].href);
        let cminute = Math.floor(currentime / 60);
        let csecond = Math.floor(currentime % 60);
        if (csecond < 10) {
            csecond = "0" + csecond;
        }
        current.innerText = `${cminute}:${csecond}`;
    });
}
if (session_geturl != null && session_gethtml != null) {
    $(function () {
        var commentButton = $(".comment-input-area button");

        $(document).on("input", ".comment-input-area textarea", function (e) {
            e.stopPropagation();
            var inputText = $(this).val();
            if (inputText) {
                commentButton.prop("disabled", false);
                this.style.height = "auto";
                this.style.height = `${this.scrollHeight}px`;
            } else {
                commentButton.prop("disabled", true);
                this.style.height = "25px";
            }
        });
    });

    $(function () {
        var commentreplayButton = $(".replay-input-button");

        $(document).on("input", ".replay-input-area textarea", function (e) {
            e.stopPropagation();
            var replayinputText = $(this).val();
            if (replayinputText) {
                commentreplayButton.prop("disabled", false);
                this.style.height = "auto";
                this.style.height = `${this.scrollHeight}px`;
            } else {
                commentreplayButton.prop("disabled", true);
                this.style.height = "25px";
            }
        });
    });

    $(function () {
        $(document).on("click", ".replay-button", function () {
            var index = $(".replay-button").index($(this));
            var replay_button = $(".replay-button").eq(index);
            var replay_input = $(".replay-input-area").eq(index);

            replay_button.hide();
            replay_input.show();
        });
        $(document).on("click", ".replay-cancel-button", function () {
            var index = $(".replay-cancel-button").index($(this));
            var replay_button = $(".replay-button").eq(index);
            var replay_input = $(".replay-input-area").eq(index);

            replay_button.show();
            replay_input.hide();
        });
    });

    $(".music-player").show();
    wavesurfer.load(session_geturl);
    linksname.innerHTML = session_gethtml;
    wavesurfer.on("ready", function () {
        let durationtime = wavesurfer.getDuration(session_geturl);
        let dminute = Math.floor(durationtime / 60);
        let dsecond = Math.floor(durationtime % 60);
        if (dsecond < 10) {
            dsecond = "0" + dsecond;
        }
        duration.innerText = `${dminute}:${dsecond}`;
    });
    wavesurfer.on("audioprocess", function () {
        let currentime = wavesurfer.getCurrentTime(session_geturl);
        let cminute = Math.floor(currentime / 60);
        let csecond = Math.floor(currentime % 60);
        if (csecond < 10) {
            csecond = "0" + csecond;
        }
        current.innerText = `${cminute}:${csecond}`;
    });
    Array.prototype.forEach.call(links, function (link, index) {
        link.addEventListener("click", function (e) {
            e.preventDefault();

            play.style.display = "";
            pause.style.display = "none";

            var setCurrentSong = function (index) {
                links[currentTrack].classList.remove("active");
                currentTrack = index;
                links[currentTrack].classList.add("active");
                wavesurfer.load(links[currentTrack].href);
                linksname.innerHTML = links[currentTrack].innerHTML;
                window.sessionStorage.setItem(
                    [session_url],
                    [links[currentTrack].href]
                );
                window.sessionStorage.setItem(
                    [session_html],
                    [links[currentTrack].innerHTML]
                );
                $(".music-player").show();
            };
            setCurrentSong(index);

            next.addEventListener("click", function () {
                play.style.display = "";
                pause.style.display = "none";
                setCurrentSong((currentTrack + 1) % links.length);
            });

            back.addEventListener("click", function () {
                play.style.display = "";
                pause.style.display = "none";
                setCurrentSong((currentTrack + 1) % links.length);
            });

            wavesurfer.on("finish", function () {
                play.style.display = "";
                pause.style.display = "none";
                setCurrentSong((currentTrack + 1) % links.length);
            });
        });
    });
} else {
    $(function () {
        var commentButton = $(".comment-input-area button");

        $(document).on("input", ".comment-input-area textarea", function (e) {
            e.stopPropagation();
            var inputText = $(this).val();
            if (inputText) {
                commentButton.prop("disabled", false);
                this.style.height = "auto";
                this.style.height = `${this.scrollHeight}px`;
            } else {
                commentButton.prop("disabled", true);
                this.style.height = "25px";
            }
        });
    });

    $(function () {
        var commentreplayButton = $(".replay-input-button");

        $(document).on("input", ".replay-input-area textarea", function (e) {
            e.stopPropagation();
            var replayinputText = $(this).val();
            if (replayinputText) {
                commentreplayButton.prop("disabled", false);
                this.style.height = "auto";
                this.style.height = `${this.scrollHeight}px`;
            } else {
                commentreplayButton.prop("disabled", true);
                this.style.height = "25px";
            }
        });
    });

    $(function () {
        $(document).on("click", ".replay-button", function () {
            var index = $(".replay-button").index($(this));
            var replay_button = $(".replay-button").eq(index);
            var replay_input = $(".replay-input-area").eq(index);

            replay_button.hide();
            replay_input.show();
        });
        $(document).on("click", ".replay-cancel-button", function () {
            var index = $(".replay-cancel-button").index($(this));
            var replay_button = $(".replay-button").eq(index);
            var replay_input = $(".replay-input-area").eq(index);

            replay_button.show();
            replay_input.hide();
        });
    });
    Array.prototype.forEach.call(links, function (link, index) {
        link.addEventListener("click", function (e) {
            e.preventDefault();

            var setCurrentSong = function (index) {
                links[currentTrack].classList.remove("active");
                currentTrack = index;
                links[currentTrack].classList.add("active");
                wavesurfer.load(links[currentTrack].href);
                linksname.innerHTML = links[currentTrack].innerHTML;
                window.sessionStorage.setItem(
                    [session_url],
                    [links[currentTrack].href]
                );
                window.sessionStorage.setItem(
                    [session_html],
                    [links[currentTrack].innerHTML]
                );
                $(".music-player").show();
            };
            setCurrentSong(index);

            next.addEventListener("click", function () {
                play.style.display = "";
                pause.style.display = "none";
                setCurrentSong((currentTrack + 1) % links.length);
            });

            back.addEventListener("click", function () {
                play.style.display = "";
                pause.style.display = "none";
                setCurrentSong((currentTrack + 1) % links.length);
            });

            wavesurfer.on("ready", function () {
                let durationtime = wavesurfer.getDuration(
                    links[currentTrack].href
                );
                let dminute = Math.floor(durationtime / 60);
                let dsecond = Math.floor(durationtime % 60);
                duration.innerText = `${dminute}:${dsecond}`;
                if (dsecond < 10) {
                    current.innerText = `0:00`;
                    dsecond = "0" + dsecond;
                }
            });
            wavesurfer.on("audioprocess", function () {
                let currentime = wavesurfer.getCurrentTime(
                    links[currentTrack].href
                );
                let cminute = Math.floor(currentime / 60);
                let csecond = Math.floor(currentime % 60);
                if (csecond < 10) {
                    csecond = "0" + csecond;
                }
                current.innerText = `${cminute}:${csecond}`;
            });
        });
    });
}

$(".musicdetail-link").on("click", function (e) {
    e.stopPropagation();
    e.preventDefault();

    location.href = $(this).attr("data-url");
});
$(".volume-button").on("mouseover", function () {
    var volume_button = $(".volume");
    volume_button.value = 0.5;
    var volume_icon = $(".volume-button i");

    volume_button.show();

    volume_button.on("input", function () {
        let value = this.value * 100;
        this.style.background = `linear-gradient(to right, gray 0%, gray ${value}%, #fff ${value}%, white 100%)`;
        if (value === 0) {
            volume_icon.removeClass();
            volume_icon.addClass("fa-solid fa-volume-xmark");
        } else if (1 <= value && value < 50) {
            volume_icon.removeClass();
            volume_icon.addClass("fa-solid fa-volume-low");
        } else {
            volume_icon.removeClass();
            volume_icon.addClass("fa-solid fa-volume-high");
        }
    });
});
$(".volume-button").on("mouseleave", function () {
    var volume_button = $(".volume");
    volume_button.hide();
});
