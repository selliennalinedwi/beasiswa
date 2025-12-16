<?php
if (!function_exists('terbilang')) {
    function terbilang($angka)
    {
        $angka = abs((int)$angka);
        $baca = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];
        $hasil = "";

        if ($angka < 12) {
            $hasil = $baca[$angka];
        } elseif ($angka < 20) {
            $hasil = $baca[$angka - 10] . " belas";
        } elseif ($angka < 100) {
            $hasil = $baca[floor($angka / 10)] . " puluh";
            if ($angka % 10 != 0) {
                $hasil .= " " . terbilang($angka % 10);
            }
        } elseif ($angka < 200) {
            $hasil = "seratus";
            if ($angka > 100) {
                $hasil .= " " . terbilang($angka - 100);
            }
        } elseif ($angka < 1000) {
            $hasil = $baca[floor($angka / 100)] . " ratus";
            if ($angka % 100 != 0) {
                $hasil .= " " . terbilang($angka % 100);
            }
        } elseif ($angka < 2000) {
            $hasil = "seribu";
            if ($angka > 1000) {
                $hasil .= " " . terbilang($angka - 1000);
            }
        } elseif ($angka < 1000000) {
            $hasil = terbilang(floor($angka / 1000)) . " ribu";
            if ($angka % 1000 != 0) {
                $hasil .= " " . terbilang($angka % 1000);
            }
        } elseif ($angka < 1000000000) {
            $hasil = terbilang(floor($angka / 1000000)) . " juta";
            if ($angka % 1000000 != 0) {
                $hasil .= " " . terbilang($angka % 1000000);
            }
        } elseif ($angka < 1000000000000) {
            $hasil = terbilang(floor($angka / 1000000000)) . " miliar";
            if ($angka % 1000000000 != 0) {
                $hasil .= " " . terbilang($angka % 1000000000);
            }
        }

        return trim($hasil);
    }
}

