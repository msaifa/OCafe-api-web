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
			$html='<h3>Daftar Barang </h3>
			<br/>
			tanggal : '.$date.'
			<br/>
			<br/>
					<table bgcolor="#666666" border="1px" cellpadding="4">
					<thead>
						<tr bgcolor="#ffffff">
							<td>No</td>
							<td>Nama Produk</td>
							<td>Deskripsi</td>
							<td>Jenis</td>
							<td>Stok</td>
							<td>Ket</td>
							<td>Harga Beli</td>
							<td>Harga Jual</td>
						</tr>
						</thead>';
			foreach ($isi as $row)
				{
					$i++;
					$html.='<tr bgcolor="#ffffff">
							<td align="center">'.$i.'</td>
							<td>'.$row->barang.'</td>
							<td>'.$row->deskripsi.'</td>
							<td>'.$row->jenis.'</td>
							<td>'.$row->stok.'</td>
							<td>'.$row->ket.'</td>
							<td >Rp '.number_format($row->harga_beli,0,",",",").'</td>
							<td >Rp '.number_format($row->harga_jual,0,",",",").'</td>
						</tr>';
				}
			$html.='</table>';
			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->Output('LaporanBarang_'.$date.'.pdf', 'I');

 ?>
