<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class PromoEnd extends CI_Controller {
    public function index()
    {
        if (!APP_ACTIVE)
			show_404();

        $this->load->view("home/end");
    }        
}