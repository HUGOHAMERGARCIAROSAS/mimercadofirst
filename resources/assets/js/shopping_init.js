const mprogress = new Mprogress();

$(function () {
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    $.ajaxSetup({
        headers: {
            'x-csrf-token': token,
        }
    });
});
