<?php
defined('BASEPATH') or exit('no direct script access allowed');

class Unlink_image extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('general_model');
    }

    public function index()
    {
        $this->load->view('user_form');
    }

    public function unlink_img()
    {
        $request = $this->input->post();
        // print_r($request);die;
        $iId = 1;
        $arr = array(
            "vName" => $request['vName'],
            "vEmail" => $request['vEmail'],
            "vPassword" => $request['vPassword'],
            "vCity" => $request['vCity'],
        );
        // new code
        if (!empty($_FILES['vProfilePicture']['name'])) {
            $type = explode("/", $_FILES['vProfilePicture']['type']);
            $_FILES['vProfilePicture']['name'] = "profile_picture_" . time() . "." . $type[1];

            $config = [
                'upload_path' => FCPATH . 'assets/images/',
                'allowed_types' => 'jpg|png|jpeg',
                'max_size' => 10000,
            ];
            $this->load->library('upload');
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("vProfilePicture")) {
                echo $this->upload->display_errors();
            }
            $data_img = $this->upload->data();

            // echo "raghav";
            $arr["vProfilePicture"] = $data_img['file_name'];
            
            $user_arr = $this->db->get_where("employee", array("id" => $iId))->row_array();
            $Old_image = $user_arr['vProfilePicture'];
            // echo $Old_image;
            if (!empty($Old_image)) {
                unlink(FCPATH . 'assets/images/' . $Old_image);
            }
            // print_r($arr);die;
        }
        $result = $this->general_model->update_data($arr, $iId);
        if ($result) {

            echo "<script>alert('Image successfully unlink from folder')</script>";
        }
        $this->load->view("user_form");
    }

}
