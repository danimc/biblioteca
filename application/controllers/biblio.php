<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Biblio extends CI_Controller {
	
	 function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('m_seguridad',"",TRUE);
		$this->load->model('m_usuario',"",TRUE);
		$this->load->model('m_ticket',"",TRUE);
		$this->load->model('m_biblio', "", TRUE);
	}

	public function index()
	{
		
    }
    
    function acervo()
    {
        $head['title'] = "ACERVO DE LA OFICINA DEL ABOGADO GENERAL";
        $datos['libros'] = $this->m_biblio->obt_acervo();

        $this->load->view('_encabezado1', $head);
        $this->load->view('_menuLateral1');
        $this->load->view('listas/l_acervo', $datos);
        $this->load->view('_footer1');
        

    }

}
