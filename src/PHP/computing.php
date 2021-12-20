<!DOCTYPE HTML>
<html>
<head>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script>
        window.onload = function () {

            var dataPoints = [];

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                exportEnabled: true,
                title:{
                    text: "Tuna Production"
                },
                axisY: {
                    title: "In metric tons"
                },
                data: [{
                    type: "column",
                    toolTipContent: "{y} metric tons",
                    dataPoints: dataPoints
                }]
            });

            $.get("https://canvasjs.com/data/gallery/php/tuna-production.csv", getDataPointsFromCSV);

//CSV Format
//Year,Volume
            function getDataPointsFromCSV(csv) {
                var csvLines = points = [];
                csvLines = csv.split(/[\r?\n|\r|\n]+/);
                for (var i = 0; i < csvLines.length; i++) {
                    if (csvLines[i].length > 0) {
                        points = csvLines[i].split(",");
                        dataPoints.push({
                            label: points[0],
                            y: parseFloat(points[1])
                        });
                    }
                }
                chart.render();
            }

        }
    </script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>

</body>
</html>