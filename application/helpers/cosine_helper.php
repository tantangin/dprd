<?php
function cosineSimilarity($tokensA, $tokensB)
{
    $a = $b = $c = 0;
    $uniqueMergedTokens = array_merge($tokensA, $tokensB);
    $x2 = 0;
    $y2 = 0;
    $xArray = array();
    $yArray = array();
    $address = 0;

    $nilaiAtas = 0;
    $x = $y = 0;

    print_r("<table border=1 padding=2><thead><tr><td>Token</td><td>X</td><td>Y</td></tr></thead><tbody>");
    foreach ($uniqueMergedTokens as $token => $v) {
        $xArray[$address] = isset($tokensA[$token]) ?  $tokensA[$token] : 0;
        $yArray[$address] = isset($tokensB[$token]) ?  $tokensB[$token] : 0;

        // menghitung nilai atas
        $nilaiAtas += ($xArray[$address] * $yArray[$address]);
        $ax = ($xArray[$address] * $xArray[$address]);
        $ay = ($yArray[$address] * $yArray[$address]);
        $x += $ax;
        $y += $ay;
        print_r("<tr><td>$token </td><td>" . $xArray[$address] . "</td><td>" . $yArray[$address] . "</td></tr>");
        $address++;
    }
    print_r("</tbody>");
    print_r("<tfoot><tr><td>Akar (a*a) </td><td>" . sqrt($x) . "</td><td>" . sqrt($y) . "</td></tfoot>");
    print_r("</table>");
    $nilaiBawah = (sqrt($x) * sqrt($y));
    $hasil = $nilaiAtas / $nilaiBawah;
    print_r("Nilai Atas  = " . $nilaiAtas . "</br>");
    print_r("Nilai Bawah = " . $nilaiBawah . "</br>");
    print_r("Hasilnya    = " . $hasil . "</br></br>");
    return $hasil;
}

function lblString($array = [])
{
    $str = '';
    foreach ($array as $val) {
        $str .= strval($val['label']) . ' ';
    }
    return $str;
}
