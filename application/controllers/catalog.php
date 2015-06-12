<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Catalog extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('books_model');
    }

    public function index(){
		$this->load->view('v_header');
		$this->load->view('v_nav');
		$this->load->view('v_catalog');
        $this->load->view('v_footer');
    }

    public function books(){
        $data['books']=$this->books_model->get_books();
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function edit($id){
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('books_model');

        $this->db->select('*');
        $this->db->from('book');
        $this->db->where('id_book', $id);
        $query = $this->db->get();
        $result = $query->result();

        $data['authors'] = $this->books_model->get_authors();
        $data['book_id'] = $id;
        $data['title'      ] = $result[0]->title;       
        $data['publication'] = $result[0]->publication;
        $data['isbn'       ] = $result[0]->ISBN;      
        $data['price'      ] = $result[0]->price;      
        $data['image_url'  ] = $result[0]->image_url;  

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('author', 'Author', 'required');
        $this->form_validation->set_rules('publication', 'Publication', 'required | callback_validate_date');
        $this->form_validation->set_rules('price', 'Price', 'required');

        if($this->form_validation->run() === FALSE){
		    $this->load->view('v_header');
		    $this->load->view('v_nav');
            $this->load->view('v_edit', $data);
            $this->load->view('v_footer');
        }else {
            $this->books_model->edit_book($id);
        }
    }



    public function create(){
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Create a book item';
        $data['authors'] = $this->books_model->get_authors();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('author', 'Author', 'required');
        $this->form_validation->set_rules('publication', 'Publication', 'required | callback_validate_date');
        $this->form_validation->set_rules('isbn', 'ISBN', 'required|alpha_numeric|trim|max_length[13]');
        $this->form_validation->set_rules('price', 'Price', 'required');
        //$this->form_validation->set_rules('imageUrl', 'Image', 'required');

        if($this->form_validation->run() === FALSE){
		    $this->load->view('v_header');
		    $this->load->view('v_nav');
		    $this->load->view('v_create', $data);
            $this->load->view('v_footer');
        }else {
            $this->books_model->set_books();
        }
    }

    public function validate_date($date){
       $d = DateTime::createFromFormat('Y-m-d', $date);
       return $d && $d->format('Y-m-d') == $date;
    }

}
