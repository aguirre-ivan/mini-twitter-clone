$(document).ready(function () {
    $('.twitter-sign-input').on('input', textareaLimit);
});

function textareaLimit() {
    var maxLength = 140;
    var currentLength = $('.twitter-sign-input').val().length;

    if (currentLength > maxLength) {
        $('.twitter-sign-input').val($('.twitter-sign-input').val().substring(0, maxLength));
    }
}