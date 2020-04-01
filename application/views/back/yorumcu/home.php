<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
             <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
  <h1 class="h2">Dashboard</h1>      
</div>

<div class="row ap-hp-cards marbot20">

    <div class="col-md-4">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <span class="card-title">1</span> <span>Clicks</span>
                <p class="card-text">+1 Today</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-white bg-success">
            <div class="card-body">
                <span class="card-title">2</span> <span>URLs</span>
                <p class="card-text">+0 Today</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-white bg-danger">
            <div class="card-body">
                <span class="card-title">2</span> <span>Users</span>
                <p class="card-text">+0 Today</p>
            </div>
        </div>
    </div>

</div>

<div class="row marbot20">
    <!--chart-->
    <div class="col-md-12">

        <div class="card border-light ">
            <div class="card-header">Summary</div>
            <div class="card-body" style="height:400px"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                <canvas id="home-page-chart" style="display: block; width: 1464px; height: 360px;" width="1464" height="360" class="chartjs-render-monitor"></canvas>
                <div class="no_data" style="padding-top: 173px; display: none;">NO DATA AVAILABLE</div>
            </div>
        </div>

    </div>

</div>

<div class="row">
    <div class="col-lg-12 marbot20">
        <div class="card border-light ">
            <div class="card-header">
                Location Data
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 url-view-table-col" id="location_data_col">
                        <table class="table table-striped table-borderless" style="display: none;">
                            <thead>
                            <tr>
                                <th>Country</th>
                                <th>Clicks</th>
                            </tr>
                            </thead>
                            <tbody id="location_data_table_body"></tbody>
                        </table>
                        <div class="no_data" style="padding-top: 123px; display: block;">NO DATA AVAILABLE</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">

    

</script>            
