<?php
	$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
	$pdf->SetTitle($title);
	$pdf->SetTopMargin(20);
	$pdf->setFooterMargin(20);
	$pdf->SetAutoPageBreak(true);
	$pdf->SetAuthor('Author');
	$pdf->SetDisplayMode('real', 'default');
	$pdf->AddPage();
	$i=0;
			$html='<h3>Daftar Jenis Barang </h3>

					<br/>
					tanggal : '.$date.'
					<br/>
					<br/>
					<table bgcolor="#666666" border="1px" cellpadding="4">
					<thead>
						<tr bgcolor="#ffffff">
							<th>No</th>
							<th>ID Jenis</th>
							<th>Keterangan Jenis</th>
						</tr>
						</thead>';
			foreach ($isi as $row)
				{

					$i++;
					$html.='<tr bgcolor="#ffffff">
							<td align="center">'.$i.'</td>
							<td>'.$row->id_jenis.'</td>
							<td>'.$row->jenis.'</td>
							<td>'.$row->ket_jenis.'</td>

						</tr>';
				}
			$html.='</table>';
			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->Output('LaporanJenis_'.$date.'.pdf', 'I');

 ?>
