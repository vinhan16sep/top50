<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Public_Controller {

    private $_lang = '';

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index(){
        $this->load->view('login_view');

        $this->render('login_view');
    }

}
