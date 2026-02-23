@extends('admin.sidebar')


<html>

<head>
    <style>
        body {
            background-color: #f0f4f8;
            /* Light gray background */
            /* display: flex; */
            /* justify-content: center;
            align-items: center; */
            height: 100vh;
            margin-left: 200px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .title-bar {
            /* background-color: #333; */
            /* Dark background for the title bar */
            padding: 10px 10px;
            /* Spacing inside the title bar */
            text-align: center;
            /* Center the text horizontally */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            /* Subtle shadow for depth */
            margin-left: 95px;
            width: 900px;
        }

        .title-text {
            /* color: #fff; */
            font-family: 'Arial', sans-serif;
            font-size: 28px;
            margin: 0;
            padding: 0;
            text-transform: uppercase;
            letter-spacing: 0px;
            color: #fff;
            background-color: #151A2D;
        }

        .title-bar-1 {
            /* background-color: #333; */
            /* Dark background for the title bar */
            padding: 10px 10px;
            /* Spacing inside the title bar */
            text-align: center;
            /* Center the text horizontally */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            /* Subtle shadow for depth */
            margin-left: 95px;
            width: 900px;
            margin-top: 20px;
        }

        .total-text {
            /* color: #fff; */
            font-family: 'Arial', sans-serif;
            font-size: 20px;
            margin: 0;
            padding: 0;
            text-transform: uppercase;
            letter-spacing: 0px;
            color: #151A2D;
            /* color: #fff; */
            /* background-color: #151A2D; */
        }
    </style>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            const data = google.visualization.arrayToDataTable(@json($chartData));

            var options = {
                title: 'Monthly users analysis',
                hAxis: {
                    title: 'users count',
                    minValue: 0
                },
                vAxis: {
                    title: 'Month'
                }
            };

            const chart = new google.visualization.BarChart(document.getElementById('barchart'));
            chart.draw(data, options);
        }
    </script>
</head>

<body>
    <div class="title-bar">
        <h1 class=" title-text">Monthly Users of 2026</h1>
    </div>
    <div class="title-bar-1">
        <h1 class="total-text">Total Users = {{ $totalUsers }}</h1>
    </div>
    <div id="barchart" style="max-width:900px; height:600px; margin-top:20px; margin-left: 100px; "></div>

</body>

</html>