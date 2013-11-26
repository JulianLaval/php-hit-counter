<?php

// REQUIRE DB CONNECTION
require_once('conn.php');

// GET PAGE HIT INFO FROM DB
$sql = "SELECT * FROM ".$GLOBALS['hits_table_name'];
$query = $db->prepare($sql);
$query->execute();
$page_hits = $query->fetchAll();

// GET NUMBER OF UNIQUE VISITORS
$sql = "SELECT COUNT(DISTINCT ip_address) AS alias FROM ".$GLOBALS['info_table_name'];
$query = $db->prepare($sql);
$query->execute();
$unique_visitors = $query->fetch()['alias'];

// GET VISITOR INFO FROM DB
$sql = "SELECT * FROM ".$GLOBALS['info_table_name']." ORDER BY time_accessed ASC";
$query = $db->prepare($sql);
$query->execute();
$hits_info = $query->fetchAll();

// ONLY SHOW 10 LATEST VISITOR INFO
$visitor_info = array_slice(array_reverse($hits_info), 0, 10);
				
?>
<!DOCTYPE html>
<html>
	<head>
		<script type="text/javascript" src="dygraph.js"></script>
		<style>
			body {
				padding:20px 40px;
				font-family:"Arial", sans-serif;
				font-color:#333;
			}
			table {
				border-style:none;
			}
			table tr td {
				padding: 5px 10px;
				border:0px;
			}
			table tr:nth-child(even){
				background-color: #f0f0f0;
			}
			#total {
				background:#333;
				color:#fff;
			}
		</style>
	</head>
	<body>
		<h3>PAGE HITS</h3>
		<table cellspacing="0" cellpadding="0">
			<?php		
			// PRINT PAGE HIT INFO
			$total_hits = 0;
			foreach($page_hits as $ind_page){
				echo '<tr><td><strong>'.$ind_page['page'].'</strong>:</td>
				<td>'.$ind_page['count'].'</td></tr>';
				$total_hits += $ind_page['count'];
			}
			?>
			<tr id="total">
				<td><strong>Total</strong>:</td>
				<td><?php echo $total_hits; ?></td>
			</tr>
		</table><br /><br />
		<div id="graphdiv"></div>
		<br /><br />
		<h3>VISITOR INFORMATION</h3>
		<strong>Total number of unique visitors</strong>: <?php echo $unique_visitors; ?><br /><br />
		<strong>LATEST VISITORS</strong>
		<table cellspacing="0" cellpadding="0">
			<tr>
				<td><strong>IP address</strong></td>
				<td><strong>User agent</strong></td>
				<td><strong>Time accessed</strong></td>
			</tr>
			<?php
			// PRINT VISITOR INFO
			foreach($visitor_info as $ind_visitor){
				echo '<tr><td>'.$ind_visitor['ip_address'].'</td>
				<td>'.$ind_visitor['user_agent'].'</td>
				<td>'.$ind_visitor['time_accessed'].'</td></tr>';
			}
			?>
		</table>
		<script type="text/javascript">
		  g = new Dygraph(

			// containing div
			document.getElementById("graphdiv"),

			// CSV or path to a CSV file.
			<?php
				// GENERATE CSV FOR GRAPH
				echo '"Time,Hits';
				foreach($hits_info as $ind_hit){
					echo '\n" + "'.$ind_hit['time_accessed'].','.$ind_hit['id'];
				}
				echo '\n"';
			?>,
			{
				title: 'Evolution of page hits',
				legend: 'always',
				labelsDivStyles: { 'textAlign': 'right' }
			});
		</script>
	</body>
</html>