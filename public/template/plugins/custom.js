$(function() {
    $('body').tooltip({selector: '[data-popup="tooltip"]'});

    $('.sidebar-control').on('click', function() {
        $('#datatable_serverside').DataTable().columns.adjust().draw();
    });

    $('.select2').select2({
        dropdownParent: $('.modal')
    });

    $('.select2-tag').select2({
        dropdownParent: $('.modal'),
        tags: true,
        cache: true,
        createTag: function(params) {
            var term = $.trim(params.term);
            if(term === '') {
                return null;
            } else {
                return {
                    id: term,
                    text: term,
                    newTag: true
                }
            }
        }
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
