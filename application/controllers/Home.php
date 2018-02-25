<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
class Home extends CI_Controller 
{

	public function __construct() {
		parent::__construct();
		//load model
		$this->load->model('users_model','modelusers');
    }

	public function index() {   
		//show the firts topics
		$data['admin'] = '0';
		$data['year'] = date("Y");

		//views for index
		$this->load->view('includes/header', $data);
		$this->load->view('home', $data);
		$this->load->view('includes/footer', $data);
	}

	//login
	public function login() {
		//set the rules for the inputs
		$this->load->library('form_validation');
		$this->form_validation->set_rules('user','Usuário', 'required|min_length[3]|max_length[30]');
		$this->form_validation->set_rules('password','Senha', 'required|min_length[3]|max_length[30]');

		//if has error, show to the user
		if ($this->form_validation->run() == FALSE) {
			$data['errors'] = validation_errors();
			$this->load->view('commons/formError', $data);
		} else {
			$user = $this->input->post('user');
			$senha = $this->input->post('password');
			//check the user in bd
			$userLogged = $this->modelusers->login($user,$senha);
			if ($userLogged) {
			//if exists, set the sessions
				foreach($userLogged as $user) {
					//set the data of user in the session
					$dataSession['admin'] = true;
					$dataSession['nameAdmin'] = $user->name;
					$dataSession['id'] = $user->id;
					$this->session->set_userdata($dataSession);
				}
				//redirect to the contact
				?>
				<script>
					setTimeout(function(){location.href = '<?php echo base_url('contact') ?>'},700);;
				</script>
				<?php

			} else {
				//if not exists, set null for the sessions
				$dataSession['admin'] = null;
				$dataSession['nameAdmin'] = null;
				$dataSession['id'] = null;
				$this->session->set_userdata($dataSession);

				$data['errors'] = 'Usuário ou senha inválido(s).';
				$this->load->view('commons/formError', $data);
			}
		}
	}

	//logout from the admin
	public function logout() {
		//set null for the sessions
		$dataSession['admin'] = null;
		$dataSession['nameAdmin'] = null;
		$dataSession['id'] = null;
		$this->session->set_userdata($dataSession);
		redirect(base_url());
	}
}
?>