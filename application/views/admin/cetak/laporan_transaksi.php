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
			$html='<h3>Daftar Laporan Transaksi </h3>
			<br/>
			tanggal : '.$date.' - tanggal : '.$date2.'
			<br/>
			<br/>
					<table bgcolor="#666666" border="1px" cellpadding="4">
					<thead>
						<tr bgcolor="#ffffff">
							<th>No</th>
							<th>Faktur</th>
							<th>Tanggal</th>
							<th>Pegawai</th>
							<th>Pelanggan</th>
							<th>Total Harga</th>

						</tr>
						</thead>';
			foreach ($isi as $row)
				{

					$i++;
					$html.='<tr bgcolor="#ffffff">
							<td align="center">'.$i.'</td>
							<td>'.$row->faktur.'</td>
							<td>'.$row->tgl_order.'</td>
							<td>'.$row->nama_user.'</td>
							<td>'.$row->pelanggan.'</td>
							<td >Rp '.number_format($row->total_bayar,0,",",",").'</td>
							<td >Rp '.number_format($row->bayar,0,",",",").'</td>

						</tr>';
				}
			$html.='</table>';
			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->Output('laporan_transaksi_'.$date.' - '.$date2.'.pdf', 'I');

 ?>
