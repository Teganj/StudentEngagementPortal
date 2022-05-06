<?php

//lazily getting counts of each completed activity, realistically a loop should be used here
$result2 = $con->query("SELECT count(*) as total from reports where activity1='Completed'");
$a1 = $result2->fetch_assoc();
//echo $a1['total'];
//echo "<br>";
$result2 = $con->query("SELECT count(*) as total from reports where activity2='Completed'");
$a2 = $result2->fetch_assoc();
//echo $data['total'];
//echo "<br>";
$result2 = $con->query("SELECT count(*) as total from reports where activity3='Completed'");
$a3 = $result2->fetch_assoc();
//echo $data['total'];
//echo "<br>";
$result2 = $con->query("SELECT count(*) as total from reports where activity1='Uncompleted'");
$ai1 = $result2->fetch_assoc();
$result2 = $con->query("SELECT count(*) as total from reports where activity2='Uncompleted'");
$ai2 = $result2->fetch_assoc();
$result2 = $con->query("SELECT count(*) as total from reports where activity3='Uncompleted'");
$ai3 = $result2->fetch_assoc();
$result2 = $con->query("SELECT COUNT(*) FROM reports where activity1='completed'");

$result3 = $con->query("SELECT count(*) as total from reports where activity1='Completed (achieved pass grade)'");
$apg1 = $result3->fetch_assoc();
$result3 = $con->query("SELECT count(*) as total from reports where activity2='Completed (achieved pass grade)'");
$apg2 = $result3->fetch_assoc();
$result3 = $con->query("SELECT count(*) as total from reports where activity3='Completed (achieved pass grade)'");
$apg3 = $result3->fetch_assoc();
$result3 = $con->query("SELECT COUNT(*) FROM reports where activity1='completed'");


if ($result->num_rows > 0) {
    ?>
    <figure class="highcharts-figure-piechart">
        <div id="container_piechart"></div>
    </figure>
    <?php
} else { ?>
    No Data found, Cannot Display Pie Chart!
<?php }
?>

<script>
    Highcharts.chart('container_piechart', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Total Course Completion'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        series: [{
            name: 'Completion',
            colorByPoint: true,
            data: [{
                name: 'Completed',
                data: [<?php echo $a1['total']?>]
            }, {
                name: 'Uncompleted',
                data: [<?php echo $ai1['total']?>]
            }, {
                name: 'Completed (achieved pass grade)',
                data: [<?php echo $apg1['total']?>]
            }]
        }]
    });
</script>