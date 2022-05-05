<?php


                //lazily getting counts of each completed activity, realistically a loop should be used here
                $result2 = $con->query("SELECT count(*) as total from reports where week1='Completed'");
                $a1 = $result2->fetch_assoc();
                //echo $a1['total'];
                //echo "<br>";
                $result2 = $con->query("SELECT count(*) as total from reports where week2='Completed'");
                $a2 = $result2->fetch_assoc();
                //echo $data['total'];
                //echo "<br>";
                $result2 = $con->query("SELECT count(*) as total from reports where week3='Completed'");
                $a3 = $result2->fetch_assoc();
                //echo $data['total'];
                //echo "<br>";
                $result2 = $con->query("SELECT count(*) as total from reports where week1='Not completed'");
                $ai1 = $result2->fetch_assoc();
                $result2 = $con->query("SELECT count(*) as total from reports where week2='Not completed'");
                $ai2 = $result2->fetch_assoc();
                $result2 = $con->query("SELECT count(*) as total from reports where week3='Not completed'");
                $ai3 = $result2->fetch_assoc();
                $result2 = $con->query("SELECT COUNT(*) FROM reports where week1='completed'");
                if ($result->num_rows > 0) {
                    ?>
                    <figure class="highcharts-figure-barchart">
                        <div id="container"></div>
                    </figure>
                    <?php
                } else { ?>
                    No Data exists!!
                <?php }
                ?>
                </tbody>
            </table>
            <script>
                Highcharts.chart('container', {
                    chart: {
                        type: 'bar'
                    },
                    title: {
                        text: 'Activities by completion'
                    },
                    subtitle: {
                        text: 'Indicates problem activities'
                    },
                    xAxis: {
                        categories: ['Activity 1', 'Activity 2', 'Activity 3'],
                        title: {
                            text: null
                        }
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Completion (lessons)',
                            align: 'high'
                        },
                        labels: {
                            overflow: 'justify'
                        }
                    },
                    tooltip: {
                        valueSuffix: ' lessons'
                    },
                    plotOptions: {
                        bar: {
                            dataLabels: {
                                enabled: true
                            }
                        }
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'top',
                        x: -40,
                        y: 80,
                        floating: true,
                        borderWidth: 1,
                        backgroundColor:
                            Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
                        shadow: true
                    },
                    credits: {
                        enabled: false
                    },
                    series: [{
                        name: 'Completed',
                        data: [<?php echo $a1['total']?>, <?php echo $a2['total']?>, <?php echo $a3['total']?>]
                    }, {
                        name: 'Incomplete',
                        data: [<?php echo $ai1['total']?>, <?php echo $ai2['total']?>, <?php echo $ai3['total']?>]
                    }]
                });
            </script>
        </div>
    </div>