$(function() {
    $('.select2').select2({
        dropdownParent: $('.modal')
    });
});

var swalInit = swal.mixin({
    buttonsStyling: false,
    customClass: {
        confirmButton: 'btn btn-primary',
        cancelButton: 'btn btn-light',
        denyButton: 'btn btn-light',
        input: 'form-control'
    }
});

function notif(type, bg, text) {
    new Noty({
        modal: true,
        theme: ' alert ' + bg + ' text-white alert-styled-left p-0',
        text: text,
        type: type,
        timeout: 200
    }).show();
}

function loadingOpen(selector) {
    $(selector).waitMe({
        effect: 'ios',
        text: 'Please Wait ...',
        bg: 'rgba(255,255,255,0.7)',
        color: '#000',
        waitTime: -1,
        textPos: 'vertical'
    });
}

function loadingClose(selector) {
    $(selector).waitMe('hide');
}
