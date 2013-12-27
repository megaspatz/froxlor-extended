$header
<article>
	<header>
		<h2>
			<img src="templates/{$theme}/assets/img/icons/traffic_big.png" alt="{$lng['menue']['traffic']['traffic']}" />&nbsp;
			{$lng['menue']['traffic']['traffic']} $show
		</h2>
	</header>
	
	<table class="bradius" id="datatable">
		<thead>
			<tr>
				<th>{$lng['traffic']['day']}</th>
				<th>{$lng['traffic']['ftp']}</th>
				<th>{$lng['traffic']['http']}</th>
				<th>{$lng['traffic']['mail']}</th>
				<th>{$lng['traffic']['mb']}</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td>{$lng['traffic']['months']['total']}</td>
				<td>{$traffic_complete['ftp']}</td>
				<td>{$traffic_complete['http']}</td>
				<td>{$traffic_complete['mail']}</td>
				<td>&nbsp;</td>
			</tr>
		</tfoot>	
		<tbody>
			$traffic
		</tbody>
	</table>
	<div id="charts" style="display: none">
		<h3>HTTP {$lng['admin']['traffic']} ({$lng['traffic']['months']['total']} {$traffic_complete['http']})</h3>
		<div id="httpchart" class="trafficchart"></div>
		<h3>FTP {$lng['admin']['traffic']} ({$lng['traffic']['months']['total']} {$traffic_complete['ftp']})</h3>
		<div id="ftpchart" class="trafficchart"></div>
		<h3>Mail {$lng['admin']['traffic']} ({$lng['traffic']['months']['total']} {$traffic_complete['mail']})</h3>
		<div id="mailchart" class="trafficchart"></div>
	</div>
</article>
$footer
