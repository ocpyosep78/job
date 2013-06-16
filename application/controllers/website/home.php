<?php

class home extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$segments = $this->uri->segments;
		
		// page
		if (isset($segments[1]) && !empty($segments[1])) {
			if (in_array($segments[1], array('blog', 'blog_detail', 'event', 'event_detail', 'company', 'listing', 'listing_detail', 'login', 'registrasi', 'ajax'))) {
				$this->$segments[1]();
			}
			
			// check company
			$vacancy = array();
			$company = $this->Company_model->get_by_id(array( 'alias' => $segments[1] ));
			
			// check vacancy
			if (!empty($segments[2])) {
				$temp = explode('_', $segments[2], 2);
				$vacancy = $this->Vacancy_model->get_by_id(array( 'id' => $temp[0] ));
			}
			
			if (count($vacancy) > 0) {
				$this->load->view( 'website/listing_detail', array( 'vacancy' => $vacancy ) );
			} else if (count($company) > 0) {
				$this->load->view( 'website/company', array( 'company' => $company ));
			}
		}
		
		// index
		else {
			$this->load->view( 'website/home' );
		};
    }
	
	function blog() {
		preg_match('/blog\/([a-z0-9\_]+)$/i', $_SERVER['REQUEST_URI'], $match);
		$alias = (empty($match[1])) ? '' : $match[1];
		
		// article
		$article = $this->Article_model->get_by_id(array( 'alias' => $alias ));
		
		if (count($article) == 0) {
			$this->load->view( 'website/blog' );
		} else {
			$this->load->view( 'website/blog_detail', array( 'article' => $article ) );
		}
	}
	
	function event() {
		preg_match('/event\/([a-z0-9\_]+)$/i', $_SERVER['REQUEST_URI'], $match);
		$alias = (empty($match[1])) ? '' : $match[1];
		
		// event
		$event = $this->Event_model->get_by_id(array( 'alias' => $alias ));
		
		if (count($event) == 0) {
			$this->load->view( 'website/event' );
		} else {
			$this->load->view( 'website/event_detail', array( 'event' => $event ) );
		}
	}
	
	function listing() {
		$this->load->view( 'website/listing' );
	}
	
	function login() {
		$this->load->view( 'website/login' );
	}
	
	function registrasi() {
		$this->load->view( 'website/login' );
	}
	
	function ajax() {
		$action = (empty($_POST['action'])) ? '' : $_POST['action'];
		if (isset($_POST['action'])) {
			unset($_POST['action']);
		}
		
		// additional action
		$result = array( 'status' => false );
		preg_match('/ajax\/([a-z0-9]+)/i', $_SERVER['REQUEST_URI'], $match);
		$action = (empty($action) && !empty($match[1])) ? $match[1] : $action;
		
		// login
		if ($action == 'login_seeker' || $action == 'login_company' || $action == 'login_editor') {
			if ($action == 'login_seeker') {
				$model_name = 'Seeker_model';
				$link = base_url('seeker/resume');
			} else if ($action == 'login_company') {
				$model_name = 'Company_model';
				$link = base_url('company/post');
			} else if ($action == 'login_editor') {
				$model_name = 'Editor_model';
				$link = base_url('editor/home');
			}
			
			$user = $this->$model_name->get_by_id(array('email' => $_POST['email']));
			if (count($user) == 0 || empty($_POST['email'])) {
				$result['message'] = 'user anda tidak ditemukan.';
				echo json_encode($result);
				exit;
			}
			if (EncriptPassword($_POST['passwd']) != $user['passwd']) {
				$result['message'] = 'Password tidak sama.';
				echo json_encode($result);
				exit;
			}
			
			$this->$model_name->set_session($user);
			$result['status'] = true;
			$result['link'] = $link;
		}
		
		// reset password
		else if ($action == 'forget_seeker' || $action == 'forget_company') {
			$model_name = ($action == 'forget_seeker') ? 'Seeker_model' : 'Company_model';
			$user = $this->$model_name->get_by_id(array( 'email' => $_POST['email'] ));
			
			if (count($user) == 0) {
				$result['status'] = true;
				$result['message'] = 'Email anda tidak terdaftar';
				echo json_encode($result);
				exit;
			}
			
			$reset = EncriptPassword($user['id'].'-'.time());
			$this->$model_name->update(array( 'id' => $user['id'], 'reset' => $reset ));
			$link_reset = base_url('login?reset='.$reset);
			
			// mail
			$param['to'] = $user['email'];
			$param['message']  = "Berikut link untuk mereset password anda. Harap abaikan email ini jika password yang anda gunakan saat ini sudah benar.\n\n";
			$param['message'] .= $link_reset;
			sent_mail($param);
			
			$result['status'] = true;
			$result['message'] = 'Silahkan memeriksa email anda untuk melakukan reset password.';
		}
		
		// register
		else if ($action == 'register_seeker' || $action == 'register_company') {
			$model_name = ($action == 'register_seeker') ? 'Seeker_model' : 'Company_model';
			$check = $this->$model_name->get_by_id(array( 'email' => $_POST['email'] ));
			if (count($check) == 0) {
				$_POST['passwd'] = EncriptPassword($_POST['passwd']);
				$this->$model_name->update($_POST);
				
				$result['status'] = true;
				$result['message'] = 'Registrasi anda berhasil, silahkan login.';
			} else {
				$result['status'] = false;
				$result['message'] = 'Email sudah memiliki account, tidak bisa digunakan untuk registrasi lagi.';
			}
		}
		
		else if ($action == 'logout') {
			$this->Seeker_model->delete_session();
			$this->Company_model->delete_session();
			$this->Editor_model->delete_session();
			
			header("Location: ".base_url());
			exit;
		}
		else if ($action == 'sent_mail') {
			$email_admin = $this->Widget_model->get_by_id(array( 'alias' => 'email_admin' ));
			$email_admin_clean = html_entity_decode(strip_tags($email_admin['content']));
			
			$_POST['to'] = $email_admin_clean;
			$_POST['message'] = $_POST['message']."<br /><br />From : ".$_POST['email'];
			sent_mail($_POST);
			
			$result['status'] = true;
			$result['message'] = 'Pesan berhasil dikirim';
		}
		
		echo json_encode($result);
	}
}