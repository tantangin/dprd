<?php


function is_active($class, $method = 'index')
{
    $ci = get_instance();
    if ($class == $ci->router->fetch_class() && $method == $ci->router->fetch_method()) {
        return "active";
    } else return "";
}


function is_access($role_id, $menu_id)
{
    $back =  false;
    $ci = get_instance();
    $ci->db->where('role_id', $role_id);
    $ci->db->where('menu_id', $menu_id);
    $result = $ci->db->get('tbl_user_access_menu');
    if ($result->num_rows() > 0) {
        $back = true;
    }
    return $back;
}

//pesan aksi
function hasilCUD($message = "Sukses.!")
{

    $response = ['status' => false, 'message' => $message];
    $ci = get_instance();
    if ($ci->db->affected_rows() < 1) {
        $response['message'] = ($ci->db->error()['message'] == "") ? "Data Utama pada tabel tidak Berubah" : $ci->db->error()['message'];
    } else
        $response['status'] = true;
    return (object) $response;
}

function cetak($str)
{
    echo htmlentities($str, ENT_QUOTES, 'UTF-8');
}


function toDownload($link, $name = "download")
{
    $ci = get_instance();
    // $link = str_replace(" ", '%20', $link);
    if (is_file(FCPATH . $link)) {
        $ci->load->helper('download');
        return force_download($link, null);
    } else {
        $ci->session->set_flashdata('message', "<div class='mb-5 alert alert-danger' role='alert'>GAgal Download.!</div>");
    }
}
function toDelete($link)
{
    unlink($link);
}


// cek login user
/**
 * jika tidak ada parameter maka dianggar yang login adalah admin
 * jika dikirim parameter role id maka di cek apakah ada atau tidak di user
 * yang sedang login,jika tidak ada dikembalikan nilai false. 
 */
function is_login($roleId = null)
{
    $msg =  response("Inisialisasi");
    $ci = &get_instance();
    $email = $ci->session->userdata('email');
    if ($email) {
        $user = $ci->user_model->cekUser($email)->row_array();
        if ($user) {
            $msg->message = "user Ditemukan";
            $msg->user = $user;
            $ci->user_model->setFieldTable($user);
            $ci->aspirasi_m->setFieldTable($user);
            if (!$roleId) {
                $msg->status = true;
                $ci->session->set_userdata('admin_login');
            }
            if ($roleId == $user['role_id']) {
                $ci->session->set_userdata('masyarakat_login', true);
                $msg->status = true;
                $msg->message  = "User Punya Hak Akses";
            } else {
                $msg->message = "user Tidak dizinkan";
            }
        } else $msg->message  = "user Tidak Ditemukan";
    }
    return $msg;
}

/**
 * mengecek user dengan role id, jika ditemukan 
 * akan dikemabilkan nilai true, dan sebaliknya jika
 * tidak ditemukan maka False, Berlaku  di method/controller
 */
function isAccess($role_id = 100)
{
    $ci = &get_instance();
    $eks = $ci->db->get_where("tbl_user", ['role_id' => $role_id]);
    if ($eks->num_rows() > 0) {
        return true;
    }
    return false;
}

/**
 * membaca folder dalam folder yang dipilih
 */
function bacaFolder($folder)
{
    if (!($buka_folder = opendir($folder)))
        die("eRorr... Tidak bisa membuka Folder");
    $file_array = array();
    while ($baca_folder = readdir($buka_folder)) {
        if (substr($baca_folder, 0, 1) != '.') {
            $file_array[] =  $baca_folder;
        }
    }
    return $file_array;
}

/**
 * mengembalikan nilai response dari hasil eksekusi
 */
function response($status = false, $msg = null, $data = '')
{

    $response = [
        'status' => is_string($status) ? false : $status,
        'message' => is_string($status) ? $status : $msg,
        "data" => $data
    ];
    return (object) $response;
}


/**
 * Mengirim balik notifikasi flash data
 * jika Parameter 1 bertipe strin maka dikembalikan type succes(1)
 * dan message nya akan di ambil dari parameter $type yang dikirimkan
 */
function setNotif($type = 1, $message = null)
{
    if (is_string($type)) {
        $message = $type;
        $type = 1;
    }
    switch ($type) {
        case 0 || false:
            $typName = "danger";
            break;
        case 2:
            $typName = "primary";
            break;
        default:
            $typName = "success";
            break;
    }
    $msg = null;
    if (is_array($message)) {
        foreach ($message as $key) {
            $msg .= $key . "</br>";
        }
    } elseif (is_string($message)) {
        $msg = $message;
    }


    $ci = &get_instance();
    $ci->session->set_flashdata('message', "<div class='mb-5 alert alert-{$typName}' role='alert'>{$msg}.!</div>");
}



// db helper

/**
 * cek some one in other tables
 * return true or false  tergantung eksekusi
 * and other message dan data, jika di temukan data
 */

function cekInAccessKomisi($id_user)
{
    $ci = &get_instance();
    $ci->db->select("*");
    $ci->db->from("web_komisi");
    $ci->db->join("web_komisi_user", "web_komisi_user.komisi_id=web_komisi.id_komisi");
    $ci->db->where("web_komisi_user.user_id", $id_user);
    $eks = $ci->db->get()->row_array();
    return $eks;
}
