<?php
$module_name = $_SESSION['module_name'];

$result = $con->query("SELECT * FROM reports where module_name='$module_name'");
while ("SELECT * FROM reports where module_name='$module_name'") {
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
}
if ($result->num_rows > 0) {
    ?>
    <figure class="highcharts-figure-areachart">
        <div id="container-areachart"></div>
    </figure>
    <?php
} else { ?>
    No Data found, Cannot Display Area Chart!
<?php }
?>
<script>
    Highcharts.chart('container-areachart', {
        chart: {
            type: 'area'
        },
        title: {
            text: 'Activities by completion'
        },
        subtitle: {
            text: 'Indicates problem activities'
        },
        xAxis: {
            allowDecimals: false,
            labels: {
                formatter: function () {
                    return this.value;
                }
            }
        },
        yAxis: {
            title: {
                text: 'Completion (lessons)'
            },
            labels: {
                formatter: function () {
                    return this.value;
                }
            }
        },
        tooltip: {
            pointFormat: 'Lessons'
        },
        plotOptions: {
            area: {
                pointStart: 1,
                marker: {
                    enabled: false,
                    symbol: 'circle',
                    radius: 2,
                    states: {
                        hover: {
                            enabled: true
                        }
                    }
                }
            }
        },
        series: [{
            name: 'Completed',
            data: [<?php echo $a1['total']?>, <?php echo $a2['total']?>, <?php echo $a3['total']?>, <?php echo $a4['total']?>, <?php echo $a5['total']?>, <?php echo $a6['total']?>, <?php echo $a7['total']?>, <?php echo $a8['total']?>, <?php echo $a9['total']?>, <?php echo $a10['total']?>, <?php echo $a11['total']?>, <?php echo $a12['total']?>]
        }, {
            name: 'Not Completed',
            data: [<?php echo $ai1['total']?>, <?php echo $ai2['total']?>, <?php echo $ai3['total']?>, <?php echo $ai4['total']?>, <?php echo $ai5['total']?>, <?php echo $ai6['total']?>, <?php echo $ai7['total']?>, <?php echo $ai8['total']?>, <?php echo $ai9['total']?>, <?php echo $ai10['total']?>, <?php echo $ai11['total']?>, <?php echo $ai12['total']?>]
        },
            {
                name: 'Not completed',
                data: [<?php echo $apg1['total']?>, <?php echo $apg2['total']?>, <?php echo $apg3['total']?>, <?php echo $apg4['total']?>, <?php echo $apg5['total']?>, <?php echo $apg6['total']?>, <?php echo $apg7['total']?>, <?php echo $apg8['total']?>, <?php echo $apg9['total']?>, <?php echo $apg10['total']?>, <?php echo $apg11['total']?>, <?php echo $apg12['total']?>]
            }]
    });
</script>

