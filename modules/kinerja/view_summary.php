<?php
function qodr_kinerja_summary_view($dt){
    $view='
	    <h3>Statistic : </h3>
	    <br><br>
	    <div style="float:right;">
		    <label for="daterange">Select date to show your data</label>
		    <br>
		    <input type="text" name="daterange" id="daterange" />
	    </div>
	    <div id="chart-container">
        	<canvas id="graphCanvas"></canvas>
	    </div>
    	<div id="summary_table">
    		'.$dt['summary_table'].'
    	</div><br><br>';
    return $view;
}