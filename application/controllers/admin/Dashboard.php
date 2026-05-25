<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Core_Controller.php');

class Dashboard extends Core_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
{
    $auth       = $this->session->userdata('_auth');
    $permission = isset($auth['admin_permission']) ? (int)$auth['admin_permission'] : null;

    if (empty($auth)) {
        redirect(auth_url('login'));
        return;
    }
    $this->setPageData([
        'title'     => 'dashboard',
        'menu_slug' => 'dashboard',
        'script'    => '',
        'content'   => 'page_dashboard',
    ]);
    $this->load->view('admin/index', $this->_data);
}
}
