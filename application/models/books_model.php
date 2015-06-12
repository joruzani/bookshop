<?php
class Books_model extends CI_Model{

    public function __construct(){

        $this->load->database();
    }

    public function get_books(){

        $this->db->select('*');
        $this->db->from('book');
        $this->db->join('book_has_author', 'book.id_book = book_has_author.book_id_book');
        $this->db->join('author', 'book_has_author.author_id_author = author.id_author');
        $query = $this->db->get();
        return $query->result_array();

    }

    public function get_authors(){
        $query = $this->db->get('author');
        return $query->result();
    }

    public function edit_book($id){
        $this->load->helper('url');
        
        $bdata = [ 'title'       => $this->input->post('title'),
                  'publication' => $this->input->post('publication'),
                  'price'       => $this->input->post('price'),
                  'image_url'   => $this->input->post('imageUrl')
              ];

        $adata = [ 'author_id_author'   => $this->input->post('author')];

        $this->db->where('id_book', $id); 
        if($this->db->update('book', $bdata)){
            $this->db->where('book_id_book', $id); 
            if($this->db->update('book_has_author', $adata)){
                return redirect('/index.php/catalog');
            }
        }

    }
    
    public function set_books(){
        $this->load->helper('url');
        
        $bdata = ['title'       => $this->input->post('title'),
                  'publication' => $this->input->post('publication'),
                  'isbn'        => $this->input->post('isbn'),
                  'price'       => $this->input->post('price'),
                  'image_url'   => $this->input->post('imageUrl')
              ];

        if($this->db->insert('book', $bdata)){
            $insert_id = $this->db->insert_id();
            $adata = [ 'author_id_author'   => $this->input->post('author'),
                       'book_id_book'       => $insert_id ];
            
            if($this->db->insert('book_has_author', $adata)){
                return redirect('/index.php/catalog/create');
            }
        }
    }




}
