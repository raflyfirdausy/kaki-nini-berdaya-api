<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('bulan_romawi')) {
    function bulan_romawi($bulan)
    {
        if ($bulan < 1 or $bulan > 12) return false;
        $bulan_romawi = array(
            1 => "I",
            2 => "II",
            3 => "III",
            4 => "IV",
            5 => "V",
            6 => "VI",
            7 => "VII",
            8 => "VIII",
            9 => "IX",
            10 => "X",
            11 => "XI",
            12 => "XII"
        );
        return ($bulan_romawi[$bulan]);
    }
}

if (!function_exists('bulantahun_surat')) {
    function bulantahun_surat($tanggal)
    {
        $pisah = array_map('intval', explode('/', $tanggal));
        $bulan = array($pisah[0]);
        $tahun = array($pisah[2]);
        $bulanss = implode('', $bulan);
        $tahunfix = implode('', $tahun);
        $bulanfix = bulan_romawi($bulanss);

        $output = '';
        $output .= $bulanfix . ' / ' . $tahunfix . '';

        return $output;
    }
}


if (!function_exists('umur')) {
    function umur($tgl_lahir)
    {
        try {
            $date = new DateTime($tgl_lahir);
        } catch (Exception $e) {
            return null;
        }
        $now      = new DateTime();
        $interval = $now->diff($date);
        return $interval->y;
    }
}

if (!function_exists('bulan')) {
    function bulan($bln)
    {
        $nm = '';
        switch ($bln) {
            case '1':
                $nm = 'Januari';
                break;
            case '2':
                $nm = 'Februari';
                break;
            case '3':
                $nm = 'Maret';
                break;
            case '4':
                $nm = 'April';
                break;
            case '5':
                $nm = 'Mei';
                break;
            case '6':
                $nm = 'Juni';
                break;
            case '7':
                $nm = 'Juli';
                break;
            case '8':
                $nm = 'Agustus';
                break;
            case '9':
                $nm = 'September';
                break;
            case '10':
                $nm = 'Oktober';
                break;
            case '11':
                $nm = 'November';
                break;
            case '12':
                $nm = 'Desember';
                break;
            default:
                $nm = '';
                break;
        }
        return $nm;
    }
}

if (!function_exists('short_bulan')) {
    function short_bulan($bln)
    {
        switch ($bln) {
            case 1:
                return "01";
                break;
            case 2:
                return "02";
                break;
            case 3:
                return "03";
                break;
            case 4:
                return "04";
                break;
            case 5:
                return "05";
                break;
            case 6:
                return "06";
                break;
            case 7:
                return "07";
                break;
            case 8:
                return "08";
                break;
            case 9:
                return "09";
                break;
            case 10:
                return "10";
                break;
            case 11:
                return "11";
                break;
            case 12:
                return "12";
                break;
        }
    }
}

if (!function_exists('medium_bulan')) {
    function medium_bulan($bln)
    {
        switch ($bln) {
            case 1:
                return "Jan";
                break;
            case 2:
                return "Feb";
                break;
            case 3:
                return "Mar";
                break;
            case 4:
                return "Apr";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Jun";
                break;
            case 7:
                return "Jul";
                break;
            case 8:
                return "Ags";
                break;
            case 9:
                return "Sep";
                break;
            case 10:
                return "Okt";
                break;
            case 11:
                return "Nov";
                break;
            case 12:
                return "Des";
                break;
        }
    }
}

//Long date indo Format
if (!function_exists('longdate_indo')) {
    function longdate_indo($tanggal = NULL, $pakaiHari = FALSE)
    {
        $date   = date_create($tanggal);
        $date   = date_format($date, "Y-m-d");
        $ubah = gmdate($date, time() + 60 * 60 * 8);
        $pecah = explode("-", $ubah);
        $tgl = $pecah[2];
        $bln = $pecah[1];
        $thn = $pecah[0];
        $bulan = bulan($pecah[1]);

        $nama = date("l", mktime(0, 0, 0, $bln, $tgl, $thn));
        $nama_hari = "";
        if ($nama == "Sunday") {
            $nama_hari = "Minggu";
        } else if ($nama == "Monday") {
            $nama_hari = "Senin";
        } else if ($nama == "Tuesday") {
            $nama_hari = "Selasa";
        } else if ($nama == "Wednesday") {
            $nama_hari = "Rabu";
        } else if ($nama == "Thursday") {
            $nama_hari = "Kamis";
        } else if ($nama == "Friday") {
            $nama_hari = "Jumat";
        } else if ($nama == "Saturday") {
            $nama_hari = "Sabtu";
        }
        if ($tanggal != null) {
            if ($pakaiHari) {
                return $nama_hari . ', ' . $tgl . ' ' . $bulan . ' ' . $thn;
            } else {
                return $tgl . ' ' . $bulan . ' ' . $thn;
            }
        } else {
            return "";
        }
    }
}

