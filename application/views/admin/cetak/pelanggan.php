<?php
	$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
	$pdf->SetTitle($title);
	$pdf->SetTopMargin(20);
	$pdf->setFooterMargin(20);
	$pdf->SetAutoPageBreak(true);
	$pdf->SetAuthor('Author');
	$pdf->SetDisplayMode('real', 'default');
	$pdf->AddPage('L');
	$i=0;
			$html='<h3>Daftar Pelanggan </h3>
			<br/>
			tanggal : '.$date.'
			<br/>
			<br/>
					<table bgcolor="#666666" border="1px" cellpadding="4">
					<thead>
						<tr bgcolor="#ffffff">
							<th>No</th>
							<th>Pelanggan</th>
							<th>No Telp</th>
							<th>Alamat</th>
							<th>Email</th>
							<th>Saldo</th>
							<th>Status</th>
						</tr>
						</thead>';
			foreach ($isi as $row)
				{
					if ($row->status_p == 1) {
						$ss = "aktif";
					}else {
						$ss = "belum aktif";
					}
					$i++;
					$html.='<tr bgcolor="#ffffff">
							<td align="center">'.$i.'</td>
							<td>'.$row->pelanggan.'</td>
							<td>'.$row->notelp.'</td>
							<td>'.$row->alamat.'</td>
							<td>'.$row->email.'</td>
							<td >Rp '.number_format($row->saldo,0,",",",").'</td>
							<td>'.$ss.'</td>
						</tr>';
				}
			$html.='</table>';
			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->Output('LaporanPelanggan_'.$date.'.pdf', 'I');

 ?>
