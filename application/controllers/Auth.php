<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('authModel', 'auth');
	}

	public function index()
	{
		redirect(auth_url('login'));
	}

	public function password_hash($password)
	{
		return md5($password);
	}

	public function login()
	{
		if (!empty($this->session->userdata('_auth'))) {
			$auth = $this->session->userdata('_auth');
			if ((int)$auth['admin_permission'] === 1) {
				redirect(admin_url());
			} else {
				redirect(admin_url('room'));
			}
		}

		if ($this->input->post()) {
			$user    = $this->input->post('username');
			$pass    = $this->input->post('password');
			$ps_hash = $this->password_hash($pass);

			$log = $this->auth->check_login($user, $ps_hash);
			if ($log) {
				$this->session->set_flashdata('result', 'true');
				$this->session->set_flashdata('message', 'ยินดีต้อนรับ ' . $log['admin_name'] . ' เข้าสู่ระบบ.');
				$this->session->set_userdata('_auth', $log);

				$redirect_url = $this->session->userdata('redirect_after_login');
				if (!empty($redirect_url)) {
					$this->session->unset_userdata('redirect_after_login');
					redirect($redirect_url);
				} else {
					if ((int)$log['admin_permission'] === 1) {
						redirect(admin_url());
					} else {
						redirect(admin_url());
					}
				}
			} else {
				$this->session->set_flashdata('result', 'false');
				$this->session->set_flashdata('message', 'Username หรือ Password ไม่ถูกต้อง.');
				redirect(auth_url('login'));
			}
		}

		$this->load->view('login');
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(auth_url('login'));
	}
}
