$(document).ready(function() {
    $('textarea.twitter-sign-input').on('input', function() {
        var maxLength = 140;
        var currentLength = $(this).val().length;
        
        if (currentLength > maxLength) {
            $(this).val($(this).val().substring(0, maxLength));
        }
        
        var charLeft = maxLength - currentLength;
        $('#charLeft').text(charLeft);
    });
});