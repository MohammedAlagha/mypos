@extends('layouts.dashboard.app')

@section('content')

<div class="pageheader">
    <h2><i class="fa fa-home"></i> @lang('site.dashboard') <span>Subtitle goes here...</span></h2>
    <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
            <li><a href="index.html">Bracket</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </div>
</div>

<div class="contentpanel">
    <div class="contentpanel">

        <div class="row">

            <div class="col-sm-6 col-md-3">
                <div class="panel panel-success panel-stat">
                    <div class="panel-heading">

                        <div class="stat">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="glyphicon glyphicon-inbox"></i>
                                </div>
                                <div class="col-xs-8">
                                    <small class="stat-label">@lang('site.products')</small>
                                    <h1>{{$products_count}}</h1>
                                </div>
                            </div><!-- row -->

                            <div class="mb15"></div>

                            <div class="row">
                                <div class="col-xs-6">
                                    <small class="stat-label"></small>
                                    <h4></h4>
                                </div>

                                <div class="col-xs-6">
                                    <small class="stat-label"></small>
                                    <h4></h4>
                                </div>
                            </div><!-- row -->
                        </div><!-- stat -->

                    </div><!-- panel-heading -->
                </div><!-- panel -->
            </div><!-- col-sm-6 -->

            <div class="col-sm-6 col-md-3">
                <div class="panel panel-danger panel-stat">
                    <div class="panel-heading">

                        <div class="stat">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="glyphicon glyphicon-th-large"></i>
                                </div>
                                <div class="col-xs-8">
                                    <small class="stat-label">@lang('site.categories')</small>
                                    <h1>{{$categories_count}}</h1>
                                </div>
                            </div><!-- row -->
                            <div class="mb15"></div>

                            <div class="row">
                                <div class="col-xs-6">
                                    <small class="stat-label"></small>
                                    <h4></h4>
                                </div>

                                <div class="col-xs-6">
                                    <small class="stat-label"></small>
                                    <h4></h4>
                                </div>
                            </div><!-- row -->
                        </div><!-- stat -->

                    </div><!-- panel-heading -->
                </div><!-- panel -->
            </div><!-- col-sm-6 -->

            <div class="col-sm-6 col-md-3">
                <div class="panel panel-primary panel-stat">
                    <div class="panel-heading">

                        <div class="stat">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="col-xs-8">
                                    <small class="stat-label">@lang('site.clients')</small>
                                    <h1>{{$clients_count}}</h1>
                                </div>
                            </div><!-- row -->
                            <div class="mb15"></div>

                            <div class="row">
                                <div class="col-xs-6">
                                    <small class="stat-label"></small>
                                    <h4></h4>
                                </div>

                                <div class="col-xs-6">
                                    <small class="stat-label"></small>
                                    <h4></h4>
                                </div>
                            </div><!-- row -->
                        </div><!-- stat -->

                    </div><!-- panel-heading -->
                </div><!-- panel -->
            </div><!-- col-sm-6 -->

            <div class="col-sm-6 col-md-3">
                <div class="panel panel-dark panel-stat">
                    <div class="panel-heading">

                        <div class="stat">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-tasks"></i>
                                </div>
                                <div class="col-xs-8">
                                    <small class="stat-label">@lang('site.orders')</small>
                                    <h1>{{$orders_count}}</h1>
                                </div>
                            </div><!-- row -->
                            <div class="mb15"></div>

                            <div class="row">
                                <div class="col-xs-6">
                                    <small class="stat-label"></small>
                                    <h4></h4>
                                </div>

                                <div class="col-xs-6">
                                    <small class="stat-label"></small>
                                    <h4></h4>
                                </div>
                            </div><!-- row -->
                        </div><!-- stat -->

                    </div><!-- panel-heading -->
                </div><!-- panel -->
            </div><!-- col-sm-6 -->
        </div><!-- row -->

        <div class="row">
            <div class="col-sm-8 col-md-9">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-8">
                                <h5 class="subtitle mb5">Network Performance</h5>
                                <p class="mb15">Duis autem vel eum iriure dolor in hendrerit in vulputate...</p>
                                <div id="basicflot" style="width: 100%; height: 300px; margin-bottom: 20px"></div>
                            </div><!-- col-sm-8 -->
                            <div class="col-sm-4">
                                <h5 class="subtitle mb5">Server Status</h5>
                                <p class="mb15">Summary of the status of your server.</p>

                                <span class="sublabel">CPU Usage (40.05 - 32 cpus)</span>
                                <div class="progress progress-sm">
                                    <div style="width: 40%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40"
                                        role="progressbar" class="progress-bar progress-bar-primary"></div>
                                </div><!-- progress -->

                                <span class="sublabel">Memory Usage (32.2%)</span>
                                <div class="progress progress-sm">
                                    <div style="width: 32%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40"
                                        role="progressbar" class="progress-bar progress-bar-success"></div>
                                </div><!-- progress -->

                                <span class="sublabel">Disk Usage (82.2%)</span>
                                <div class="progress progress-sm">
                                    <div style="width: 82%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40"
                                        role="progressbar" class="progress-bar progress-bar-danger"></div>
                                </div><!-- progress -->

                                <span class="sublabel">Databases (63/100)</span>
                                <div class="progress progress-sm">
                                    <div style="width: 63%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40"
                                        role="progressbar" class="progress-bar progress-bar-warning"></div>
                                </div><!-- progress -->

                                <span class="sublabel">Domains (2/10)</span>
                                <div class="progress progress-sm">
                                    <div style="width: 20%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40"
                                        role="progressbar" class="progress-bar progress-bar-success"></div>
                                </div><!-- progress -->

                                <span class="sublabel">Email Account (13/50)</span>
                                <div class="progress progress-sm">
                                    <div style="width: 26%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40"
                                        role="progressbar" class="progress-bar progress-bar-success"></div>
                                </div><!-- progress -->


                            </div><!-- col-sm-4 -->
                        </div><!-- row -->
                    </div><!-- panel-body -->
                </div><!-- panel -->
            </div><!-- col-sm-9 -->

            <div class="col-sm-4 col-md-3">

                <div class="panel panel-default">
                    <div class="panel-body">
                        <h5 class="subtitle mb5">Most Browser Used</h5>
                        <p class="mb15">Duis autem vel eum iriure dolor in hendrerit in vulputate...</p>
                        <div id="donut-chart2" class="ex-donut-chart"></div>
                    </div><!-- panel-body -->
                </div><!-- panel -->

            </div><!-- col-sm-3 -->

        </div><!-- row -->

            </div><!-- col-sm-7 -->

            <div class="col-sm-5">

                <div class="panel panel-success">
                    <div class="panel-heading padding5">
                        <div id="line-chart" class="ex-line-chart"></div>
                    </div>
                    <div class="panel-body">
                        <div class="tinystat pull-left">
                            <div id="sparkline" class="chart mt5"></div>
                            <div class="datainfo">
                                <span class="text-muted">Average Sales</span>
                                <h4>$630,201</h4>
                            </div>
                        </div><!-- tinystat -->
                        <div class="tinystat pull-right">
                            <div id="sparkline2" class="chart mt5"></div>
                            <div class="datainfo">
                                <span class="text-muted">Total Sales</span>
                                <h4>$139,201</h4>
                            </div>
                        </div><!-- tinystat -->
                    </div>
                </div><!-- panel -->

            </div><!-- col-sm-6 -->
        </div><!-- row -->


    </div><!-- contentpanel -->




</div><!-- contentpanel -->

@endsection
