<div class="content-inner">
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-lg-inline">
            <div class="page-title d-flex">
                <h4>
                    <a href="{{ url()->previous() }}" class="text-dark"><i class="icon-arrow-left52 mr-2"></i></a>
                    <span class="font-weight-semibold">Calendar</span>
                </h4>
            </div>
        </div>
        <div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{ url('dashboard') }}" class="breadcrumb-item">Dashboard</a>
                    <a href="javascript:void(0);" class="breadcrumb-item">Working Hours</a>
                    <span class="breadcrumb-item active">Calendar</span>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="card">
            <div class="card-body">
                <div class="fullcalendar"></div>
            </div>
        </div>
    </div>

<div class="modal fade" id="modal_detail" data-backdrop="static" role="dialog">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">Schedule <span id="name"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-border-dashed">
                    <tbody>
                        <tr>
                            <th width="20%">Company</th>
                            <td>
                                <span class="font-weight-bold">:</span>
                                <span class="ml-2" id="company"></span>
                            </td>
                            <th width="20%">Departement</th>
                            <td>
                                <span class="font-weight-bold">:</span>
                                <span class="ml-2" id="departement"></span>
                            </td>
                        </tr>
                        <tr>
                            <th width="20%">Branch</th>
                            <td>
                                <span class="font-weight-bold">:</span>
                                <span class="ml-2" id="branch"></span>
                            </td>
                            <th width="20%">Section</th>
                            <td>
                                <span class="font-weight-bold">:</span>
                                <span class="ml-2" id="section"></span>
                            </td>
                        </tr>
                        <tr>
                            <th width="20%">Division</th>
                            <td>
                                <span class="font-weight-bold">:</span>
                                <span class="ml-2" id="division"></span>
                            </td>
                            <th width="20%">Line</th>
                            <td>
                                <span class="font-weight-bold">:</span>
                                <span class="ml-2" id="line"></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group"><hr></div>
                <table class="table table-bordered w-100">
                    <thead class="bg-light">
                        <tr class="text-center">
                            <th class="align-middle" rowspan="2">Day Of The Work</th>
                            <th class="align-middle" rowspan="2">Set As</th>
                            <th class="align-middle" colspan="2">Working Time</th>
                            <th class="align-middle" colspan="2">Break Time</th>
                            <th class="align-middle" rowspan="2">Total Work Hours</th>
                        </tr>
                        <tr class="text-center">
                            <th class="align-middle">Start Time</th>
                            <th class="align-middle">End Time</th>
                            <th class="align-middle">Start Time</th>
                            <th class="align-middle">End Time</th>
                        </tr>
                    </thead>
                    <tbody id="schedule_detail"></tbody>
                </table>
            </div>
            <div class="modal-footer bg-light">
                <div class="form-group">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="icon-switch"></i> Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        loadData();
    });

    function loadData() {
        $.ajax({
            url: '{{ url("working_hours/calendar/load_data") }}',
            type: 'GET',
            dataType: 'JSON',
            beforeSend: function() {
                loadingOpen('.content');
            },
            success: function(response) {
                loadingClose('.content');

                const calendar_selector = document.querySelector('.fullcalendar');
                if(calendar_selector) {
                    const calendar_selector_init = new FullCalendar.Calendar(calendar_selector, {
                        headerToolbar: {
                            left: 'prev,next today prevYear,nextYear',
                            center: 'title',
                            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                        },
                        buttonText: {
                            today: 'Today',
                            month: 'Monthly',
                            week: 'Weekly',
                            day: 'Daily',
                            list: 'List'
                        },
                        buttonIcons: {
                            prev: 'fas fa-chevron-left',
                            next: 'fas fa-chevron-right',
                            prevYear: 'fas fa-angle-double-left',
                            nextYear: 'fas fa-angle-double-right'
                        },
                        eventClick: function(data) {
                            loadingOpen('.modal-content');
                            $('#modal_detail').modal('show');
                            $('#name').html('');
                            $('#company').html('');
                            $('#branch').html('');
                            $('#division').html('');
                            $('#departement').html('');
                            $('#section').html('');
                            $('#line').html('');
                            $('#schedule_detail').html('');

                            $.getJSON('{{ url("working_hours/calendar/detail") }}', {
                                id: data.event.id
                            }, function(result) {
                                loadingClose('.modal-content');

                                $('#name').html(result.name);
                                $('#company').html(result.company);
                                $('#branch').html(result.branch);
                                $('#division').html(result.division);
                                $('#departement').html(result.departement);
                                $('#section').html(result.section);
                                $('#line').html(result.line);

                                $.each(result.schedule_detail, function(i, val) {
                                    var current = i + 1;
                                    $('#schedule_detail').append(`
                                        <tr class="` + val.class + `">
                                            <td class="align-middle text-left">Day ` + current + `</td>
                                            <td class="align-middle text-center">` + val.status + `</td>
                                            <td class="align-middle text-center">` + val.work_start_time + `</td>
                                            <td class="align-middle text-center">` + val.work_end_time + `</td>
                                            <td class="align-middle text-center">` + val.break_start_time + `</td>
                                            <td class="align-middle text-center">` + val.break_end_time + `</td>
                                            <td class="align-middle text-center">` + val.total_work_hours + `</td>
                                        </tr>
                                    `);
                                });
                            }).fail(function() {
                                $('#modal_detail').modal('hide');
                                loadingClose('.modal-content');
                                swalInit.fire({
                                    title: 'Server Error',
                                    text: 'Please contact developer',
                                    icon: 'error'
                                });
                            });
                        },
                        locale: 'en',
                        timeZone: 'Asia/Jakarta',
                        themeSystem: 'bootstrap',
                        disableDragging: true,
                        initialDate: '{{ date("Y-m-d") }}',
                        navLinks: true,
                        nowIndicator: true,
                        weekNumberCalculation: 'ISO',
                        editable: false,
                        selectable: false,
                        direction: document.dir == 'rtl' ? 'rtl' : 'ltr',
                        dayMaxEvents: true,
                        events: response
                    });

                    calendar_selector_init.render();
                    $('.sidebar-control').on('click', function() {
                        calendar_selector_init.updateSize();
                    });
                }
            },
            error: function() {
                loadingClose('.content');
                loadData();
            }
        });
    }
</script>
