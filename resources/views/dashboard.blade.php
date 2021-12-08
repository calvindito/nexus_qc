<div class="content-inner">
    <div class="content">
        <div class="row">
            <div class="col-sm-6 col-xl-3">
                <div class="card card-body bg-primary text-white has-bg-image">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="mb-0">{{ App\Models\Division::count() }}</h3>
                            <span class="text-uppercase font-size-xs">total division</span>
                        </div>
                        <div class="ml-3 align-self-center">
                            <i class="icon-pie-chart5 icon-3x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card card-body bg-danger text-white has-bg-image">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="mb-0">{{ App\Models\Departement::count() }}</h3>
                            <span class="text-uppercase font-size-xs">total departement</span>
                        </div>
                        <div class="ml-3 align-self-center">
                            <i class="icon-tree7 icon-3x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card card-body bg-success text-white has-bg-image">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="mb-0">{{ App\Models\Rank::count() }}</h3>
                            <span class="text-uppercase font-size-xs">total rank</span>
                        </div>
                        <div class="ml-3 align-self-center">
                            <i class="icon-medal icon-3x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card card-body bg-warning text-white has-bg-image">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="mb-0">{{ App\Models\Section::count() }}</h3>
                            <span class="text-uppercase font-size-xs">total section</span>
                        </div>
                        <div class="ml-3 align-self-center">
                            <i class="icon-grid52 icon-3x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card card-body bg-info text-white has-bg-image">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="mb-0">{{ App\Models\Line::count() }}</h3>
                            <span class="text-uppercase font-size-xs">total line</span>
                        </div>
                        <div class="ml-3 align-self-center">
                            <i class="icon-stats-decline2 icon-3x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card card-body bg-purple text-white has-bg-image">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="mb-0">{{ App\Models\Brand::count() }}</h3>
                            <span class="text-uppercase font-size-xs">total brand</span>
                        </div>
                        <div class="ml-3 align-self-center">
                            <i class="icon-price-tags2 icon-3x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card card-body bg-indigo text-white has-bg-image">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="mb-0">{{ App\Models\Buyer::count() }}</h3>
                            <span class="text-uppercase font-size-xs">total buyer</span>
                        </div>
                        <div class="ml-3 align-self-center">
                            <i class="icon-user-tie icon-3x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card card-body bg-teal text-white has-bg-image">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="mb-0">{{ App\Models\User::count() }}</h3>
                            <span class="text-uppercase font-size-xs">total user</span>
                        </div>
                        <div class="ml-3 align-self-center">
                            <i class="icon-users4 icon-3x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        <h6 class="card-title">Your Activity Chart in {{ date('Y') }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <div class="chart" id="activity_chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        <h6 class="card-title">Your Last Activity</h6>
                    </div>
                    <div class="card-body">
                        <div class="list-feed">
                            @foreach($activity as $a)
                                <div class="list-feed-item border-success">
                                    <div class="text-muted font-size-sm mb-1">{{ $a->created_at->diffForHumans() }}</div>
                                    {{ $a->description }} in {{ $a->log_name }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    $(function() {
        google.charts.load('current', {
            callback: function() {
                activityChart();
                var sidebarToggle = document.querySelectorAll('.sidebar-control');
                if(sidebarToggle) {
                    sidebarToggle.forEach(function(togglers) {
                        togglers.addEventListener('click', activityChart);
                    });
                }

                var resizeColumn;
                window.addEventListener('resize', function() {
                    clearTimeout(resizeColumn);
                    resizeColumn = setTimeout(function () {
                        activityChart();
                    }, 200);
                });
            },
            packages: ['corechart']
        });
    });

    function activityChart() {
        var activity_chart = document.getElementById('activity_chart');

        var data = google.visualization.arrayToDataTable([
            ['Month', 'Total'],
            ['Jan', {{ $activity_chart['jan'] }}],
            ['Feb', {{ $activity_chart['feb'] }}],
            ['Mar', {{ $activity_chart['mar'] }}],
            ['Apr', {{ $activity_chart['apr'] }}],
            ['May', {{ $activity_chart['may'] }}],
            ['Jun', {{ $activity_chart['jun'] }}],
            ['Jul', {{ $activity_chart['jul'] }}],
            ['Aug', {{ $activity_chart['aug'] }}],
            ['Sep', {{ $activity_chart['sep'] }}],
            ['Oct', {{ $activity_chart['oct'] }}],
            ['Nov', {{ $activity_chart['nov'] }}],
            ['Dec', {{ $activity_chart['dec'] }}]
        ]);

        var options_column = {
            height: 385,
            backgroundColor: 'transparent',
            chartArea: {
                left: '5%',
                width: '95%',
                height: 350
            },
            hAxis: {
                textStyle: {
                    color: '#333'
                }
            },
            legend: {
                position: 'top',
                alignment: 'center',
                textStyle: {
                    color: '#333'
                }
            },
            series: {
                0: {
                    color: '#45748A'
                }
            }
        };

        var column = new google.visualization.ColumnChart(activity_chart);
        column.draw(data, options_column);
    }
</script>
