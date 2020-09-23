<?php 

class m_biblio extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function obt_acervo()
    {
        $qry = "";

        $qry = "
        SELECT
        l.consecutivo,
        l.titulo,
        a.nombre as autor,
        l.edicion,
        e.editorial,
        c.categoria,
        i.idioma,
        s.soporte,
        l.estatus,
        u.ubicacion
        FROM Tb_Libros l 
        LEFT JOIN Tb_Cat_Autores a ON a.id = l.autor
        LEFT JOIN Tb_Cat_Editoriales e ON e.id_editorial = l.editorial
        LEFT JOIN Tb_Cat_SoporteLibros s ON s.id_soporte = l.soporte
        LEFT JOIN Tb_Cat_categoriasLibros c ON c.id_categoria = l.categoria
        LEFT JOIN Tb_Cat_IdiomaLibros i ON i.id_idioma = l.idioma
        LEFT JOIN Tb_Cat_UbicacionLibros u ON u.id_ubicacion = l.ubicacion
        WHERE 1
        ORDER BY l.consecutivo ASC";

        return $this->db->query($qry)->result();
    }

    function obt_libroConsecutivo($busqueda)
    {
        $qry = "";

        $qry = "
        SELECT
        l.consecutivo,
        l.titulo,
        a.nombre as autor,
        l.edicion,
        e.editorial,
        c.categoria,
        i.idioma,
        s.soporte,
        l.estatus,
        u.ubicacion
        FROM Tb_Libros l 
        LEFT JOIN Tb_Cat_Autores a ON a.id = l.autor
        LEFT JOIN Tb_Cat_Editoriales e ON e.id_editorial = l.editorial
        LEFT JOIN Tb_Cat_SoporteLibros s ON s.id_soporte = l.soporte
        LEFT JOIN Tb_Cat_categoriasLibros c ON c.id_categoria = l.categoria
        LEFT JOIN Tb_Cat_IdiomaLibros i ON i.id_idioma = l.idioma
        LEFT JOIN Tb_Cat_UbicacionLibros u ON u.id_ubicacion = l.ubicacion
        WHERE l.consecutivo = $busqueda";

        return $this->db->query($qry)->row();
    }

    function obt_categorias()
    {
        return $this->db->get('Tb_Cat_categoriasLibros')->result();
    }

    function agregarPedido($pedido)
    {
        $this->db->insert('tb_solicitudPedidos', $pedido);
    }

    function revisa_libro($libro)
    {
        $this->db->where('libro', $libro);
        $this->db->where('pedido', 0);
        return $this->db->get('tb_solicitudPedidos')->num_rows();
    }

    function quitar_pedido($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tb_solicitudPedidos');
    }

    function obt_Pedido()
    {
        $qry = "";

        $qry = "
        SELECT
        p.id,
        l.consecutivo,
        l.titulo,
        a.nombre as autor,
        l.edicion,
        e.editorial,
        c.categoria,
        i.idioma,
        s.soporte,
        l.estatus,
        u.ubicacion
        FROM Tb_Libros l 
        INNER JOIN tb_solicitudPedidos p
        LEFT JOIN Tb_Cat_Autores a ON a.id = l.autor
        LEFT JOIN Tb_Cat_Editoriales e ON e.id_editorial = l.editorial
        LEFT JOIN Tb_Cat_SoporteLibros s ON s.id_soporte = l.soporte
        LEFT JOIN Tb_Cat_categoriasLibros c ON c.id_categoria = l.categoria
        LEFT JOIN Tb_Cat_IdiomaLibros i ON i.id_idioma = l.idioma
        LEFT JOIN Tb_Cat_UbicacionLibros u ON u.id_ubicacion = l.ubicacion
        WHERE p.pedido = 0
        AND p.libro = l.consecutivo";

        return $this->db->query($qry)->result();
    }

  
}
