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
			$html='<h3>Daftar Laporan Top up </h3>
			<br/>
			tanggal : '.$date.' - tanggal : '.$date2.'
			<br/>
			<br/>
					<table bgcolor="#666666" border="1px" cellpadding="4">
					<thead>
						<tr bgcolor="#ffffff">
							<th>No</th>
							<th>Tanggal</th>
							<th>Jumlah</th>
							<th>Pelanggan</th>
							<th>Pegawai</th>
						</tr>
						</thead>';
			$total=0;
			foreach ($isi as $row)
				{
					$total += $row->jumlah_deposit;
					$i++;
					$html.='<tr bgcolor="#ffffff">
							<td align="center">'.$i.'</td>
							<td>'.$row->tgl_deposit.'</td>
							<td >Rp '.number_format($row->jumlah_deposit,0,",",",").'</td>
							<td>'.$row->pelanggan.'</td>
							<td>'.$row->nama_user.'</td>
						</tr>';
				}
			$html.='</table>
			<br/><br/>
			Total Deposit : Rp '.number_format($total,0,",",",").'
			';
			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->Output('laporan_topup_'.$date.' - '.$date2.'.pdf', 'I');

 ?>
