<?php defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

    /**
     *  data ke tampilan view
     */
    public $data;
    public $menu;

    public $time_lock;

    /**
     * Constructor 
     */
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model("tbl");
        $this->load->model("aspirasi_m");
        $this->apply_setting();
    }


    function apply_setting()
    {
        // set Class
        // set method
        // set id1
        // set id2
        $folder = APPPATH . "controllers/";
        for ($i = 1; $i < 7; $i++) {
            for ($a = $i; $a <= $i; $a++) {
                $class = $folder . ucwords($this->uri->segment($i)) . ".php";
                if (file_exists($class)) {
                    $this->data['page'] = [
                        'url' => 'http://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"],
                        'id' => $this->uri->segment($i + 2),
                        'id2' => $this->uri->segment($i + 3),
                        'description' => "Ini adalah Description Default, Selamat datang.!",
                        'submenu' => "Ini Adalah contoh Menu active",
                        'before' => [],
                        'title' => "Controller  " . $this->uri->segment($i) . ", Dengan Method " . $this->uri->segment($i + 1)
                    ];
                    break;
                } else {
                    $folder .= $this->uri->segment($i) . "/";
                }
            }
        }
    }
}


/**
 *
 * Admin Controller
 */
class Admin_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $response = is_login();
        $role_id = $this->session->userdata('role_id');
        if (!$response->status) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-with-icon" data-notify="container"><i class="fa fa-volume-up" data-notify="icon"></i><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-times-circle"></i></button><span data-notify="message">Menu yang anda akses sebelumnya dilarang!</span></div>');
            redirect('admin/auth');
        }

        // setting role
        $this->load->model('admin/menu_m');
        $this->data['menu_all'] = $this->menu_m->getMenuRoleId()->result_array();

        // $hak_akses = $this->menu_m->role()->num_rows();
        // die(var_dump($hak_akses));
        $hak_akses = false;

        $submenu = $this->menu_m->userAccess()->result_array();
        if (!$submenu) {
            $hak_akses = true;
        } else
            foreach ($submenu as $row) {
                ($row['role_id'] == $role_id) ? ($hak_akses = true) : ("");
            }
        if ($hak_akses) {
            $url = $this->data['page']['url'];
            $this->session->set_userdata('url', $url);
            if (time() >= (int) $this->session->userdata('time')) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-with-icon" data-notify="container"><i class="fa fa-volume-up" data-notify="icon"></i><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-times-circle"></i></button><span data-notify="message">Menu yang anda akses sebelumnya dilarang!</span></div>');
                redirect('admin/auth/lock');
            }
        } else {
            redirect('admin/user/blocked');
        }
        $this->data['user'] = $response->user;
        $this->user_model->setFieldTable($this->data['user']);
        $this->file_model->setFieldTable($this->data['user']);
    }
}
class Publik_Controller extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
    }
}
