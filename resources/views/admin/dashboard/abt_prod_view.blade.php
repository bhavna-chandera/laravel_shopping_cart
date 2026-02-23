@extends('admin.sidebar')

<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            background-color: #f0f4f8;
            height: 100vh;
            margin-left: 200px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .title-bar {
            padding: 10px 10px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            margin-left: 95px;
            width: 600px;
        }

        .title-text {
            font-family: 'Arial', sans-serif;
            font-size: 28px;
            margin: 0;
            padding: 0;
            text-transform: uppercase;
            letter-spacing: 0px;
            color: #fff;
            background-color: #151A2D;
        }

        .total-text {
            font-family: 'Arial', sans-serif;
            font-size: 20px;
            margin: 0;
            padding: 0;
            text-transform: uppercase;
            letter-spacing: 0px;
            color: #151A2D;
        }

        .title-bar-1 {
            padding: 10px 10px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            margin-left: 95px;
            width: 900px;
        }

        .space {
            margin-top: 20px;
        }
    </style>

    <script src="https://www.gstatic.com/charts/loader.js"></script>

    <!-- TOTAL VIEWS -->
    <script>
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawTotal);

        function drawTotal() {
            let data = google.visualization.arrayToDataTable([
                ['Views', 'Views'],
                ['Total Views', '{{ $totalViews }}']
            ]);

            var options = {
                pieHole: 0.5,
                pieSliceTextStyle: {
                    color: 'black',
                },
                legend: 'none'
            };

            var chart = new google.visualization.PieChart(document.getElementById('donut_single'));
            chart.draw(data, options);


            chart.draw(data, {
                pieHole: 0.3,
                legend: 'none'
            });
        }
    </script>

    <!-- VIEWS BY CATEGORY -->
    <script>
        google.charts.setOnLoadCallback(drawCat);

        function drawCat() {
            let data = google.visualization.arrayToDataTable(@json($catChart));

            let chart = new google.visualization.BarChart(
                document.getElementById('viewbycat')
            );
            chart.draw(data, {
                chartArea: {
                    width: '50%'
                },
                hAxis: {
                    title: 'Total Views',
                    minValue: 0
                },
                vAxis: {
                    title: 'Category'
                }
            });
        }
    </script>

    <!-- TOP PRODUCTS -->
    <script>
        google.charts.setOnLoadCallback(drawProd);

        function drawProd() {
            let data = google.visualization.arrayToDataTable(@json($prodChart));

            let chart = new google.visualization.ColumnChart(
                document.getElementById('topprod')
            );
            chart.draw(data, {
                chartArea: {
                    width: '50%'
                },
                hAxis: {
                    title: 'Product'
                },
                vAxis: {
                    title: 'View Count'
                }
            });
        }
    </script>
</head>

<body>
    <div class="title-bar">
        <h1 class="title-text">Total views of products</h1>
    </div>
    <p class="space"></p>

    <div class="title-bar">
        <h3 class="total-text">Total views: {{ $totalViews }}</h3>

    </div>

    <div id="donut_single" style="max-width:600px; height:400px; margin-top:20px; margin-left: 100px; "></div>
    <p class="space"></p>
    <div class="title-bar-1">
        <h1 class="title-text">views of products by cat</h1>
    </div>
    <div id="viewbycat" style="max-width:900px; height:600px; margin-top:20px; margin-left: 100px; "></div>
    <!-- <div id="chart_div" style="width: 900px; height: 500px;"></div> -->
    <p class="space"></p>
    <p class="space"></p>
    <div class="title-bar-1">
        <h1 class="title-text">Top 5 Products by views</h1>
    </div>
    <div id="topprod" style="max-width:1000px; height:600px; margin-top:20px; margin-left: 100px; "></div>
</body>

</html>