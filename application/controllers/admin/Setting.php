<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Setting extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    function index()
    {
        $this->template->load('admin', 'backend/dashboard', $this->data);
    }
    function getAllUser()
    {
        $list = $this->user_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $log) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $log->nip;
            $row[] = $log->name;
            $row[] = $log->email;
            $row[] = $log->alamat;
            // $row[] = $log->image;
            $row[] = date("d M, Y,  H:i:s A", $log->date);
            $row[] = '<a href="' . base_url('admin/admin/delete/') . $log->nip . '"  class="badge badge-pill badge-primary">Delete</a>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->user_model->count_all(),
            "recordsFiltered" => $this->user_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }







    // CM_show
    function setting()
    {
        $setting = $this->db->get("tbl_setting")->result();
        $validation = $this->form_validation;

        $this->data['setting'] = $setting;
        foreach ($this->data['setting'] as $row) {
            if ($row->name != "web_logo")
                $this->form_validation->set_rules($row->name, $row->name, 'required');
        }

        if ($validation->run()) {
            die(var_dump($this->input->post()));

            foreach ($this->input->post() as $row => $value) {
                $where = ['name' => $row];
                $data = ['title' => $value];

                if ($row == "web_logo") {
                    if (isset($_FILES['web_logo'])) {
                        $logo = $this->db->get_where('tbl_setting', [
                            'name' => "web_logo"
                        ])->row_array();

                        $image = $logo['title'];
                        $config['allowed_types'] = 'gif|jpg|jpeg|png';
                        $config['max_size']      = '2048';
                        $config['upload_path'] = './assets/img/setting/';
                        $this->load->library('upload', $config);
                        if ($this->upload->do_upload('web_logo')) {
                            if ($image != "logo.png") {
                                deleteImg("setting", $image);
                            }
                            $image = $this->upload->data('file_name');
                        }
                        $data = ['title' => $image];
                    }
                }
                $this->setting_m->update($where, $data);
            }

            $this->session->set_flashdata('message', "<div class='mb-5 alert alert-success' role='alert'>Sukses Update Pengaturan .!</div>");
            header("Refresh:0");
        } else {
            die(var_dump($this->form_validation->error_array()));

            $this->data['themes_admin'] = $this->template->bacaFolder('admin');
            $this->data['themes_public'] = $this->template->bacaFolder('public');
            $this->template->load('admin', 'setting', $this->data);
        }
    }

    // CM_delete
    function delete_setting($id)
    {
        $where = ['id_setting' => $id];
        $this->setting_m->delete_setting($where);
        hasilCUD("Sukses Menghapus pengaturan .!");
        redirect(base_url("admin/admin/setting"));
    }
    // CM_insert page
    function add_setting()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('title', 'Judul', 'trim|required');
        if ($this->form_validation->run()) {
            $name = str_replace(" ", "_", $this->input->post('name'));
            $data = [
                'name' => $name,
                'title' => $this->input->post('title'),
                'status' => $this->input->post('status') ? 1 : 0
            ];
            $this->setting_m->add($data);
            hasilCUD("Sukses Menambahkan pengaturan baru.!");
        } else {
            $this->session->set_flashdata('message', "<div class='mb-5 alert alert-danger' role='alert'>Gagal Menambahkan Pengaturan baru .!</div>");
        }
        redirect(base_url("admin/admin/setting"));
    }

    function _setting()
    {
        foreach ($_POST as $key => $value) {
            $where['name'] = htmlspecialchars($key);
            $data['title'] = htmlspecialchars($value);
        }
        $this->setting_model->update($where, $data);
    }
}
