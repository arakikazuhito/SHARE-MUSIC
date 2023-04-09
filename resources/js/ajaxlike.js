import jQuery from "jquery";
window.$ = jQuery;
$(function () {
    var like = $(".like-toggle");
    var likeMusicid;

    like.on("click", function () {
        var $this = $(this);
        likeMusicid = $this.data("music-id");
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/like",
            method: "POST",
            data: {
                music_id: likeMusicid,
            },
        })
            .done(function (data) {
                $this.toggleClass("liked");
                $this.next(".like-counter").html(data.music_likes_count);
            })
            .fail(function () {
                console.log("fail");
            });
    });
});

var commentButton = $(".comment-input-area button");

$(document).on("click", ".comment-input-area button", function () {
    var comment_music_id = $(".comment-music-id").val();
    var comment_input = $(".comment-input").val();

    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "POST",
        url: "/comment",
        data: {
            music_id: comment_music_id,
            comment_input: comment_input,
        },
    })
        .done(function (data) {
            $(".comment-update").find().remove();

            var html = `
            <div class="comment-count">
                <div class="comment">
                    <div class="comment-left">
                        <img src="/storage/img/user_img/${data.comment_data.image}">
                    </div>
                    <div class="comment-right">
                        <div class="comment-body-user">
                                ${data.comment_data.name}
                            <span class="comment-body-time">
                                ${data.comment_data.created_at}
                            </span>
                        </div>
                        <div class="comment-body-usercomment">
                            ${data.comment_data.comment}
                        </div>
                        <div class="replay"></div>
                    </div>
                    <div class="replay-button">
                        <i class="fa-solid fa-reply"></i>返信する
                    </div>
                </div>
                <div class="replay-input-area" style="display:none">
                    <input type="hidden" name="music_id" class="replay-music-id" value="${data.comment_data.music_id}">
                    <input type="hidden" name="comment_id" class="replay-comment-id" value="${data.comment_data.id}">
                    <textarea type="text" name="comment" class="replay-input"></textarea>
                    <div class="replay-select-button">
                        <button class="replay-cancel-button">キャンセル</button>
                        <button class="replay-input-button">送信する</button>
                    </div>
                </div>
                <div class="commentreplay-update">

                </div>
            </div>
                    `;
            $(".comment-update").prepend(html);
            $(".comment-input").val(null);
            $(".comment-input-area textarea")[0].style.height = "25px";
            commentButton.prop("disabled", true);
        })
        .fail(function () {
            console.log("送信に失敗しました");
        });
});

$(document).on("click", ".replay-input-button", function () {
    var up_comment_count = $(".comment-count").length;
    var replay_index = $(".replay-input-button").index($(this));
    var commentreplay_music_id = $(".replay-music-id").eq(replay_index).val();
    var commentreplay_comment_id = $(".replay-comment-id")
        .eq(replay_index)
        .val();
    var commentreplay_input = $(".replay-input").eq(replay_index).val();

    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "POST",
        url: "/commentreplay",
        data: {
            music_id: commentreplay_music_id,
            comment_id: commentreplay_comment_id,
            comment_input: commentreplay_input,
        },
    })
        .done(function (data) {
            var html = `<div class="comment-replay">
                    <div class="comment-left">
                        <img src="/storage/img/user_img/${data.comment_data.image}">
                    </div>
                    <div class="comment-right">
                        <div class="comment-body-user">
                                ${data.comment_data.name}
                            <span class="comment-body-time">
                                ${data.comment_data.created_at}
                            </span>
                        </div>
                        <div class="comment-body-usercomment">
                            ${data.comment_data.comment}
                        </div>
                        <div class="replay"></div>
                    </div>
                </div>`;

            $(".commentreplay-update").eq(replay_index).append(html);
            $(".replay-input").val(null);
            $(".replay-input-area").hide();
            $(".replay-button").show();
        })
        .fail(function () {
            console.log("送信に失敗しました");
        });
});
