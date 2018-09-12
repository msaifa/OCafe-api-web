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
			$html='<h3>Daftar User </h3>
			<br/>
			tanggal : '.$date.'
			<br/>
			<br/>
					<table bgcolor="#666666" border="1px" cellpadding="4">
					<thead>
						<tr bgcolor="#ffffff">
							<th>No</th>
							<th>ID User</th>
							<th>Nama </th>
							<th>Email</th>
							<th>Level</th>
							<th>Status</th>
						</tr>
						</thead>';
			foreach ($isi as $row)
				{
					if ($row->status == 1) {
						$ss = "Aktif";
					}else {
						$ss = "Belum aktif";
					}
					if ($row->level == 1) {
						$l = "Juragan";
					}else {
						$l = "Pegawai";
					}
					$i++;
					$html.='<tr bgcolor="#ffffff">
							<td align="center">'.$i.'</td>
							<td>'.$row->id_user.'</td>
							<td>'.$row->nama_user.'</td>
							<td>'.$row->email_user.'</td>
							<td>'.$l.'</td>
							<td>'.$ss.'</td>
						</tr>';
				}
			$html.='</table>';
			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->Output('LaporanUser_'.$date.'.pdf', 'I');

 ?>
