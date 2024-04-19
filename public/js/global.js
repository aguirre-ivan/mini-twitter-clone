$(document).ready(function () {
    $('.add-tweet-form .twitter-input').on('input', textareaLimit);
});

function textareaLimit() {
    var maxLength = 140;
    var currentLength = $('.add-tweet-form .twitter-input').val().length;

    if (currentLength > maxLength) {
        $('.add-tweet-form .twitter-input').val($('.add-tweet-form .twitter-input').val().substring(0, maxLength));
    }
}