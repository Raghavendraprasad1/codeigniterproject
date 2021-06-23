<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Export_excel extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('export_excel');
    }

    // Export to Excel
    public function get_excel_report()
    {
        $result = $this->db->get('users')->result_array();

        $timestamp = time();
        $filename = 'Export_excel_' . $timestamp . '.xls';

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");

        $isPrintHeader = false;
        foreach ($result as $row) {

            if (!$isPrintHeader) {
                echo implode("\t", array_keys($row)) . "\n";
                $isPrintHeader = true;
            }
            echo implode("\t", array_values($row)) . "\n";
        }
        exit();
    }

    // export as csv file.
    public function array2csv($array)
    {
        if (count($array) == 0) {
            return null;
        }
        ob_start(); // buffer 
        $df = fopen("php://output", 'w');
        fputcsv($df, array_keys(reset($array)));
        foreach ($array as $row) {
            fputcsv($df, $row);
        }
        fclose($df);
        return ob_get_clean();
    }

    public function download_send_headers($filename)
    {
        // disable caching
        $now = gmdate("D, d M Y H:i:s");
        header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Last-Modified: {$now} GMT");

        // force download
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");

        // disposition / encoding on response body
        header("Content-Disposition: attachment;filename={$filename}");
        header("Content-Transfer-Encoding: binary");
    }

    public function get_csv_report()
    {
        $result = $this->db->get('users')->result_array();

        $this->download_send_headers("data_export_" . date("Y-m-d") . ".csv");
        echo $this->array2csv($result);
        die();
    }
}
