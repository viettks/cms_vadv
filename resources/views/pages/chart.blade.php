@extends('layout.app')
@section('title','Thống kê')
@section('style')
<style>
    .mh-76{
        min-height: 76vh;
    }
    .input-date-wrap{
        width: 185px;
    }
    .modal-lg{
        min-width: 60%;
    }
    .switch-label{
        border-color: #ff182b !important;
        background-color: #ff182b !important;
    }   
</style>
@endsection
@section('content')

<div class="col-md-12">
    <div class="card mh-76">
        <div class="card-header">
            <i class="mr-2 fa fa-align-justify"></i>
            <strong class="card-title" v-if="headerText">Thống kê</strong>
        </div>
        <div class="card-body">
            <div class="table-data__tool">
            </div>
            <div class="m-b-30">
                <div class="m-b-45 mr-2 seach-box">
                    <div class="form-group mr-2">
                        <label>Tháng</label>
                        <select class="form-control" name="month" id="month">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>
                    <div class="form-group mr-2">
                        <label>Năm</label>
                        <select class="form-control" name="year" id="year">
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>
                            <option value="2029">2029</option>
                            <option value="2030">2030</option>
                        </select>
                    </div>
                    <div class="form-group mr-2">
                        <label></label>
                        <button type="button" class="btn btn-primary" id="btnSeach">Tra cứu</button>
                    </div>
                </div>
                <div class="table-responsive table--no-card m-b-30">
                    <div class="au-card-inner au-card--pad-40">
                        <h3 class="title-2 m-b-40">Doanh thu</h3>
                        <canvas id="myChart" style="max-height: 400px" width="100%"></canvas>
                    </div>
                </div>
            </div>
            <!-- END USER DATA-->
        </div>
    </div>
</div>
@section('modal')

@endsection

@endsection
@section('extend_script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var chart ;

    $(document).ready(function(){

        init();

        $("#btnSeach").click(function(){
            runChart();
        });
    });

    function init() {
        var today = new Date();
        var firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
        $("#month").val(today.getMonth()+1);
        $("#year").val(today.getFullYear());
        runChart();
    }

    function runChart() {
        $.ajax({
            type: "GET",
            url: "{{url('/api/chart')}}",
            data: {
                'year': $("#year").val(),
                'month': $("#month").val(),
            },
            dataType: "json",
            success: function(data) {
                var dataSet = data.data;
                if(dataSet.length > 0){

                    var labels = [];
                    var data1 = [];
                    var data2 = [];

                    $(dataSet).each(function(index,item){
                        labels.push(item.Date);
                        data1.push(item.amount_get);
                        data2.push(item.amount_pay);
                    });

                    if(!chart){
                        var ctx = document.getElementById('myChart').getContext('2d');
                        chart = new Chart(ctx, {
                        // The type of chart we want to create
                            type: 'bar',

                        // The data for our dataset
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: "Thu",
                                    backgroundColor: 'rgb(0,128,0)',
                                    borderColor: 'rgb(0,128,0)',
                                    data: data1,
                                },
                                {
                                    label: "Chi",
                                    backgroundColor: 'rgb(255, 99, 132)',
                                    borderColor: 'rgb(255, 99, 132)',
                                    data: data2,
                                }]
                            },

                        // Configuration options go here
                        options: {  
                            responsive: true,
                            maintainAspectRatio: false
                        }
                        });
                    }else{
                        chart.data.labels = labels;
                        chart.data.datasets[0].data = data1;
                        chart.data.datasets[1].data = data2;
                        chart.update();
                    }
                }
            },
            error: function(xhr) {
                alert('Đã xảy ra lỗi!')
            },
        });
    }
</script>
@endsection