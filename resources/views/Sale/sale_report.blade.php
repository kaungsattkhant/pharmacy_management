@extends('Layouts.master')
@section('content')
    <div class="content">
        {{--        <h3>StaffAuth Management</h3>--}}
        <div class="sub-content pt-4 mt-3">
            <div class="float-left">
                <div class="mb-3 ">
                    <select name="branch" class="form-control-sm show-menu-arrow ml-1 bd-bottom-mount" style="background:none;" id="branch">
                        <option selected disabled>--Choose Branch--</option>
                        @php
                            $branches=\App\Model\Branch::all();
                        @endphp
                        @foreach($branches as $branch)
                            <option value="{{$branch->id}}" @if($branch->id==1) selected @endif>{{$branch->name}}</option>
                        @endforeach
                    </select>
                    <select class="form-control-sm show-menu-arrow ml-1 bd-bottom-mount" name="month" data-style="btn-white"  style="background:none;"  id="month_filter">
                        @php
                            $months=['Jan','Feb','Mar','Apr','May','Jun','July','Aug','Sept','Oct','Nov','Dec'];
                        @endphp
                        {{--                    <option selected disabled>Month</option>--}}
                        @foreach($months as $key=>$m)
                            <option value="{{$key+1}}" @if(($key+1)== \Carbon\Carbon::now()->month) selected @endif>{{$m}}</option>
                        @endforeach
                    </select>
                    <select class="form-control-sm show-menu-arrow ml-1 bd-bottom-mount" name="year" style="background:none;"  id="year_filter">
                        @php
                            $years=['2020','2021','2022','2023','2024','2025','2026','2027'];
                        @endphp
                        <option selected disabled>Year</option>
                        @foreach($years as $key=>$y)
                            <option value="{{$y}}" @if(($y)== \Carbon\Carbon::now()->year) selected @endif>{{$y}}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-default cs-btn btn-sm" id="sale_report_filter">Filter</button>
                </div>

            </div>

        </div>
        <div class="pt-4 mt-auto">
{{--            <div class="row">--}}
                <div class="col-md-12 col-md-offset-1 bg-white mt-3 rounded">
                    <div class="panel panel-default">
                        {{--                    <div class="panel-heading"><b>Charts</b></div>--}}
                        <div class="panel-body">
                            <canvas id="canvas" height="280" width="600"></canvas>
                            <canvas id="canvas_filter" height="280" width="600"></canvas>
                        </div>
                    </div>
                </div>
{{--            </div>--}}
        </div>
    </div>
@endsection
@section('script')
    <script>

        function update_rate(chart,days,avg_sale,label) {
            chart.data.labels=days;
            chart.data.datasets[0].data = avg_sale;
            chart.data.datasets[0].label = label;
            chart.update();
        }
        $(function(){
            $('#canvas_filter').hide();
            $('#canvas').show();
            var ctx = document.getElementById("canvas").getContext('2d');
            var days=@json($days);
            var avg_sale=@json($avg_sale);
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels:days,
                    datasets: [{
                        label: 'Average Sale',
                        data: avg_sale,
                        borderWidth: 1,
                        // backgroundColor: 'rgba(0, 119, 204, 0.8)',
                        backgroundColor:'darkslategray'

                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                suggestedMin: 50,
                                suggestedMax: 100
                            }
                        }]
                    }
                }
            });
            // ****************end chart*******************
            var ctx_filter = document.getElementById("canvas_filter").getContext('2d');
            var days=@json($days);
            var avg_sale=@json($avg_sale);
            var chart_filter = new Chart(ctx_filter, {
                type: 'bar',
                data: {
                    labels:days,
                    datasets: [{
                        label: 'Average Rate',
                        data: avg_sale,
                        borderWidth: 1,
                        // backgroundColor: 'rgba(0, 119, 204, 0.8)',
                        backgroundColor:'darkslategray'
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                suggestedMin: 50,
                                suggestedMax: 100
                            }
                        }]
                    }
                }
            });
            // **************************chart_filter******************
            $('#sale_report_filter').click(function () {
                var branch=$('#branch').val();
                // if(branch!=null){
                    var month=$('#month_filter').val();
                    var year=$('#year_filter').val();
                    // var rate_type=$('#rate_type').val();
                    $.ajax({
                        url:'/sale/sale_report_filter',
                        type:'get',
                        data:{
                            branch:branch,
                            month:month,
                            year:year,
                        },
                        success:function (response) {
                            // console.log(response.avg_sale);
                            if (typeof response.avg_sale === "undefined") {
                                console.log('ab');
                            }
                            $('#canvas_filter').show();
                            $('#canvas').hide();
                            update_rate(chart_filter,response.days,response.avg_sale,response.label);
                            // console.log(response.days);
                            // console.log(response.avg_sale);
                            // console.log('success');
                        }
                    });
                // }else{
                //     alert('Choose Branch');
                // }

            });

        });
    </script>
@endsection

