<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class AdminDashboard extends CI_Controller {
	public function __construct() {
        parent::__construct();
    }

	public function index()
	{
		if (!APP_ACTIVE)
			show_404();

		if (!$this->session->has_userdata("LoginData")) {
            $this->session->set_flashdata("error", "You need to login first before you can access this page.");
        	redirect(base_url()."./login","refresh");
        }

        $pageDetails = array(
            'Title'     => "Dashboard",
            'Function'  => "Admin",
            'Page'      => "Dashboard"
        );

        $user_data = array(
            "Information"   => $this->session->userdata("LoginData")
        );

        $this->load->model('Registration_model', 'registerModel');
        $tileData   = $this->registerModel->GetDashboardTileData();
        $chartData  = $this->registerModel->GetDashboardChartData();

        $pageData = array(
            "TileData"  => $tileData,
            "ChartData" => $chartData
        );

        $data["data"] = array(
            "PageDetails"   => $pageDetails,
            "UserData"      => $user_data,
            "PageData"      => $pageData
        );

        $this->load->view("templates/admin_header", $data);
        $this->load->view("portal/dashboard", $data);
        $this->load->view("templates/admin_footer", $data);
	}

    public function Download() {
        if (!APP_ACTIVE)
            show_404();

        if (!$this->session->has_userdata("LoginData")) {
            $this->session->set_flashdata("error", "You need to login first before you can access this page. Base URL: ".base_url());
            redirect(base_url()."./login","refresh");
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('DateFrom', 'Download Date From', 'trim|required');
        $this->form_validation->set_rules('DateTo', 'Download Date To', 'trim|required');

        try {
            if ($this->form_validation->run() == FALSE) {
                $errorMessage = null;
                $errors = $this->form_validation->error_array();
                if (count($errors) > 1)
                    $errorMessage = implode("<li>", $errors);
                else
                    $errorMessage = $errors;

                $this->session->set_flashdata("error", $errors);
                redirect(base_url()."admin/dashboard", "refresh");
            } else {
                $this->load->model('Registration_model', 'registerModel');
                $result = $this->registerModel->GetRegistrationData();
                if ($result == null) {
                    $this->session->set_flashdata("error", "No data to export.");
                    redirect(base_url()."admin/dashboard", "refresh");
                }

                $spreadsheet = new Spreadsheet(); // instantiate Spreadsheet
                $sheet = $spreadsheet->getActiveSheet();

                $sheet->setCellValue('A1', 'Reference');
                $sheet->getColumnDimension('A')->setWidth(20);
                $sheet->setCellValue('B1', 'Name');
                $sheet->getColumnDimension('B')->setWidth(25);
                $sheet->setCellValue('C1', 'Gender');
                $sheet->getColumnDimension('C')->setWidth(15);
                $sheet->setCellValue('D1', 'DOB');
                $sheet->getColumnDimension('D')->setWidth(15);
                $sheet->setCellValue('E1', 'Email');
                $sheet->getColumnDimension('E')->setWidth(20);
                $sheet->setCellValue('F1', 'Mobile Number');
                $sheet->getColumnDimension('F')->setWidth(20);
                $sheet->setCellValue('G1', 'Home Address');
                $sheet->getColumnDimension('G')->setWidth(30);
                $sheet->setCellValue('H1', 'School');
                $sheet->getColumnDimension('H')->setWidth(20);
                $sheet->setCellValue('I1', 'School Address');
                $sheet->getColumnDimension('I')->setWidth(30);
                $sheet->setCellValue('J1', 'School Representative');
                $sheet->getColumnDimension('J')->setWidth(25);
                $sheet->setCellValue('K1', 'School Contact');
                $sheet->getColumnDimension('K')->setWidth(20);
                $sheet->setCellValue('L1', 'School Email');
                $sheet->getColumnDimension('L')->setWidth(20);
                $sheet->setCellValue('M1', 'Status');
                $sheet->getColumnDimension('M')->setWidth(15);
                $sheet->setCellValue('N1', 'Registration Date');
                $sheet->getColumnDimension('N')->setWidth(20);
                $sheet->setCellValue('O1', 'Process Date');
                $sheet->getColumnDimension('O')->setWidth(20);
                $sheet->setCellValue('P1', 'Remarks');
                $sheet->getColumnDimension('P')->setWidth(15);
                $sheet->getStyle("A1:P1")->getFont()->setBold(true);
                $sheet->getStyle('A1:P1')->getAlignment()->setHorizontal('center');
                $sheet->getStyle('A1:P1')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('000'));

                $cell = 2;
                foreach ($result as $key) {
                    $sheet->setCellValue('A'.$cell, $key["Reference"]);
                    $sheet->setCellValue('B'.$cell, $key["Name"]);
                    $sheet->setCellValue('C'.$cell, $key["Gender"]);
                    $sheet->setCellValue('D'.$cell, $key["DOB"]);
                    $sheet->setCellValue('E'.$cell, $key["Email"]);
                    $sheet->setCellValue('F'.$cell, $key["Mobile"]);
                    $sheet->setCellValue('G'.$cell, $key["Address"]);
                    $sheet->setCellValue('H'.$cell, $key["School"]);
                    $sheet->setCellValue('I'.$cell, $key["SchoolAddress"]);
                    $sheet->setCellValue('J'.$cell, $key["SchoolRep"]);
                    $sheet->setCellValue('K'.$cell, $key["SchoolContact"]);
                    $sheet->setCellValue('L'.$cell, $key["SchoolEmail"]);
                    $sheet->setCellValue('M'.$cell, $key["Status"]);
                    $sheet->setCellValue('N'.$cell, $key["CreateAt"]);
                    $sheet->setCellValue('O'.$cell, $key["UpdateAt"]);
                    $sheet->setCellValue('P'.$cell, $key["Remarks"]);
                    $cell++;
                }

                $writer = new Xlsx($spreadsheet); // instantiate Xlsx
 
                $filename = 'registration-data'; // set filename for excel file to be exported
                header('Content-Type: application/vnd.ms-excel'); // generate excel file
                header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
                header('Cache-Control: max-age=0');
        
                $writer->save('php://output');	// download file
            }
        } catch (Exception $ex) {
            log_message("error", "Exception: ".$ex->getMessage());
            $this->session->set_flashdata("error", $ex->getMessage());
            redirect(base_url()."admin/dashboard", "refresh");
        }
    }
}