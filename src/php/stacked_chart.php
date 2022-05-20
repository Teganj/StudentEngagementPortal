<?php
$module_name = $_SESSION['module_name'];

$result = $con->query("SELECT * FROM reports where module_name='$module_name'");

$result1 = $con->query("SELECT count(*) as total from reports where activity1='Completed'");
$a1 = $result1->fetch_assoc();
$result1 = $con->query("SELECT count(*) as total from reports where activity2='Completed'");
$a2 = $result1->fetch_assoc();
$result1 = $con->query("SELECT count(*) as total from reports where activity3='Completed'");
$a3 = $result1->fetch_assoc();
$result1 = $con->query("SELECT count(*) as total from reports where activity4='Completed'");
$a4 = $result1->fetch_assoc();
$result1 = $con->query("SELECT count(*) as total from reports where activity5='Completed'");
$a5 = $result1->fetch_assoc();
$result1 = $con->query("SELECT count(*) as total from reports where activity6='Completed'");
$a6 = $result1->fetch_assoc();
$result1 = $con->query("SELECT count(*) as total from reports where activity7='Completed'");
$a7 = $result1->fetch_assoc();
$result1 = $con->query("SELECT count(*) as total from reports where activity8='Completed'");
$a8 = $result1->fetch_assoc();
$result1 = $con->query("SELECT count(*) as total from reports where activity9='Completed'");
$a9 = $result1->fetch_assoc();
$result1 = $con->query("SELECT count(*) as total from reports where activity10='Completed'");
$a10 = $result1->fetch_assoc();
$result1 = $con->query("SELECT count(*) as total from reports where activity11='Completed'");
$a11 = $result1->fetch_assoc();
$result1 = $con->query("SELECT count(*) as total from reports where activity12='Completed'");
$a12 = $result1->fetch_assoc();
$result1 = $con->query("SELECT COUNT(*) FROM reports where activity1='Completed'");

$result2 = $con->query("SELECT count(*) as total from reports where activity1='Not completed'");
$ai1 = $result2->fetch_assoc();
$result2 = $con->query("SELECT count(*) as total from reports where activity2='Not completed'");
$ai2 = $result2->fetch_assoc();
$result2 = $con->query("SELECT count(*) as total from reports where activity3='Not completed'");
$ai3 = $result2->fetch_assoc();
$result2 = $con->query("SELECT count(*) as total from reports where activity4='Not completed'");
$ai4 = $result2->fetch_assoc();
$result2 = $con->query("SELECT count(*) as total from reports where activity5='Not completed'");
$ai5 = $result2->fetch_assoc();
$result2 = $con->query("SELECT count(*) as total from reports where activity6='Not completed'");
$ai6 = $result2->fetch_assoc();
$result2 = $con->query("SELECT count(*) as total from reports where activity7='Not completed'");
$ai7 = $result2->fetch_assoc();
$result2 = $con->query("SELECT count(*) as total from reports where activity8='Not completed'");
$ai8 = $result2->fetch_assoc();
$result2 = $con->query("SELECT count(*) as total from reports where activity9='Not completed'");
$ai9 = $result2->fetch_assoc();
$result2 = $con->query("SELECT count(*) as total from reports where activity10='Not completed'");
$ai10 = $result2->fetch_assoc();
$result2 = $con->query("SELECT count(*) as total from reports where activity11='Not completed'");
$ai11 = $result2->fetch_assoc();
$result2 = $con->query("SELECT count(*) as total from reports where activity12='Not completed'");
$ai12 = $result2->fetch_assoc();
$result2 = $con->query("SELECT COUNT(*) FROM reports where activity1='Not completed'");

$result3 = $con->query("SELECT count(*) as total from reports where activity1='Completed (achieved pass grade)'");
$apg1 = $result3->fetch_assoc();
$result3 = $con->query("SELECT count(*) as total from reports where activity2='Completed (achieved pass grade)'");
$apg2 = $result3->fetch_assoc();
$result3 = $con->query("SELECT count(*) as total from reports where activity3='Completed (achieved pass grade)'");
$apg3 = $result3->fetch_assoc();
$result3 = $con->query("SELECT count(*) as total from reports where activity4='Completed (achieved pass grade)'");
$apg4 = $result3->fetch_assoc();
$result3 = $con->query("SELECT count(*) as total from reports where activity5='Completed (achieved pass grade)'");
$apg5 = $result3->fetch_assoc();
$result3 = $con->query("SELECT count(*) as total from reports where activity6='Completed (achieved pass grade)'");
$apg6 = $result3->fetch_assoc();
$result3 = $con->query("SELECT count(*) as total from reports where activity7='Completed (achieved pass grade)'");
$apg7 = $result3->fetch_assoc();
$result3 = $con->query("SELECT count(*) as total from reports where activity8='Completed (achieved pass grade)'");
$apg8 = $result3->fetch_assoc();
$result3 = $con->query("SELECT count(*) as total from reports where activity9='Completed (achieved pass grade)'");
$apg9 = $result3->fetch_assoc();
$result3 = $con->query("SELECT count(*) as total from reports where activity10='Completed (achieved pass grade)'");
$apg10 = $result3->fetch_assoc();
$result3 = $con->query("SELECT count(*) as total from reports where activity11='Completed (achieved pass grade)'");
$apg11 = $result3->fetch_assoc();
$result3 = $con->query("SELECT count(*) as total from reports where activity12='Completed (achieved pass grade)'");
$apg12 = $result3->fetch_assoc();
$result3 = $con->query("SELECT COUNT(*) FROM reports where activity1='Completed (achieved pass grade)'");

if ($result->num_rows > 0) {
    ?>
    <figure class="highcharts-figure-stackedchart">
        <div id="container-stackedchart"></div>
    </figure>
    <?php
} else { ?>
    No Data found, Cannot Display Stacked Chart!
<?php }
?>
<script>
    Highcharts.chart('container-stackedchart', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Stacked column chart'
        },
        xAxis: {
            categories: ['Activity 1', 'Activity 2', 'Activity 3', 'Activity 4', 'Activity 5', 'Activity 6', 'Activity 7', 'Activity 8', 'Activity 9', 'Activity 10', 'Activity 11', 'Activity 12'],
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Completion (activities)'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: ( // theme
                        Highcharts.defaultOptions.title.style &&
                        Highcharts.defaultOptions.title.style.color
                    ) || 'gray'
                }
            }
        },
        legend: {
            align: 'right',
            x: -30,
            verticalAlign: 'top',
            y: 25,
            floating: true,
            backgroundColor:
                Highcharts.defaultOptions.legend.backgroundColor || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
        },
        tooltip: {
            headerFormat: '<b>{point.x}</b><br/>',
            pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true
                }
            }
        },
        series: [{
            name: '1',
            data: [5, 3, 4, 7, 2]
        }, {
            name: '2',
            data: [2, 2, 3, 2, 1]
        }, {
            name: '3',
            data: [3, 4, 4, 2, 5]
        }]
    });

</script>
