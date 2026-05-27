<?php

function rupiah($angka)
{

    $hasil_rupiah = "Rp. " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}

function truncateString($string)
{
    $string = (strlen($string) > 40) ? substr($string,0,40).'...' : $string;

    return $string;
}

function indonesianDateFormat($tanggal)
{
    if ($tanggal == null || $tanggal == '') {
        return  '-';
    } else {
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );

        $pecahkan = explode('-', $tanggal);

        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun

        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }
}

function calculatePercentage($total, $value)
{
    if ($total == 0) {
        return 0;
    }

    $percentage = ($value / $total) * 100;
    return round($percentage);
}

function dataPaging($totalData, $current_page, $limit)
{
    $dataPaging = array();
    $dataPaging['total_page'] = ceil($totalData / $limit);
    $dataPaging['limit'] = $limit;
    $dataPaging['current_page'] = $current_page;
    return $dataPaging;
}

function truncate($string, $length, $dots = "...") {
    return (strlen($string) > $length) ? substr($string, 0, $length - strlen($dots)) . $dots : $string;
}
