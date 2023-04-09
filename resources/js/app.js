/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import "./bootstrap";
import jQuery from "jquery";
window.$ = jQuery;
$(function () {
    $("#image").on("change", function () {
        const reader = new FileReader();

        reader.onload = function (ev) {
            $("#preview")
                .attr("src", ev.target.result)
                .css("width", "300px")
                .css("height", "300px")
                .css("color", "black");
        };
        reader.readAsDataURL(this.files[0]);
    });
});
$(function () {
    $("#edit-image").on("change", function () {
        const image_reader = new FileReader();

        image_reader.onload = function (ev) {
            $("#edit-preview")
                .attr("src", ev.target.result)
                .css("width", "200px")
                .css("height", "200px");
        };
        image_reader.readAsDataURL(this.files[0]);
    });
});

$(function () {
    $("#music_path").on("change", function () {
        var file = $(this).prop("files")[0];
        $(".file-name").text(file.name);
    });
});

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
    var replaytextarea = $(".replay-input-area textarea");

    replaytextarea.on("input", function () {
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
$(function () {
    $(".logout").on("click", function () {
        window.sessionStorage.clear();
    });
});
