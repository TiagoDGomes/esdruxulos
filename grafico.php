<?php
	include "classes/libchart-1.2.1/libchart/classes/libchart.php";

	header("Content-type: image/png");

	$chart = new PieChart(500, 300);

	$dataSet = new XYDataSet();
        for ($i=0;$i<count($_GET['n']) ;$i++){
            $dataSet->addPoint(new Point($_GET['n'][$i], $_GET['v'][$i]));
        }
        $chart->setDataSet($dataSet);

	$chart->setTitle($_GET['nome']);
	$chart->render();
?>
