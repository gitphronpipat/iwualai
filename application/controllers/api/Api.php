<?php
defined('BASEPATH') or exit('No direct script access allowed');
// require_once(APPPATH . 'libraries/phpmailer/class.phpmailer.php');

class Api extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('authModel', 'auth');
		$this->load->model('admin/MemberModel', 'member');
	}

	public function index()
	{
		echo 'index';
	}

	public function checkRegisterUsername()
	{
		$username = $this->input->post('username');
		$check_log =  $this->auth->checkRegisterUsername($username);
		if ($check_log) {
			echo json_encode(array('success' => 1, 'ts' => date('YmdHis'), 'i' => $check_log, 'msg' => 'มีข้อมูลในระบบแล้ว'));
		} else {
			echo json_encode(array(
				'success' => 0,
				'ts' => date('YmdHis'),
				'i' => 'Null',
				'msg' => 'not have user'
			));
		}
	}

	public function checkUserMember()
	{
		$username = $this->input->post('username');
		$check_log =  $this->member->checkRegisterUsername($username);
		if ($check_log) {
			echo json_encode(array('success' => 1, 'ts' => date('YmdHis'), 'i' => $check_log, 'msg' => 'มีข้อมูลในระบบแล้ว'));
		} else {
			echo json_encode(array(
				'success' => 0,
				'ts' => date('YmdHis'),
				'i' => 'Null',
				'msg' => 'not have user'
			));
		}
	}

	public function checkEmailMember()
	{
		$email = $this->input->post('email');
		$check_log =  $this->member->checkRegisterEmail($email);
		if ($check_log) {
			echo json_encode(array('success' => 1, 'ts' => date('YmdHis'), 'i' => $check_log, 'msg' => 'มีข้อมูลในระบบแล้ว'));
		} else {
			echo json_encode(array(
				'success' => 0,
				'ts' => date('YmdHis'),
				'i' => 'Null',
				'msg' => 'not have user'
			));
		}
	}

	public function checkCurrentPassMember()
	{
		$CurrentPass = $this->input->post('current_password');
		$check_log =  $this->member->checkCurrentPass($CurrentPass);
		if ($check_log) {
			echo json_encode(array('success' => 0, 'ts' => date('YmdHis'), 'i' => $check_log, 'msg' => 'The password is correct.'));
		} else {
			echo json_encode(array(
				'success' => 1,
				'ts' => date('YmdHis'),
				'i' => 'Null',
				'msg' => 'The password is incorrect.'
			));
		}
	}

	public function sendMail($tpl)
	{
		$formData = [
			'email' => 'asd',
			'fname' => 'ddd',
			'lname' => 'eee',
		];

		$smtp_user = $this->config->item('smtp_sender_name');
		$smtp_email = $this->config->item('smtp_user');
		$smtp_password = $this->config->item('smtp_password');
		$smtp_reply_email = $this->config->item('smtp_user');
		$mail = new PHPMailer();

		$mail->IsSMTP();
		$mail->CharSet = "utf-8";
		$mail->SMTPDebug = 0;
		$mail->SMTPAuth = true;


		$mail->SMTPSecure = $this->config->item('smtp_secure'); // ssl, tls sets the prefix to the service
		$mail->Host = $this->config->item('smtp_host'); // sets GMAIL as the SMTP server
		$mail->Port = $this->config->item('smtp_port');
		$mail->Username = $smtp_email;
		$mail->Password = $smtp_password;

		$mail->SetFrom($smtp_reply_email, $smtp_user);
		$mail->AddReplyTo($smtp_reply_email, $smtp_user);

		$mail->AddAddress($formData['email'], $formData['fname'] . ' ' . $formData['lname']);

		$mail->IsHTML(true);
		$mail->Subject = 'Your Successfull Submission';
		// set atrp mail
		$body = $this->load->view("tpl/" . $tpl, array('_formData' =>  $formData), true);


		// end atrp mail

		$mail->MsgHTML($body);

		if (!$mail->send()) {
		}
	}
}
