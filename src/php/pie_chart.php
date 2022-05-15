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
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45
            }
        },
        title: {
            text: 'Completion of Activities'
        },
        plotOptions: {
            pie: {
                innerSize: 100,
                depth: 45
            }
        },
        series: [{
            name: 'Number of Completions',
            data: [
                ['Activity 1', <?php echo $a1['total']?>],
                ['Activity 2', <?php echo $a2['total']?>],
                ['Activity 3', <?php echo $a3['total']?>],
                ['Activity 4', <?php echo $a4['total']?>],
                ['Activity 5', <?php echo $a5['total']?>],
                ['Activity 6', <?php echo $a6['total']?>],
                ['Activity 7', <?php echo $a7['total']?>],
                ['Activity 8', <?php echo $a8['total']?>],
                ['Activity 9', <?php echo $a9['total']?>],
                ['Activity 10', <?php echo $a10['total']?>],
                ['Activity 11', <?php echo $a11['total']?>],
                ['Activity 12', <?php echo $a12['total']?>]
            ]
        }]
    });
</script>
