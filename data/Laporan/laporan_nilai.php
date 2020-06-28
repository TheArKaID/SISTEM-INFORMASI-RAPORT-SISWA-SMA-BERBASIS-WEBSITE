<?php
require 'functions.php';

	
$content = '
<style>
.content{
    font-family: "Times New Roman", Times, serif;
}
.tabel { border-collapse:collapse; }
.tabel th { padding:8px 5px; font-size:16;}
.tabel td { padding:8px 5px; font-size:14;}

img {
  float : left;	
}

.judul {
 text-align: center;
 
}

</style>
';	

$content .= '
<page>
	<div class="judul" style="padding:4mm; border:0px solid;">
	<span style="float:left"><img src="logo.jpg" alt="logo" width="90"></span>
		<span style="font-size:25px;">SMA NEGERI 2 DOGIYAI</span><br/>
		<span style="font-size:15px;">Kecamatan Mapia, Kabupaten Dogiyai, Provinsi Papua</span><br/>
		<span style="font-size:12px;">Jln. Trans Papua Nabire-Enarotali Km. 184</span>
	</div>
	<hr>
	<div style="padding:20px 0 10px 0; font-size:15;">
		Laporan Data Nilai Siswa
	</div>

<table border="1px" class="tabel">
	
    <tr>
      <th scope="col" class="text-center">NO</th>
      <th scope="col" class="text-center">ID_Nilai</th>
      <th scope="col" class="text-center">Nis</th>
	  <th scope="col" class="text-center">Nama Siswa</th>
	  <th scope="col" class="text-center">Kelas</th>
	  <th scope="col" class="text-center">Tahun Ajaran</th>
	  <th scope="col" class="text-center">Mata Pelajaran</th>
	  <th scope="col" class="text-center">Tgs 1</th>
	  <th scope="col" class="text-center">Tgs 2</th>
	  <th scope="col" class="text-center">Tgs 3</th>
	  <th scope="col" class="text-center">UTS</th>
	  <th scope="col" class="text-center">UAS</th>
	  <th scope="col" class="text-center">Nilai Rata-rata</th>
	</tr>';
	 
	  $i = 1;
	      
	   
	  if (@$_POST['cetak_data']){ 
			
			$kelas = $_POST['kelas'];
			$thn_ajar = $_POST['thn_ajar'];
		  
		$nilai = query("SELECT * FROM tb_nilai
					INNER JOIN tb_siswa ON tb_nilai.nis = tb_siswa.nis
					INNER JOIN tb_kelas ON tb_nilai.id_kelas = tb_kelas.id_kelas
	        		 WHERE  
					 nama_kelas like '%$kelas%' AND
		             tahun_ajaran like '%$thn_ajar%'");
			
		} else {
			
			$nilai = query("SELECT * FROM tb_nilai
					INNER JOIN tb_siswa ON tb_nilai.nis = tb_siswa.nis
					INNER JOIN tb_kelas ON tb_nilai.id_kelas = tb_kelas.id_kelas
						");
	  
	  }
	  
	  
     foreach ($nilai as $row):  
	$content .= '
	<tr>
	  
	  <td class="text-center">'. $i .'</td>
      <td class="text-center">'. $row ["id_nilai"] .'</td>
	  <td class="text-center">'. $row ["nis"] .'</td>
	  <td class="text-center">'. $row ["nama_siswa"] .'</td>
	  <td class="text-center">'. $row ["nama_kelas"] .'</td>
	  <td class="text-center">'. $row ["tahun_ajaran"] .'</td>
	  <td class="text-center">'. $row ["mapel"] .'</td>
	  <td align="center">'. $row ["tgs1"] .'</td>
	  <td align="center">'. $row ["tgs2"] .'</td>
	  <td align="center">'. $row ["tgs3"] .'</td>
	  <td align="center">'. $row ["uts"] .'</td>
	  <td align="center">'. $row ["uas"] .'</td>
	  <td align="center">'. $row ["rata"] .'</td>
	
    </tr>';
	$i++;
	endforeach; 
	 
	
	
	
  
$content .='
</table>

</page>';

require_once('../../build/html2pdf/html2pdf.class.php');
$html2pdf = new HTML2PDF('l','Legal','en');
$html2pdf->WriteHTML($content);
$html2pdf->Output('exemple.pdf');
?>