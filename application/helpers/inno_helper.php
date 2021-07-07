<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

defined('INNO_CREDENTIAL')      or define('INNO_CREDENTIAL', 'innomarket');
defined('INNO_SCREET')          or define('INNO_SCREET', md5(INNO_CREDENTIAL));
defined('INNO_SESSION')         or define('INNO_SESSION', "INNO_SESSION");

//? FOR AUTH
defined('LEVEL_ADMIN')          or define('LEVEL_ADMIN', 1);
defined('LEVEL_SUPER_ADMIN')    or define('LEVEL_SUPER_ADMIN', 0);
defined('LEVEL_SUPER_FOOD')     or define('LEVEL_SUPER_FOOD', 2);
defined('LEVEL_DRIVER')         or define('LEVEL_DRIVER', 2);

//? FOR TRANSAKSI !! JANGAN DI GANTI !!
defined('BELUM_DIPROSES')       or define('BELUM_DIPROSES', 0);
defined('SEDANG_DIPROSES')      or define('SEDANG_DIPROSES', 1);
defined('SELESAI_TERKIRIM')     or define('SELESAI_TERKIRIM', 2);
defined('DIBATALKAN')           or define('DIBATALKAN', 3);
defined('DIANTAR')              or define('DIANTAR', 4);
defined('DITOLAK')              or define('DITOLAK', 5);
defined('DISPOSISI')            or define('DISPOSISI', 6);

//? FOR NOTIFICATION
defined('KEY_FCM')              or define('KEY_FCM', "AAAAxC0GrxE:APA91bFEd8jdpBGIT5q_Pdl40-xi4seLsm-HNT5Fk0K76gu-5ohI8QgGRj-isXWdb8NsLBxfN8luScOgU_E8BKuuVsdTHuhYNptoXbIVmr1L6Ojsd2CRKR3wnVFOeM1-1lcxk1wLxXwT");

//? FOR DEFAULT FOTO
defined('FOTO_DEFAULT')         or define('FOTO_DEFAULT', asset("img/doomu_smile.png"));

function sendPushNotification($fields)
{

    $url = 'https://fcm.googleapis.com/fcm/send';
    $headers = array(
        'Authorization: key=' . KEY_FCM,
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

    $result = curl_exec($ch);
    if ($result === FALSE) {
        die('Curl failed: ' . curl_error($ch));
    }

    //TODO : INSERT INTO DATABASE
    $CI = &get_instance();
    $CI->load->model("Notifikasi_model", "notifikasi");
    $dataInsertNotif = [
        "id_user"               => isset($fields["data"]["id_user"]) ? $fields["data"]["id_user"] : null,
        "personal_id"           => isset($fields["data"]["personal_id"]) ? $fields["data"]["personal_id"] : null,
        "title_notifikasi"      => isset($fields["data"]["title"]) ? $fields["data"]["title"] : null,
        "message_notifikasi"    => isset($fields["data"]["message"]) ? $fields["data"]["message"] : null,
        "image_notifikasi"      => isset($fields["data"]["image"]) ? $fields["data"]["image"] : null,
        "sendto_notifikasi"     => $fields["to"],
    ];
    $CI->notifikasi->insert($dataInsertNotif);

    curl_close($ch);
    return $result;
}

function _getKode()
{
    $CI = &get_instance();
    $CI->load->model("User_model", "user");
    $kode = strtoupper(generator(6));
    $cek = $CI->user->where(["ref_code" => $kode])->get();
    return $cek ?  _getKode() : $kode;
}
