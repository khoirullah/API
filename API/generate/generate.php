<?php 
function klob($tabel,$pk)
{
    $con = mysqli_connect('localhost', 'root', '', 'eztudia_com');
	$query = "SELECT `ID`, `user_login` FROM `tb_extuser` ORDER BY `ID` DESC";
	$hasil = mysqli_query($con,$query) or die(mysqli_error());
	$record = mysqli_fetch_array($hasil);
	if(empty($record['user_login']))
	{
		$no_reg = 'KLOB1';
	}
	else
	{
		$subno_reg = 0;
		$no_reg = $record['user_login'];
        $subno_reg += 1;
        $no_reg = 'KLOB'.$subno_reg;
	}
	return $no_reg;
}
?>