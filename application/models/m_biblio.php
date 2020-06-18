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

  
}