if (!function_exists('datetime_indo')) {
    function datetime_indo($tanggal = NULL, $pakaiHari = FALSE)
    {
        $date   = $tanggal;
        $splitTimeStamp = explode(" ", $date);
        $date = $splitTimeStamp[0];
        $time = $splitTimeStamp[1];
        $ubah = gmdate($date, time() + 60 * 60 * 8);
        $pecah = explode("-", $ubah);
        $tgl = $pecah[2];
        $bln = $pecah[1];
        $thn = $pecah[0];
        $bulan = bulan($pecah[1]);

        $nama = date("l", mktime(0, 0, 0, $bln, $tgl, $thn));
        $nama_hari = "";
        if ($nama == "Sunday") {
            $nama_hari = "Minggu";
        } else if ($nama == "Monday") {
            $nama_hari = "Senin";
        } else if ($nama == "Tuesday") {
            $nama_hari = "Selasa";
        } else if ($nama == "Wednesday") {
            $nama_hari = "Rabu";
        } else if ($nama == "Thursday") {
            $nama_hari = "Kamis";
        } else if ($nama == "Friday") {
            $nama_hari = "Jumat";
        } else if ($nama == "Saturday") {
            $nama_hari = "Sabtu";
        }
        if ($tanggal != null) {
            if ($pakaiHari) {
                return $nama_hari . ',' . $tgl . ' ' . $bulan . ' ' . $thn . ' ' . $time;
            } else {
                return $tgl . ' ' . $bulan . ' ' . $thn . ' ' . $time;
            }
        } else {
            return "";
        }
    }
}

if (!function_exists('bulan_array')) {
    function bulan_array()
    {
        $dataBulan = array(
            [
                "urut" => 1,
                "nama_pendek" => medium_bulan(1),
                "nama_panjang" => bulan(1)
            ],
            [
                "urut" => 2,
                "nama_pendek" => medium_bulan(2),
                "nama_panjang" => bulan(2)
            ],
            [
                "urut" => 3,
                "nama_pendek" => medium_bulan(3),
                "nama_panjang" => bulan(3)
            ],
            [
                "urut" => 4,
                "nama_pendek" => medium_bulan(4),
                "nama_panjang" => bulan(4)
            ],
            [
                "urut" => 5,
                "nama_pendek" => medium_bulan(5),
                "nama_panjang" => bulan(5)
            ],
            [
                "urut" => 6,
                "nama_pendek" => medium_bulan(6),
                "nama_panjang" => bulan(6)
            ],
            [
                "urut" => 7,
                "nama_pendek" => medium_bulan(7),
                "nama_panjang" => bulan(7)
            ],
            [
                "urut" => 8,
                "nama_pendek" => medium_bulan(8),
                "nama_panjang" => bulan(8)
            ],
            [
                "urut" => 9,
                "nama_pendek" => medium_bulan(9),
                "nama_panjang" => bulan(9)
            ],
            [
                "urut" => 10,
                "nama_pendek" => medium_bulan(10),
                "nama_panjang" => bulan(10)
            ],
            [
                "urut" => 11,
                "nama_pendek" => medium_bulan(11),
                "nama_panjang" => bulan(11)
            ],
            [
                "urut" => 12,
                "nama_pendek" => medium_bulan(12),
                "nama_panjang" => bulan(12)
            ],
        );
        return $dataBulan;
    }
}

//Format Shortdate
if (!function_exists('shortdate_indo')) {
    function shortdate_indo($tgl)
    {
        $ubah = gmdate($tgl, time() + 60 * 60 * 8);
        $pecah = explode("-", $ubah);
        $tanggal = $pecah[2];
        $bulan = short_bulan($pecah[1]);
        $tahun = $pecah[0];
        return $tanggal . '/' . $bulan . '/' . $tahun;
    }
}

//Format Shortdate
if (!function_exists('format_tanggal')) {
    function format_tanggal($tgl)
    {
        $ubah = gmdate($tgl, time() + 60 * 60 * 8);
        $pecah = explode("-", $ubah);
        $tanggal = $pecah[2];
        $bulan = $pecah[1];
        $tahun = $pecah[0];
        return $tanggal . '-' . $bulan . '-' . $tahun;
    }
}

if (!function_exists("validateDate")) {
    function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
        return $d && $d->format($format) === $date;
    }
}

if (!function_exists('triwulan')) {
    function triwulan($tanggal = NULL)
    {
        $date   = date_create($tanggal);
        $date   = date_format($date, "Y-m-d");
        $ubah = gmdate($date, time() + 60 * 60 * 8);
        $pecah = explode("-", $ubah);
        $tgl = $pecah[2];
        $bln = $pecah[1];
        $thn = $pecah[0];

        if($bln <= 3){
            return 1;
        } else if($bln <= 6){
            return 2;
        } else if ($bln <= 9){
            return 3;
        } else {
            return 4;
        }
    }
}
