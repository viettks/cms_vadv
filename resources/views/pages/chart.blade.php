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
                    <div class="au-card-inner" style="max-width: 1000px;">
                        <h3 class="title-2 m-b-40">Bar chart</h3>
                        <canvas id="myChart"></canvas>
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


    $(document).ready(function(){
        init();

        $("#btnSeach").click(function(){

        });

       const labels = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        ];
        
        const data = {
        labels: labels,
        datasets: [{
        label: 'My First dataset',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: [0, 10, 5, 2, 20, 30, 45],
        }]
        };
        
        const config = {
        type: 'line',
        data: data,
        options: {}
        };
    });

    function init() {
        var today = new Date();
        var firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
        $("#month").val(today.getMonth()+1);
        $("#year").val(today.getFullYear());
        run();
    }

    function run() {
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
        // The type of chart we want to create
            type: 'bar',

        // The data for our dataset
            data: {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [{
                label: "My First dataset",
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: [0, 10, 5, 2, 20, 30, 45],
            }]
        },

        // Configuration options go here
        options: {}
        });
    }
</script>
@endsection