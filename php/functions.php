<?php 
date_default_timezone_set('America/Manaus');

function tempoDecorrido($dttm) {
    $timeIni = strtotime(date("Y-m-d H:i:s"));
    $timeFin = strtotime($dttm);
    $diferenca = $timeIni - $timeFin;
    $tempoDec = (int) floor($diferenca);
    //return $tempoDec;
    if($tempoDec<60){
        return "Agora há pouco";
    }else if($tempoDec<3600){
        return "há ".round($tempoDec/60)." min";
    }else if($tempoDec<86400){
        return "há ".round($tempoDec/3600)." hora(s)";
    }else{
        return "há ".round($tempoDec/86400)." dia(s)";
    }
}

function getDiaDaSemana($ts) {
    $data = date("l", $ts);
    if ($data == "Friday")
        return "sexta-feira";
    if ($data == "Saturday")
        return "sábado";
    if ($data == "Sunday")
        return "domingo";
    if ($data == "Monday")
        return "segunda-feira";
    if ($data == "Tuesday")
        return "terça-feira";
    if ($data == "Wednesday")
        return "quarta-feira";
    if ($data == "Thursday")
        return "quinta-feira";
}

function getMes($t){
    //Converte a data do parâmetro para o formato "mês"
    $data= date_format(date_create($t),'M');

    if($data=="Jan")    return "Janeiro";
    if($data=="Feb")    return "Fevereiro";
    if($data=="Mar")    return "Março";
    if($data=="Apr")    return "Abril";
    if($data=="May")    return "Maio";
    if($data=="Jun")    return "Junho";
    if($data=="Jul")    return "Julho";
    if($data=="Aug")    return "Agosto";
    if($data=="Sep")    return "Setembro";
    if($data=="Oct")    return "Outubro";
    if($data=="Nov")    return "Novembro";
    if($data=="Dez")    return "Dezembro";

}

function getDiaCompleto($t){
    $dia= date_format(date_create($t),'d');
    $mes= getMes($t);
    $ano= date_format(date_create($t),'Y');

    return $dia." de ".$mes." de ".$ano;
}

function getHora($t){
    $hora=date_format(date_create($t),'H');
    $minuto=date_format(date_create($t),'i');
    return $hora.":".$minuto;
}