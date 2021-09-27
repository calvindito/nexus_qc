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

function uploader(extension) {
    $('.file-input').fileinput({
        browseLabel: 'Browse',
        allowedFileExtensions: extension,
        initialCaption: 'No file selected',
        browseIcon: '<i class="icon-file-plus mr-2"></i>',
        uploadIcon: '<i class="icon-file-upload2 mr-2"></i>',
        removeIcon: '<i class="icon-cross2 font-size-base mr-2"></i>',
        layoutTemplates: {
            icon: '<i class="icon-file-check"></i>',
            modal: `
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header align-items-center">
                            <h6 class="modal-title">{heading} <small><span class="kv-zoom-title"></span></small></h6>
                            <div class="kv-zoom-actions btn-group">{toggleheader}{fullscreen}{borderless}{close}</div>
                        </div>
                        <div class="modal-body">
                            <div class="floating-buttons btn-group"></div>
                            <div class="kv-zoom-body file-zoom-content"></div> {prev} {next}
                        </div>
                    </div>
                </div>
            `
        },
        previewZoomButtonClasses: {
            toggleheader: 'btn btn-light btn-icon btn-header-toggle btn-sm',
            fullscreen: 'btn btn-light btn-icon btn-sm',
            borderless: 'btn btn-light btn-icon btn-sm',
            close: 'btn btn-light btn-icon btn-sm'
        },
        previewZoomButtonIcons: {
            prev: $('html').attr('dir') == 'rtl' ? '<i class="icon-arrow-right32"></i>' : '<i class="icon-arrow-left32"></i>',
            next: $('html').attr('dir') == 'rtl' ? '<i class="icon-arrow-left32"></i>' : '<i class="icon-arrow-right32"></i>',
            toggleheader: '<i class="icon-menu-open"></i>',
            fullscreen: '<i class="icon-screen-full"></i>',
            borderless: '<i class="icon-alignment-unalign"></i>',
            close: '<i class="icon-cross2 font-size-base"></i>'
        },
        fileActionSettings: {
            zoomClass: '',
            zoomIcon: '<i class="icon-zoomin3"></i>',
            dragClass: 'p-2',
            dragIcon: '<i class="icon-three-bars"></i>',
            removeClass: '',
            removeErrorClass: 'text-danger',
            removeIcon: '<i class="icon-bin"></i>',
            indicatorNew: '<i class="icon-file-plus text-success"></i>',
            indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success"></i>',
            indicatorError: '<i class="icon-cross2 text-danger"></i>',
            indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>'
        }
    });
}

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
