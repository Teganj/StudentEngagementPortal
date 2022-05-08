<script>
    var chartPie;
    $(document).ready(function () {
        chartPie = new Highcharts.chart('container_barchart', {
            chartPie: {
                renderTo: 'container_barchart',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Activity Competition'
            },
            tooltip: {
                formatter: function () {
                    return '<b>' +
                        this.point.name + '</b>: ' + Highcharts.numberFormat(this.percentage, 2) + ' % ';
                }
            },


            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: 'green',
                        formatter: function () {
                            return '<b>' + this.point.name + '</b>: ' + Highcharts.numberFormat(this.percentage, 2) + ' % ';
                        }
                    }
                }
            },

            series: [{
                type: 'pie',
                name: 'Browser share',
                data: [
                <?php
                include "connection.php";
                $data = mysqli_fetch_array(mysqli_query($con, "SELECT total from reports where activity1='Completed'"));


                while ($row = mysql_fetch_array($data)) {
                    extract($row);

                    $datapie[] = array($data);
                }
                mysql_close($con);
                $data = json_encode($datapie);
                ?>]
                }]
        });
    });
</script>