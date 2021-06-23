<?php

class General_model extends CI_Model
{

    public function getAllUserId()
    {
        return $this->db->get('employee')->result();
    }

    public function insert_record($request)
    {
        return $this->db->insert('employee', $request);
    }

    // public function update_data($arr, $iId)
    // {
    //     $this->db->where("id", $iId);
    //     return $this->db->update("employee", $arr);
    // }

    public function get_user_by_id($user_id)
    {
        return $this->db->get_where("employee", array('id' => $user_id))->row();
        // $delta = $this->db->select("*")->from('employee')->where('id', $user_id)->get()->result();
        // print_r($delta);die;
    }
    public function update_record($request, $id)
    {
        $this->db->where("id", $id);
        return $this->db->update("employee", $request);
    }

    // get all user details for listing
    public function get_users($postData = null)
    {

        $response = array();
        ## Reading post values
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['name']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
        ## variable to store data for searching.
        $searchQuery = "";
        if ($searchValue != '') {
            if ($searchValue == 'Active') {
                $searchValue = 'Enabled';
            }
            if ($searchValue == 'Inactive') {
                $searchValue = 'Disabled';
            }
            //    or DATE(usr.dCreatedDate) like'%" . date('Y-m-d H:i:s', strtotime($searchValue)) . "%'
            $searchQuery = " (vName like '%" . $searchValue . "%' or vEmail like '%" . $searchValue . "%' or vMobileNo like'%" . $searchValue . "%' or vCity like'%" . $searchValue . "%' or vPassword like'%" . $searchValue . "%' ) ";
        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->from("employee");
        $query = $this->db->get();
        $records = $query->result();
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        $this->db->from("employee");
        if ($searchQuery != '') {
            $this->db->where($searchQuery);
        }
        $query = $this->db->get();
        $records = $query->result();
        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select("vName,vEmail,vMobileNo,id,vPassword,vCity");
        $this->db->from("employee");

        if ($searchQuery != '') {
            $this->db->where($searchQuery);
        }

        if (!empty($columnName)) {
            $this->db->order_by($columnName, $columnSortOrder);
        } else {
            $this->db->order_by('vName', 'ASC');
        }

        if ($rowperpage != -1) {
            $this->db->limit($rowperpage, $start);
        }
        $query = $this->db->get();
        $records = $query->result();
        // pr($this->db->last_query(),1);
        $data = array();

        $i = $start + 1;
        // loop to iterate and storing data into array accordingly that is going to display.
        foreach ($records as $record) {
            $iUserId = $record->id;

            $actionLinks = ""; // variable to store action link.

            // link to deletion.
            $actionLinks .= "<a href='" . base_url('form_validate/delete_user?id=' . base64_encode($iUserId)) . " '  id='delete-user' href='javascript:void(0)'  class='btn btn-sm btn-flat  btn-danger' title='Delete' >Delete</a> ";
            // }
            // link to edit user
            $actionLinks .= "<a  href='" . base_url('form_validate/get_user_to_edit?id=' . base64_encode($iUserId)) . " ' class='btn btn-sm btn-flat  btn-primary' title='Edit' >Edit</a> ";

            $data[] = array(
                $i++,
                $actionLinks,
                $record->vName,
                $record->vEmail,
                $record->vMobileNo,
                $record->vPassword,
                $record->vCity,
            );
        }

        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data,
            "detail" => [$columnName, $columnSortOrder],
            "detail" => [$columnName, $columnSortOrder],
            "search_query" => $searchQuery,
            "last_query" => $this->db->last_query(),
        );
        // pr($response,1);
        return $response;
    }

}
