$(function() {
    $('#toggle-debug').click(function() {
        if ($(this).text().match(/Show/i)) {
            $(this).text('Hide debug');
        } else {
            $(this).text('Show debug');
        }

        $(this).next('div').toggle();

        return false;
    });
});