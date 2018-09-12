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
			$html='<h3>Daftar Laporan Laba Rugi </h3>
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
							<th>Barang</th>
							<th>Jumlah</th>
							<th>Harga beli</th>
							<th>Harga jual</th>
							<th>Laba</th>
							<th>Rugi</th>

						</tr>
						</thead>';
			$torugi=0;
			$tolaba=0;
			foreach ($isi as $row)
				{
					$j = $row->jumlah;
					$hbeli = $row->harga_beli;
					$hjual = $row->harga_jual;

					if ($hjual > $hbeli) {
							$laba = $hjual*$j - $hbeli*$j ;
					}else{
						$laba = 0;
					}
					if ($hjual < $hbeli) {
						$rugi = $hbeli*$j - $hjual*$j ;
					}else{
						$rugi = 0;
					}
					$tolaba += $laba;
					$torugi += $rugi;

					$i++;
					$html.='<tr bgcolor="#ffffff">
							<td align="center">'.$i.'</td>
							<td>'.$row->faktur.'</td>
							<td>'.$row->tgl_order.'</td>
							<td>'.$row->barang.'</td>
							<td>'.$j.'</td>
							<td>'.number_format($hbeli,0,",",",").'</td>
							<td>'.number_format($hjual,0,",",",").'</td>
							<td>'.number_format($laba,0,",",",").'</td>
							<td>'.number_format($rugi,0,",",",").'</td>


						</tr>';
				}
			$html.='</table>
			<br/><br/>
			Total Laba: Rp '.number_format($tolaba,0,",",",").'
			<br/>
			Total Laba: Rp '.number_format($torugi,0,",",",").'

			';
			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->Output('laporan_labarugi_'.$date.' - '.$date2.'.pdf', 'I');

 ?>
