<?php
function data_mes($data){
	$NewData = explode('-', $data); 
	
    switch($NewData[1]) {
                     case 1:  $mes = "janeiro";   break;
                     case 2:  $mes = "fevereiro"; break;
                     case 3:  $mes = "mar&ccedil;o";     break;
                     case 4:  $mes = "abril";     break;
                     case 5:  $mes = "maio";      break;
                     case 6:  $mes = "junho";     break;
                     case 7:  $mes = "julho";     break;
                     case 8:  $mes = "agosto";    break;
                     case 9:  $mes = "setembro";  break;
                     case 10: $mes = "outubro";   break;
                     case 11: $mes = "novembro";  break;
                     case 12: $mes = "dezembro";  break;
    }
	
	$dataOk = $NewData[2].'-'.$mes.'-'.$NewData['0'];
	return $dataOk;
}

function mes($data)
{
    $NewData = explode('-', $data); 
    
    switch($NewData[1]) {
                     case '01':  $mes = "Janeiro";   break;
                     case '02':  $mes = "Fevereiro"; break;
                     case '03':  $mes = "Mar&ccedil;o";     break;
                     case '04':  $mes = "Abril";     break;
                     case '05':  $mes = "Maio";      break;
                     case '06':  $mes = "Junho";     break;
                     case '07':  $mes = "Julho";     break;
                     case '08':  $mes = "Agosto";    break;
                     case '09':  $mes = "Setembro";  break;
                     case '10': $mes = "Outubro";   break;
                     case '11': $mes = "Novembro";  break;
                     case '12': $mes = "Dezembro";  break;
    }
    
    $dataOk = $mes;
    return $dataOk;
}
function dia($data)
{
	$NewData = explode('-', $data);
	$dataOk = $NewData[2].'-'.$NewData[1].'-'.$NewData['0']; 
	return $dataOk;
}

function somenteData($data)
{
	$NewDataHora = explode(' ', $data);
	$NewData = explode('-', $NewDataHora[0]);
	$dataOk = $NewData[2].'-'.$NewData[1].'-'.$NewData['0']; 
	return $dataOk;
}

function horas($horas)
{
	$Horas = explode(':', $horas);
	$horasOk = $Horas[0].'h '.$Horas[1]; 
	return $horasOk;
}

function formata_data($data)
{
 $data = explode('-', $data);
 $data = $data[2].'/'.$data[1].'/'.$data[0];
 return $data;
}

function dataSQL($data)
{
 $data = explode('/', $data);
 $data = $data[2].'-'.$data[1].'-'.$data[0];
 return $data;
}

   #soma de data
 function SomarDia($dia){
    $newData = date("Y-m-d", strtotime("+".$dia." days"));
    return $newData;
 }

 #soma de data
function SomarDia2($dia, $data){
  $newData = date("Y-m-d", strtotime("+".$dia." days", strtotime($data)));
  return $newData;
}
 
   #soma de mes
 function SomarMes($mes){
    $newData = date("Y-m-d", strtotime("+".$mes." month"));
    return $newData;
 }
 
   #soma de mes
 function SomarAno($ano){
    $newData = date("Y-m-d", strtotime("+".$ano." year"));
    return $newData;
 }
 
 
   #soma de data
 function SomarData($dia, $mes, $ano){
    $newData = date("Y-m-d", strtotime("+".$ano." year ".$mes." month" .$dia." days "));
    return $newData;
 }
?>