
<div class="container-fluid  dashboard-content">

        <div class="row">
            <!-- ============================================================== -->
            <!-- four widgets   -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- total views   -->
            <!-- ============================================================== -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-inline-block">
                            <h5 class="text-muted">{{ __('total_visits') }}</h5>
                            <h2 class="mb-0"> {{number_format($data['totalVisits']->count())}}</h2>
                        </div>
                        <div class="float-right icon-circle-medium  icon-box-lg  bg-info-light mt-1">
                            <i class="fa fa-eye fa-fw fa-sm text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end total views   -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- total followers   -->
            <!-- ============================================================== -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-inline-block">
                            <h5 class="text-muted">{{ __('total_register_users') }}</h5>
                            <h2 class="mb-0"> {{ number_format($data['registeredUsers']->count()) }}</h2>
                        </div>
                        <div class="float-right icon-circle-medium  icon-box-lg  bg-primary-light mt-1">
                            <i class="fa fa-user fa-fw fa-sm text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end total followers   -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- partnerships   -->
            <!-- ============================================================== -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-inline-block">
                            <h5 class="text-muted">{{ __('post_published') }}</h5>
                            <h2 class="mb-0">{{ number_format($data['publishedPost']->count()) }}</h2>
                        </div>
                        <div class="float-right icon-circle-medium  icon-box-lg  bg-success-light mt-1">
                            <i class="fa fa-rocket fa-fw fa-sm text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end partnerships   -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- total earned   -->
            <!-- ============================================================== -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-inline-block">
                            <h5 class="text-muted">{{ __('submitted_post') }}</h5>
                            <h2 class="mb-0"> {{ number_format($data['submittedPost']->count()) }}</h2>
                        </div>
                        <div class="float-right icon-circle-medium  icon-box-lg  bg-brand-light mt-1">
                            <i class="fa fa-check fa-fw fa-sm text-brand"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end total earned   -->
            <!-- ============================================================== -->
        </div>

        <!-- Visit vs Visitor  -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-8 col-lg-12 col-md-8 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">{{ __('visit_vs_visitor') }}</h5>
                    <div class="card-body">
                        <canvas id="revenue" width="400" height="150"></canvas>
                    </div>
                    <div class="card-body border-top">
                        <div class="row">
                            <div class="offset-xl-1 col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 p-3">
                                <h4> {{ __('total_unique_visitors') }}({{ date('Y') }}): {{ number_format($data['totalUniqueVisitors']) }}</h4>
                                <p>{{ __('total_unique_visits') }}({{date('Y')}}): {{ number_format($data['totalUniqueVisits']) }}</p>
                            </div>
                            <div class="offset-xl-1 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 p-3">
                                <h2 class="font-weight-normal mb-3"><span>{{number_format($data['totalVisits']->count())}}</span>                                                    </h2>
                                <div class="mb-0 mt-3 legend-item">
                                    <span class="fa-xs text-primary mr-1 legend-title "><i class="fas fa-fw fa-square-full"></i></span>
                                    <span class="legend-text">{{ __('total_visits') }}</span></div>
                            </div>
                            <div class="offset-xl-1 col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 p-3">
                                <h2 class="font-weight-normal mb-3">
                                    <span>{{number_format($data['totalVisitors'])}}</span>
                                </h2>
                                <div class="text-muted mb-0 mt-3 legend-item"> <span class="fa-xs text-secondary mr-1 legend-title"><i class="fas fa-fw fa-square-full"></i></span><span class="legend-text">{{ __('total_visitors') }}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end reveune  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- total sale  -->
            <!-- ============================================================== -->
            <div class="col-xl-4 col-lg-12 col-md-4 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">{{__('browser_usages')}}</h5>
                    <div class="card-body">
                        <canvas id="total-sale" width="220" height="155"></canvas>
                        <div class="chart-widget-list">
                            @php
                                $browserNames =  [];
                                $browserCounts =  [];
                                $browserColors =  [];
                            @endphp
                            @foreach($data['usageBrowsers'] as $key => $browser)

                            @php
                                $browserNames[] =  '"'.$key.'"';
                                $browserCounts[] =  '"'.$browser->count().'"';
                                $browserColors[] =  '"#'.substr(uniqid(),-6).'"';
                            @endphp

                            <p>
                                <span class="fa-xs text-primary mr-1 legend-title"></span><span class="legend-text"> {{$key}}</span>
                                <span class="float-right">{{ number_format($browser->count()) }}</span>
                            </p>

                            @endforeach



                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end total sale  -->
            <!-- ============================================================== -->
        </div>
        <div class="row">
            <!-- ============================================================== -->
            <!-- top selling products  -->
            <!-- ============================================================== -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="navigation-list bg-white p-20">
                                <div class="add-new-header clearfix m-b-20">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="block-header">
                                                <h2>{{ __('top_hits_post') }}</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive all-pages">
                                    <table class="table">
                                <thead class="bg-light">
                                <tr class="border-0">
                                    <th class="border-0">#</th>
                                    <th class="border-0">{{ __('post') }}</th>
                                    <th class="border-0">{{ __('language') }}</th>
                                    <th class="border-0">{{ __('post_type') }}</th>
                                    <th class="border-0">{{ __('total_visits') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data['posthits'] as $key => $value)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $value->title }} </td>
                                    <td>{{ $value->language }} </td>
                                    <td>{{ $value->post_type }} </td>

                                    <td>{{ $value->total_hit }} </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                                </div>
                                <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="block-header">
                                        <h2>{{ __('Showing') }} {{ $data['posthits']->firstItem()}} {{  __('to') }} {{ $data['posthits']->lastItem()}} {{ __('of') }} {{ $data['posthits']->total()}} {{ __('entries') }}</h2>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 text-right">
                                    <div class="table-info-pagination float-right">
                                        {!! $data['posthits']->render() !!}

                                    </div>
                                </div>
                            </div>
                            </div>
            </div>
            <!-- ============================================================== -->
            <!-- end top selling products  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- revenue locations  -->
            <!-- ============================================================== -->

            <!-- ============================================================== -->
            <!-- end revenue locations  -->
            <!-- ============================================================== -->
        </div>

    </div>

