<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Biblio extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('m_seguridad', "", TRUE);
        $this->load->model('m_usuario', "", TRUE);
        $this->load->model('m_ticket', "", TRUE);
        $this->load->model('m_biblio', "", TRUE);
    }

    public function index()
    {
    }

    function prestamo()
    {
        $head['title'] = "NUEVO PRESTAMO";
        //$datos['categorias']    = $this->m_biblio->obt_categorias();
        $codigo = $this->session->userdata("codigo");
        $datos['usuario'] = $this->m_usuario->obt_usuario($codigo);
        $datos['reportantes'] = $this->m_ticket->obt_lista_usuarios();
        // $datos['libros']        = json_encode($this->m_biblio->obt_acervo());   

        $this->load->view('_encabezado1', $head);
        $this->load->view('_menuLateral1');
        $this->load->view('formularios/v_nuevo_prestamo', $datos);
        $this->load->view('_footer1');
    }

    function acervo()
    {
        $head['title'] = "ACERVO DE LA OFICINA DEL ABOGADO GENERAL";
        $datos['categorias']    = $this->m_biblio->obt_categorias();
        $datos['libros']        = $this->m_biblio->obt_acervo();

        $this->load->view('_encabezado1', $head);
        $this->load->view('_menuLateral1');
        $this->load->view('listas/l_acervo', $datos);
        $this->load->view('_footer1');
    }

    public function obt_libro()
    {
        $busqueda = $this->input->get('busqueda');
        $respuesta = $this->m_biblio->obt_libroConsecutivo($busqueda);

        echo json_encode($respuesta);
    }

    function agregarPedido()
    {
        $libro = $this->input->post('libro');

        $consulta = $this->m_biblio->revisa_libro($libro);
       
        if ($consulta == 0) {
            $pedido = array(
                'pedido'        => 0,
                'libro'         => $libro,
                'fecha'         => $this->m_ticket->fecha_actual(),
                'capturista'    => $this->session->userdata('codigo')
            );

            $this->m_biblio->agregarPedido($pedido);

            echo json_encode("listo");
        } else {
            echo json_encode("el ejemplar ya se encuentra en la lista");
        }
    }

    function quitar_pedido()
    {
        $id = $this->input->post('id');
        $this->m_biblio->quitar_pedido($id);

        echo json_encode("eliminado");
    }

    function guardarPedido()
    {
        $usuario = $this->input->post('usr');
       ############## PARA CONTINUAR MAÑANA
  
    }

    function obtPedido()
    {
        $pedido = $this->m_biblio->obt_Pedido();
        echo json_encode($pedido);
    }
}
