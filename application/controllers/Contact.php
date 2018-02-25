<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
class Contact extends CI_Controller 
{

	public function __construct() {
		parent::__construct();
		//load the model of contacts
		$this->load->model('contacts_model','modelcontacts');
	}
	
	//check the user was logged
	public function checkAdmin() {
		//if it is not logged, redirect to the index
		if (!$this->session->userdata('admin')) {
			$dataSession['admin'] = null;
			$dataSession['nameAdmin'] = null;
			$dataSession['id'] = null;
			$this->session->set_userdata($dataSession);
			redirect(base_url());
			return false;
		}

		return true;
	}

	public function index() {   
		//check if the user was logged
		if($this->checkAdmin()) {
			//set the parameters for the view
			$data['title'] = 'Contatos';
			$data['subTitle'] = 'Pendentes';

			//don´t show the firts topics
			$data['admin'] = '1';
			$data['year'] = date("Y");

			//set the contacts and the data for the chart
			$data['contacts'] = $this->modelcontacts->getList(0);
			$data['chart'] = $this->modelcontacts->newContacts();

			//load date helper
			$this->load->helper('date');

			//views for index
			$this->load->view('includes/header', $data);
			$this->load->view('contacts', $data);
			$this->load->view('includes/footer', $data);
		}
	}

	public function verified() {   
		//check if the user was logged
		if($this->checkAdmin()) {
			//set the parameters for the view
			$data['title'] = 'Contatos';
			$data['subTitle'] = 'Verificados';

			//don´t show the firts topics
			$data['admin'] = '1';
			$data['year'] = date("Y");

			//set the contacts and the data for the chart
			$data['contacts'] = $this->modelcontacts->getList(1);
			$data['chart'] = $this->modelcontacts->newContacts();

			//load date helper
			$this->load->helper('date');

			//views for index
			$this->load->view('includes/header', $data);
			$this->load->view('contacts', $data);
			$this->load->view('includes/footer', $data);
		}
	}
	
	//insert Contact
	public function insert() {

		//set the rules for the inputs
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email','Email', 'required|min_length[3]|max_length[60]|is_unique[contacts.email]');
		$this->form_validation->set_rules('name','Nome', 'required|min_length[3]|max_length[60]');
		$this->form_validation->set_rules('message','Mensagem', 'max_length[255]');

		//if has error, show to the user
		if ($this->form_validation->run() == FALSE) {
			$data['errors'] = validation_errors();
			$this->load->view('commons/formError', $data);
		} else {
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$message = $this->input->post('message');
			$date = date("Y-m-d H:i:s");
			
			if ($this->modelcontacts->insert($name,$email,$message,$date)) {
				$data['success'] = 'Contato cadastrado com sucesso! Aguarde e novas informações serão enviadas para o seu email.';
				$this->load->view('commons/formSuccess', $data);
			} else {
				$data['errors'] = "Erro interno!";
				$this->load->view('commons/formError', $data);
			}
		}
	}

	//show the form fot edit contact
	public function edit($id) {
		//don´t show the firts topics
		$data['admin'] = '1';
		$data['year'] = date("Y");

		//set the constacts
		$data['contact'] = $this->modelcontacts->contact($id);

		//load date helper
		$this->load->helper('date');

		//views for index
		$this->load->view('includes/header', $data);
		$this->load->view('edit_contacts', $data);
		$this->load->view('includes/footer', $data);
	}

	//function for update a contact
	public function update() {
		//get the parameters for update
		$id = $this->input->post('id');
		$messageUser = $this->input->post('message_user');
		$contacted = $this->input->post('contacted');
		$userId = $this->session->userdata('id');

		if ($this->modelcontacts->update($id,$messageUser,$contacted,$userId)) {
			redirect(base_url('contact'));
		} else {
			echo "Erro Interno!";
		}
	}

	//delete the contact
	public function delete($id) {
		//check if the user was logged
		if($this->checkAdmin()) {
			$this->load->library('user_agent');
			//delete and return to the page
			if($this->modelcontacts->delete($id)){
				 redirect($this->agent->referrer());
			}else {
				echo "Erro interno!";
			}
		}
	}
}
?>