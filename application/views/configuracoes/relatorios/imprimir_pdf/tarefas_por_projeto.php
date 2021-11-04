<html>
<head>
<title>Gtime - Gestão de Tempo</title>
<meta charset="UTF-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<style type="text/css">
body {
	font-family: "Times New Roman", Georgia, Serif;
	font-size: 10px;
}

.table {
	width: 100%;
}

th {
	background-color: #CCCCCC;
	font-weight: bold;
	text-align: center;
}

tfoot {
	background-color: #CCCCCC;
	font-weight: bold;
}
</style>
<body>
	<div>
		<h1 style="text-align:center"><strong style="font-size:30px">REPORT - TASKS BY PROJECT</strong></h1>
		<p></p>
		<p></p>
		<label style="font-size:16px">GRAWEB TECNOLOGIA</label><br>
		<label style="font-size:16px">Rua Camaratuba, 398 Apto 203 - Vila Valqueire - Rio de Janeiro - Brazil</label><br>
		<label style="font-size:16px">graweb1@gmail.com</label><br>
		<label style="font-size:16px">+55 21 96409-2597</label><br>
		<p></p>
		<table class="table">
			<tr>
				<th colspan="2"></th>
			</tr>
			<tr>
				<td><strong>COSTUMER:</strong></td>
			</tr>
			<tr>
				<td>Bingo Impact Management Consulting Inc.</td>
			</tr>
			<tr>
				<td>78 George Street, Suite 204</td>
			</tr>
			<tr>
				<td>Ottawa, ON K1N 5W1</td>
				<td><strong>DATE:</strong> <?php echo date('d/m/Y');?></td>
			</tr>
		</table>
		<p></p>
		<table class="table">
			<thead>
				<tr>
					<th style="width:85%">DESCRIPTION</th>
					<th style="width:15%">STATUS</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$i = 0;
					foreach ($tarefasPorProjeto as $tarefasProj) {
						echo '<tr>';
							echo '<td>' . $tarefasProj->tarefa . '</td>';

							if($tarefasProj->pago == '0')
							{
								$status = '<strong style="color:red">Unpaid</strong>';
							}
							else
							{
								$status = '<strong style="color:green">Paid</strong>';
							}

							echo '<td style="text-align:center">'. $status .'</td>';
						echo '</tr>';
						$i++;
					}
				?>
			</tbody>
		</table>
	</div>
</body>
</html>