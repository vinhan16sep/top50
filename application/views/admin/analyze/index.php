<!--main content start-->
<div class="content-wrapper" style="min-height: 916px;">
    <!-- <div class="box-body pad table-responsive">
        <h3>Trang thông tin: <span style="color:red;"><?php echo $user->company; ?></span></h3>
    </div> -->
    <section class="content">

        <div class="row">
            <!-- /.col -->
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <div class="tab-content">
                        <div class="post">
                            <h4><b>Thống kê doanh thu theo lĩnh vực năm <?= $selected_year ?></b></h4>
                            <canvas id="incomeAreaChart" height="80"></canvas>
                        </div>
                        <div class="post">
                            <h4><b>Thống kê số lao động theo lĩnh vực năm <?= $selected_year ?></b></h4>
                            <canvas id="laborAreaChart" height="80"></canvas>
                        </div>
                        <div class="post">
                            <h4><b>Thống kê tổng doanh thu qua các năm</b></h4>
                            <canvas id="totalIncomeChart" height="80"></canvas>
                        </div>
                        <div class="post">
                            <h4><b>Thống kê tổng số lao động qua các năm</b></h4>
                            <canvas id="totalLaborChart" height="80"></canvas>
                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
</div>
<script>
<?php
    ksort($chart_data['area']);
    $js_income_area = json_encode(array_keys($chart_data['area']));
    $js_income_value = json_encode(array_values($chart_data['area']));
    echo "var js_income_area = ". $js_income_area . ";\n";
    echo "var js_income_value = ". $js_income_value . ";\n";
?>
var ctx = document.getElementById('incomeAreaChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'pie',
    // type: 'doughnut',

    // The data for our dataset
    data: {
        labels: js_income_area,
        datasets: [{
            label: 'Thống kê doanh thu theo lĩnh vực',
            backgroundColor: ["yellow", "blue", "green"],
            borderColor: 'gray',
            data: js_income_value
        }],
    },

    // Configuration options go here
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

<?php
    ksort($chart_data['labor_area']);
    $js_labor_area = json_encode(array_keys($chart_data['labor_area']));
    $js_labor_value = json_encode(array_values($chart_data['labor_area']));
    echo "var js_labor_area = ". $js_labor_area . ";\n";
    echo "var js_labor_value = ". $js_labor_value . ";\n";
?>
var ctx = document.getElementById('laborAreaChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'pie',
    // type: 'doughnut',

    // The data for our dataset
    data: {
        labels: js_labor_area,
        datasets: [{
            label: 'Thống kê số lao động theo lĩnh vực',
            backgroundColor: ["yellow", "blue", "green"],
            borderColor: 'gray',
            data: js_labor_value
        }],
    },

    // Configuration options go here
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

<?php
    ksort($chart_data['all_year_income']);
    $js_income_year = json_encode(array_keys($chart_data['all_year_income']));
    $js_income_value = json_encode(array_values($chart_data['all_year_income']));
    echo "var js_income_year = ". $js_income_year . ";\n";
    echo "var js_income_value = ". $js_income_value . ";\n";
?>
var ctx = document.getElementById('totalIncomeChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
        labels: js_income_year,
        datasets: [{
            label: 'Thống kê tổng doanh thu',
            backgroundColor: 'rgb(45,106,184)',
            borderColor: 'rgb(45,106,184)',
            data: js_income_value
        }]
    },

    // Configuration options go here
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }],
            xAxes: [{
                barPercentage: 0.1
            }]
        }
    }
});

<?php
    ksort($chart_data['all_year_labor']);
    $js_labor_year = json_encode(array_keys($chart_data['all_year_labor']));
    $js_labor_value = json_encode(array_values($chart_data['all_year_labor']));
    echo "var js_labor_year = ". $js_labor_year . ";\n";
    echo "var js_labor_value = ". $js_labor_value . ";\n";
?>
var ctx = document.getElementById('totalLaborChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
        labels: js_labor_year,
        datasets: [{
            label: 'Thống kê tổng số lao động',
            backgroundColor: 'rgb(45,106,184)',
            borderColor: 'rgb(45,106,184)',
            data: js_labor_value
        }]
    },

    // Configuration options go here
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }],
            xAxes: [{
                barPercentage: 0.1
            }]
        }
    }
});
</script>

