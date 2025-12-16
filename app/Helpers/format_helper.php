<?php

function cleanRupiah(string $val): float
{
    $number = preg_replace('/[^\d,]/', '', $val);
    $number = str_replace(',', '.', $number);
    return (float) $number;
}
    
function format_waktu($datetime, $format = 'd-m-Y H:i') {
    return date($format, strtotime($datetime));
}
