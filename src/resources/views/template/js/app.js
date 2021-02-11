function init_config() {
    $.ajaxSetup({
        headers: {
            'X-Csrf-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });
}

$(document).ready(function () {
    init_config();
});
