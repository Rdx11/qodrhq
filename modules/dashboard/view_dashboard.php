<?php

function qodr_dashboard_view($dt,$view){
	$html=$view['script'].'
	<div class="container">
		<div class="row">
			<h1>Dashboard</h1>
			<div>
				Server (<b>'.$_SERVER['HTTP_HOST'].'</b>) &rarr; Database (<b>'.URL_REMOTE.'</b>)
			</div>
			<div>
				<table border=1 frames=all rules=all >';
					foreach ($dt as $k => $v) {
						$html.='
						<tr>
							<td>'.$k.'</td>
							<td>'.$v.'</td>
						</tr>
						';
					}
					$html .='
				</table>
			</div>
		</div>
	</div>';
	return $html;
}