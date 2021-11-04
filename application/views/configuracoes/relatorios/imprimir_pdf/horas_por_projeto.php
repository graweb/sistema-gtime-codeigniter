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
		<h1 style="text-align:center"><strong style="font-size:30px">INVOICE</strong></h1>
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
				<td><strong>BILL TO:</strong></td>
			</tr>
			<tr>
				<td>Bingo Impact Management Consulting Inc.</td>
			</tr>
			<tr>
				<td>78 George Street, Suite 204</td>
				<td><strong>INVOICE DATE:</strong> <?php echo date('d/m/Y');?></td>
			</tr>
			<tr>
				<td>Ottawa, ON K1N 5W1</td>
				<td><strong>DUE DATE:</strong> <?php echo date('d/m/Y', strtotime('+1 month'));?></td>
			</tr>
		</table>
		<p></p>
		<table class="table">
			<thead>
				<tr>
					<th style="width:50%">DESCRIPTION</th>
					<th style="width:10%">PRICE</th>
					<th style="width:10%">QUANTITY</th>
					<th style="width:10%">AMOUNT*h</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$i = 0;
					$minutosTotal = array();
					$horasTotal = array();
					$horas = array();
					foreach ($horasPorProjeto as $horasProj) {
						echo '<tr>';
							echo '<td>' . $horasProj->tarefa . '</td>';
							echo '<td style="text-align:center">25 CAD/h</td>';
							echo '<td style="text-align:center">' . $horasProj->horas_total . ':' . $horasProj->minutos_total . '/h</td>';
							echo '<td style="text-align:center"> $'. number_format($horasProj->horas_total*25, 2, ',','.') .'</td>';
						echo '</tr>';

						$horas[$i] = $horasProj->horas_total . ':' . $horasProj->minutos_total;
						$horasTotal[$i] = $horasProj->horas_total;
						$minutosTotal[$i] = $horasProj->minutos_total;
						$i++;
					}
				?>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td>&nbsp;</td>
					<td style="text-align:right;"><strong style="font-size:10px">HOURS:</strong></td>
					<td style="text-align:center">
						<strong style="font-size:10px">
						<?php
							$minutos = array_sum($minutosTotal);
							$horas = floor($minutos / 60);
							$minutos = $minutos % 60;
							$exibe = array_sum($horasTotal)+$horas;
							echo $exibe.':'.$minutos."h";
						?>
						</strong>
					</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td style="text-align:right;"><strong style="font-size:10px">CREDIT:</strong></td>
					<td style="text-align:center">
						<strong style="font-size:10px">
						<?php
							$minutos = array_sum($minutosTotal);
							$horas = floor($minutos / 60);
							$minutos = $minutos % 60;
							$exibe = array_sum($horasTotal)+$horas;
							echo $minutos."m";
						?>
					</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
			    	<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
			    </tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td style="text-align:right;"><strong style="font-size:14px">TOTAL:</strong></td>
					<td style="text-align:center">
						<strong style="font-size:14px">
							<?php 
								$minutos = array_sum($minutosTotal);
								$horas = floor($minutos / 60);
								$minutos = $minutos % 60;
								$exibe = array_sum($horasTotal)+$horas;
								echo '$'.number_format($exibe*25, 2, ',','.');
							?>
						</strong>
					</td>
			    </tr>
			</tfoot>
		</table>
		<p></p>
		<p></p>
		<table class="table">
			<tr>
				<th></th>
			</tr>
			<tr>
				<td><strong>ACCOUNT</strong></td>
			</tr>
			<tr>
				<td>Bank: 077 - Inter</td>
			</tr>
			<tr>
				<td>Branch: 0001</td>
			</tr>
			<tr>
				<td>Account: 002942078-4</td>
			</tr>
			<tr>
				<td>Name: Gustavo Grativol da Silva - CPF 116.313.217-90</td>
			</tr>
			<tr>
				<td>CNPJ: 22.848.379/0001-27 (PIX)</td>
			</tr>
		</table>
	</div>
</body>
</html>