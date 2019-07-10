<?php
require_once('../../core/helpers/dashboard.php');
Dashboard::headerTemplate('Bienvenido');
?>
<div class="container">
    <div class="row">
	    <h4 class="center-align pink-text" id="greeting"></h4>
    </div>
</div>
<div class="row">
    <div class="col s12 m6 ">
        <canvas id="chart"></canvas>
    </div>

    <div class="col s12 m6 ">
        <canvas id="chart2"></canvas>
    </div>
</div>

<div class="row">
    <div class="col s12 m6 ">
        <canvas id="chart3"></canvas>
    </div>
  
    <div class="col s12 m6 ">
        <canvas id="chart4"></canvas>
    </div>

    <div class="col s12 m6 ">
        <canvas id="chart5"></canvas>
    </div>
</div>
<script type="text/javascript" src="../../resources/js/chart.js"></script>
<?php
Dashboard::footerTemplate('main.js');
?>
