<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Manila');
class Notes extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function index(){	
       
		$this->load->view('posts/index');
	}

	public function index_json(){
		$data["notes"] = $this->note->get_all_notes();
		echo json_encode($data);
	}

	public function index_html(){
	  $data["notes"] = $this->note->get_all_notes();
	  $this->load->view("posts/includes/notes", $data);
	}

	// using jquery post
	public function create(){

		$config = array(
			array(
				'field' => 'title',
				'label' => 'Note title',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'note',
				'label' => 'Note Description',
				'rules' => 'trim|required'
			),
			
		);
		$this->form_validation->set_rules($config);
		if($this->form_validation->run() === FALSE){
			$errors = validation_errors('<li>', '</li>');
			$this->session->set_userdata("errors",$errors);
			$this->error_message();
		}else{
			$note_details = array(
				"title" => $this->input->post("title",TRUE),
				"description" => $this->input->post("note",TRUE),
			);
	
			$add_note = $this->note->add_note($note_details);
		}
		
	
		
		$this->index_html();
		
	}

	public function edit_title(){
		$config = array(
			array(
				'field' => 'title',
				'label' => 'Note title',
				'rules' => 'trim|required'
			),
			
		);
		$this->form_validation->set_rules($config);

		if($this->form_validation->run() === FALSE){
			$errors = validation_errors('<li>', '</li>');
			$this->session->set_userdata("errors",$errors);
			$this->error_message();
		}else{
			$note_details = array(
				"title" => $this->input->post("title",TRUE),
				"note_id" => $this->input->post("note_id",TRUE),
			);
			// var_dump($note_details);
			$this->note->edit_title($note_details);
		}


		$this->index_html();
	}


	public function edit_description(){
		$config = array(
			array(
				'field' => 'note',
				'label' => 'Note Description',
				'rules' => 'trim|required'
			),
			
		);
		$this->form_validation->set_rules($config);
		if($this->form_validation->run() === FALSE){
			$errors = validation_errors('<li>', '</li>');
			$this->session->set_userdata("errors",$errors);
			$this->error_message();
		}else{
			$note_details = array(
				"description" => $this->input->post("note",TRUE),
				"note_id" => $this->input->post("note_id",TRUE),
			);
			$this->note->edit_description($note_details);
		}
		
		$this->index_html();
	}

	public function error_message(){
		$data["errors"] = $this->session->userdata("errors");
		$this->load->view("posts/includes/errors",$data);
	}

	public function delete(){
		$this->note->delete_note($this->input->post("note_id"));
		$this->index_html();
	}

   

}




	// public function create(){
	// 	echo "bulaga";

	// 	$note_details = array(
	// 		"title" => $this->input->post("title",TRUE),
	// 		"description" => $this->input->post("note",TRUE),
	// 	);

	// 	$add_note = $this->note->add_note($note_details);

	// 	if($add_note === TRUE){
	// 		$this->session->set_flashdata("add-note-success",'<div class="alert alert-primary">Note has been added successfully</div>');
	// 		redirect(base_url());
	// 	}


	//root
	// <IfModule mod_rewrite.c>
	//     RewriteEngine on
	//     RewriteCond %{REQUEST_FILENAME} !-f
	//     RewriteCond %{REQUEST_FILENAME} !-d
	//     RewriteRule ^(.*)$ index.php?/$1 [L]
	// </IfModule>
	// }