@push('include_js')
    <!-- chartjs js-->
    <script src="{{static_asset('vendor')}}/charts/charts-bundle/Chart.bundle.js"></script>
    <script src="{{static_asset('vendor')}}/charts/charts-bundle/chartjs.js"></script>

    <!-- dashboard sales js-->
    <script>
        var ctx = document.getElementById('revenue').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [{{$data['dates']}}],
                datasets: [{
                    label: '{{__('current_month_visits')}}',
                    data: [{{$data['visits']}}],
                    backgroundColor: "rgba(89, 105, 255,0.5)",
                    borderColor: "rgba(89, 105, 255,0.7)",
                    borderWidth: 2

                }, {
                    label: '{{__('current_month_visitors')}}',
                    data: [{{$data['visitors']}}],
                    backgroundColor: "rgba(255, 64, 123,0.5)",
                    borderColor: "rgba(255, 64, 123,0.7)",
                    borderWidth: 2
                }]
            },
            options: {

                legend: {
                    display: true,
                    position: 'bottom',

                    labels: {
                        fontColor: '#71748d',
                        fontFamily: 'Circular Std Book',
                        fontSize: 14,
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return '$' + value;
                            }
                        }
                    }]
                },

                scales: {
                    xAxes: [{
                        ticks: {
                            fontSize: 14,
                            fontFamily: 'Circular Std Book',
                            fontColor: '#71748d',
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            fontSize: 14,
                            fontFamily: 'Circular Std Book',
                            fontColor: '#71748d',
                        }
                    }]
                }

            }
        });

        // ==============================================================
        // Total Sale
        // ==============================================================

        @php
            $browserNames = implode(',', $browserNames);
            $browserCounts = implode(',', $browserCounts);
            $browserColors = implode(',', $browserColors);
        @endphp

        var ctx = document.getElementById("total-sale").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: [{!!$browserNames!!}],
                datasets: [{
                    backgroundColor: [{!!$browserColors!!}],
                    data: [{!!$browserCounts!!}]
                }]
            },
            options: {
                legend: {
                    display: false

                }
            }

        });


        // ==============================================================
        // Location Map
        // ==============================================================
        
    </script>
@endpush
