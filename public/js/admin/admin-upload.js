$(document).ready(function() {
    // Upload dictionarys
    $(document).on('submit', '#form_upload', function(evt){
        $('.btn_upload').prop('disabled', true);

        var alertWaiting = '<div class="loader"></div>';
        $('.alert_waiting').replaceWith(alertWaiting);

        return true;
    });
});
