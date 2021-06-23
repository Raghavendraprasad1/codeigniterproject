<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Form_validate extends CI_Controller
{
    private $data_array = array();
    public function __construct()
    {
        parent::__construct();
        $this->load->model('general_model');
    }

    public function index()
    {
        $this->data_array['user_ids'] = $this->general_model->getAllUserId();
        // print_r($this->data_array['user_ids']);die;
        $this->load->view('user_form', $this->data_array);
    }

    public function save_user()
    {
        $request = $this->input->post();
        $request = $this->security->xss_clean($request);
        if (empty($request['id'])) {
            // insert case
            unset($request['id']);
            $result = $this->general_model->insert_record($request);
            if ($result) {
                $this->session->set_flashdata("success", "this user saved successfully");
            } else {
                $this->session->set_flashdata("error", "this user not saved");
            }

            $this->load->view('user_listing', $this->data_array);
        } else {
            // update case
            $id = $request['id'];
            unset($request['id']);
            $result = $this->general_model->update_record($request, $id);
            if ($result) {
                $this->session->set_flashdata("success", "record updated successfully");
            } else {
                $this->session->set_flashdata("error", "this user not updated");
            }
            $this->load->view('user_listing', $this->data_array);
        }

        // }
    }

    public function get_user_to_edit()
    {
        $user_id = base64_decode($this->input->get('id'));
        $this->data_array['user_ids'] = $this->general_model->getAllUserId();

        // echo $user_id;die;
        $this->data_array['user_details'] = $this->general_model->get_user_by_id($user_id);
        // print_r($this->data_array['user_details']);die;
        $this->load->view('user_form', $this->data_array);
    }

    public function delete_user()
    {
        $user_id = base64_decode($this->input->get("id"));

        $result = $this->db->delete("employee", array("id" => $user_id));
        if ($result) {
            $this->session->set_flashdata("success", "this user deleted successfully");
        } else {
            $this->session->set_flashdata("error", "this user not deleted ");
        }
        // echo $user_id;die;
        // $this->data_array['user_ids'] = $this->general_model->getAllUserId();

        $this->load->view('user_listing', $this->data_array);

    }

    public function user_listing()
    {
        $this->load->view('user_listing', $this->data_array);
    }

    public function get_users()
    {
        $postData = $this->input->post();
        $result = $this->general_model->get_users($postData);
        echo json_encode($result);
    }
}
