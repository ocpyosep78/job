<?php

class home extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$segments = $this->uri->segments;
		$is_company_link = is_company_link();
		
		if ($is_company_link) {
			preg_match('/(\d+)$/i', $_SERVER['REQUEST_URI'], $macth);
			$company_id = (isset($macth[1])) ? $macth[1] : 0;
			if (empty($company_id)) {
				$this->load->view( 'website/home' );
			} else {
				$company = $this->Company_model->get_by_id(array( 'id' => $company_id ));
				$this->load->view( 'website/company', array( 'company' => $company ));
			}
		}
		
		// page
		else if (isset($segments[1]) && !empty($segments[1])) {
			// access admin page
			if (in_array($segments[1], array('seeker', 'company', 'editor'))) {
				if ($segments[1] == 'seeker') {
					header("Location: ".base_url('seeker/resume'));
				} else if ($segments[1] == 'company') {
					header("Location: ".base_url('company/post'));
				} else if ($segments[1] == 'editor') {
					header("Location: ".base_url('editor/home'));
				}
				exit;
			}
			
			if (method_exists($this, $segments[1])) {
				$this->$segments[1]();
			}
			else {
				// check company
				$vacancy = array();
				$company = $this->Company_model->get_by_id(array( 'alias' => $segments[1] ));
				
				// check vacancy
				if (!empty($segments[2])) {
					$temp = explode('_', $segments[2], 2);
					$vacancy = $this->Vacancy_model->get_by_id(array( 'id' => $temp[0] ));
				}
				
				// check rss
				preg_match('/rss$/i', $_SERVER['REQUEST_URI'], $match);
				$is_rss = (!empty($match[0])) ? true : false;
				
				if (count($vacancy) > 0 && @$segments[3] == 'quick') {
					$this->load->view( 'website/listing_quick', array( 'vacancy' => $vacancy ) );
				} else if (count($vacancy) > 0) {
					$this->load->view( 'website/listing_detail', array( 'vacancy' => $vacancy ) );
				} else if (count($company) > 0 && $is_rss) {
					// collect data
					$param_vacancy['company_id'] = $company['id'];
					$param_vacancy['publish_date'] = $this->config->item('current_datetime');
					$param_vacancy['vacancy_status_id'] = VACANCY_STATUS_APPROVE;
					$param_vacancy['sort'] = '[{"property":"id","direction":"DESC"}]';
					$param_vacancy['limit'] = 25;
					$array_vacancy = $this->Vacancy_model->get_array($param_vacancy);
					$array_article = array();
					foreach ($array_vacancy as $item) {
						$array_article[] = array( 'title' => $item['nama'], 'link' => $item['vacancy_link'], 'desc' => $item['content'] );
					}
					
					$rss_param['link'] = $company['company_link_rss'];
					$rss_param['title'] = 'Dunia Karir - '.$company['nama'].' - RSS';
					$rss_param['array_item'] = $array_article;
					$rss_param['description'] = 'Dunia Karir - '.$company['nama'].' - RSS';
					$this->load->view( 'website/common/rss', $rss_param );
				} else if (count($company) > 0) {
					$this->load->view( 'website/company', array( 'company' => $company ));
				}
			}
		}
		
		// index
		else {
			$this->load->view( 'website/home' );
		};
    }
	
	function blog() {
		preg_match('/blog\/([a-z0-9\-\_]+)$/i', $_SERVER['REQUEST_URI'], $match);
		$alias = (empty($match[1])) ? '' : $match[1];
		
		// check rss
		preg_match('/rss$/i', $_SERVER['REQUEST_URI'], $match);
		$is_rss = (!empty($match[0])) ? true : false;
		
		// article
		$article = $this->Article_model->get_by_id(array( 'alias' => $alias ));
		
		if ($is_rss) {
			// collect item
			$param_blog = array(
				'article_status_id' => ARTICLE_PUBLISH,
				'publish_date' => $this->config->item('current_datetime'),
				'sort' => '[{"property":"publish_date","direction":"DESC"}]',
				'limit' => 20
			);
			$array_article = array();
			$array_temp = $this->Article_model->get_array($param_blog);
			foreach ($array_temp as $item) {
				$array_article[] = array( 'title' => $item['nama'], 'link' => $item['article_link'], 'desc' => $item['desc_short'] );
			}
			
			$rss_param['link'] = base_url('blog/rss');
			$rss_param['title'] = 'Dunia Karir - Blog - RSS';
			$rss_param['array_item'] = $array_article;
			$rss_param['description'] = 'Dunia Karir - Blog - RSS';
			$this->load->view( 'website/common/rss', $rss_param );
		} else if (count($article) == 0) {
			$this->load->view( 'website/blog' );
		} else {
			$this->load->view( 'website/blog_detail', array( 'article' => $article ) );
		}
	}
	
	function event() {
		preg_match('/event\/([a-z0-9\-\_]+)$/i', $_SERVER['REQUEST_URI'], $match);
		$alias = (empty($match[1])) ? '' : $match[1];
		
		// check rss
		preg_match('/rss$/i', $_SERVER['REQUEST_URI'], $match);
		$is_rss = (!empty($match[0])) ? true : false;
		
		// event
		$event = $this->Event_model->get_by_id(array( 'alias' => $alias ));
		
		
		if ($is_rss) {
			// collect item
			$param_event = array(
				'publish_date' => $this->config->item('current_datetime'),
				'filter' => '[' .
					'{"type":"numeric","comparison":"gt","value":"'.date("Y-m-d").'","field":"Event.waktu"},' .
					'{"type":"numeric","comparison":"not","value":"'.date("Y-m-d").'","field":"DATE(Event.waktu)"}' .
				']',
				'sort' => '[{"property":"waktu","direction":"ASC"}]',
				'limit' => 20
			);
			$array_article = array();
			$array_temp = $this->Event_model->get_array($param_event);
			foreach ($array_temp as $item) {
				$array_article[] = array( 'title' => $item['nama'], 'link' => $item['event_link'], 'desc' => $item['content'] );
			}
			
			$rss_param['link'] = base_url('event/rss');
			$rss_param['title'] = 'Dunia Karir - Event - RSS';
			$rss_param['array_item'] = $array_article;
			$rss_param['description'] = 'Dunia Karir - Event - RSS';
			$this->load->view( 'website/common/rss', $rss_param );
		} else if (count($event) == 0) {
			$this->load->view( 'website/event' );
		} else {
			$this->load->view( 'website/event_detail', array( 'event' => $event ) );
		}
	}
	
	function path() {
		// check alias
		preg_match('/path\/([a-z0-9\-\_]+)$/i', $_SERVER['REQUEST_URI'], $match);
		$alias = (empty($match[1])) ? '' : $match[1];
		
		// check rss
		preg_match('/rss$/i', $_SERVER['REQUEST_URI'], $match);
		$is_rss = (!empty($match[0])) ? true : false;
		
		// article
		$article = $this->Article_model->get_by_id(array( 'alias' => $alias ));
		
		if ($is_rss) {
			$request_uri = $_SERVER['REQUEST_URI'];
			$request_uri = preg_replace('/\/rss$/i', '', $request_uri);
			$temp = preg_replace('/.+path\/?/i', '', $request_uri);
			$array_temp = explode('/', $temp);
			
			// check kategori
			$kategori = $this->Kategori_model->get_by_id( array( 'alias' => @$array_temp[0] ) );
			$subkategori = $this->Subkategori_model->get_by_id( array( 'alias' => @$array_temp[1] ) );
			
			$title = 'Dunia Karir - Jobs - RSS';
			$base_link = base_url('path/rss');
			if (count($kategori) > 0) {
				$title = 'Dunia Karir - Jobs - '.$kategori['nama'].' - RSS';
				$base_link = $kategori['link_rss'];
			}
			if (count($subkategori) > 0) {
				$title = 'Dunia Karir - Jobs - '.$kategori['nama'].' - '.$subkategori['nama'].' - RSS';
				$base_link = $subkategori['link_rss'];
			}
			
			// collect item
			$param_vacancy = array(
				'vacancy_status_id' => VACANCY_STATUS_APPROVE,
				'publish_date' => $this->config->item('current_datetime'),
				'kategori_id' => @$kategori['id'],
				'subkategori_id' => @$subkategori['id'],
				'sort' => '[{"property":"publish_date","direction":"DESC"}]',
				'limit' => 20
			);
			$array_article = array();
			$array_temp = $this->Vacancy_model->get_array($param_vacancy);
			foreach ($array_temp as $item) {
				$array_article[] = array( 'title' => $item['nama'], 'link' => $item['vacancy_link'], 'desc' => $item['content_short'] );
			}
			
			$rss_param['link'] = $base_link;
			$rss_param['title'] = $title;
			$rss_param['array_item'] = $array_article;
			$rss_param['description'] = $title;
			$this->load->view( 'website/common/rss', $rss_param );
		} else if (count($article) == 0) {
			$this->load->view( 'website/jobs' );
		} else {
			$this->load->view( 'website/jobs_detail', array( 'article' => $article ) );
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
	
	function search() {
		$this->load->view( 'website/listing' );
	}
	
	function tags() {
		$this->load->view( 'website/tags' );
	}
	
	function ajax() {
		$this->load->library('phpmailer');
		
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
				$type = 'seeker';
				$model_name = 'Seeker_model';
				$link = base_url('seeker/resume');
			} else if ($action == 'login_company') {
				$type = 'company';
				$model_name = 'Company_model';
				$link = base_url('company/home');
			} else if ($action == 'login_editor') {
				$model_name = 'Editor_model';
				$link = base_url('editor/home');
			}
			
			$user = $this->$model_name->get_by_id(array('email' => $_POST['email']));
			if (isset($user['is_active']) && empty($user['is_active'])) {
				$link_validasi = base_url('login?request=validation&type='.$type.'&email='.$_POST['email']);
				$result['message'] = 'Harap men-validasi email untuk mengaktifkan user anda, klik link <a href="'.$link_validasi.'">berikut</a> jika anda belum menerima email.';
				echo json_encode($result);
				exit;
			} else if (count($user) == 0 || empty($_POST['email'])) {
				$result['message'] = 'user anda tidak ditemukan.';
				echo json_encode($result);
				exit;
			} else if (isset($user['is_disable']) && $user['is_disable'] == 1) {
				$result['message'] = 'Maaf user anda sedang tidak aktif, silahkan menghubungi admin untuk mengaktifkan kembali.';
				echo json_encode($result);
				exit;
			} else if (EncriptPassword($_POST['passwd']) != $user['passwd']) {
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
			} else if (isset($user['is_disable']) && $user['is_disable'] == 1) {
				$result['message'] = 'Maaf user anda sedang tidak aktif, silahkan menghubungi admin untuk mengaktifkan kembali.';
				echo json_encode($result);
				exit;
			}
			
			$reset = EncriptPassword($user['id'].'-'.time());
			$this->$model_name->update(array( 'id' => $user['id'], 'reset' => $reset ));
			$link_reset = base_url('login?reset='.$reset);
			
			// mail
			$param['to'] = $user['email'];
			$param['title'] = 'Reset Password';
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
				$validation = substr(md5(time().rand(1000,999)), 0, 20);
				
				$_POST['passwd'] = EncriptPassword($_POST['passwd']);
				$_POST['validation'] = $validation;
				$user = $this->$model_name->update($_POST);
				
				$link_validation = base_url('login?validation='.$validation);
				$param_mail['to'] = $_POST['email'];
				$param_mail['title'] = 'Account Validation';
				$param_mail['message'] = 'Silahkan klik link berikut untuk mengaktifkan user anda.<br />'.$link_validation;
				sent_mail($param_mail);
				
				// add seeker no
				if ($model_name == 'Seeker_model') {
					$this->Seeker_model->update_no($user);
				}
				
				$result['status'] = true;
				$result['message'] = 'Registrasi anda berhasil, silahkan memeriksa email anda.';
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
		else if ($action == 'sent_vacancy') {
			$vacancy = $this->Vacancy_model->get_by_id(array( 'id' => $_POST['vacancy_id'] ));
			$content = $this->load->view( 'seeker/email/quick_apply', array( 'post' => $_POST ), true );
			
			// attachemnt
			$attach = array();
			if (!empty($_POST['file_resume'])) {
				$attach[] = $this->config->item('base_path').'/static/upload/'.$_POST['file_resume'];
			}
			
			// Sent Email
			$MailParam = array(
				'EmailTo' => $vacancy['email_apply'],
				'EmailFrom' => 'noreply@parapekerja.com',
				'EmailFromName' => 'Para Pekerja',
				'EmailSubject' => $vacancy['nama'],
				'EmailBody' => $content,
				'Attachment' => $attach
			);
			$result = SmtpMailer($MailParam);
			$result['status'] = ($result['success']) ? true : false;
			$result['message'] = ($result['status']) ? 'Lamaran anda berhasil dikirim' : 'Lamaran anda gagal dikirim';
			
			// add seeker
			$this->Vacancy_model->update_seeker(array( 'id' => $_POST['vacancy_id'] ));
		}
		else if ($action == 'subscribe') {
			$subscribe = $this->Subscribe_model->get_by_id(array( 'email' => $_POST['email'], 'jenis_subscribe_id' => $_POST['jenis_subscribe_id'] ));
			
			// set data
			$_POST['status'] = 1;
			if (count($subscribe) > 0) {
				$_POST['id'] = $subscribe['id'];
			}
			
			// update
			$result = $this->Subscribe_model->update($_POST);
		}
		else if ($action == 'apply') {
			$seeker = $this->Seeker_model->get_session();
			$vacancy = $this->Vacancy_model->get_by_id(array( 'id' => $_POST['vacancy_id'] ));
			
			if ($vacancy['vacancy_submit_via'] == VACANCY_SUBMIT_VIA_LINK) {
				$result['redirect'] = true;
				$result['redirect_link'] = $vacancy['link_apply'];
				echo json_encode($result);
				exit;
			}
			
			// set data
			$_POST['seeker_id'] = $seeker['id'];
			$_POST['apply_date'] = $this->config->item('current_datetime');
			$_POST['apply_status_id'] = APPLY_STATUS_OPEN;
			
			$attach[] = $seeker['photo_path'];
			$attach[] = $seeker['file_resume_path'];
			$apply_vacancy = $this->Widget_model->get_by_id(array( 'alias' => 'apply_vacancy' ));
			$content = $this->load->view( 'seeker/email/lamaran', array( 'seeker' => $seeker, 'content' => $apply_vacancy['content'] ), true );
			
			// Sent Email
			$MailParam = array(
				'EmailTo' => $vacancy['email_apply'],
				'EmailFrom' => 'noreply@parapekerja.com',
				'EmailFromName' => 'Para Pekerja',
				'EmailSubject' => $vacancy['nama'],
				'EmailBody' => $content,
				'Attachment' => $attach
			);
			$result = SmtpMailer($MailParam);
			$result['status'] = ($result['success']) ? true : false;
			
			// check
			$is_apply = $this->Apply_model->is_apply(array( 'seeker_id' => $_POST['seeker_id'], 'vacancy_id' => $_POST['vacancy_id'] ));
			if ($is_apply) {
				$result['status'] = true;
				$result['message'] = 'Anda sudah melamar lowongan ini.';
			} else {
				// add seeker
				$this->Vacancy_model->update_seeker(array( 'id' => $_POST['vacancy_id'] ));
				
				// add apply
				$result = $this->Apply_model->update($_POST);
				if ($result['status']) {
					$result['message'] = 'Surat lamaran anda berhasil dikirim.';
				}
			}
		}
		
		echo json_encode($result);
	}
}