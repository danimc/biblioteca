<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<div class="content-wrapper">
    <? if ($this->uri->segment(3) == 'e') {?>
    <div class="col-md-4 alert alert-warning pull-right">
        <p><i class="fa fa-warning"></i> Atención! debe Capturar un usuario valido.</p>
    </div>
    <?}?>
    <!-- Content Header (Page header) -->
    <div class="page-heading">

        <div class="flexbox-b mb-5 page-title">
            <span class="mr-4 static-badge badge-warning"><i class="ti-share"></i></span>
            <div>
                <h5 class="font-strong">Solicitar un nuevo Prestamo</h5>
            </div>
        </div>
        <br>
    </div>



    <form role="form" id="form_newsletter">
        <section class="page-content fade-in-up">
            <div class="row">
                <div class="col-md-5">
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="ibox-title">Datos del Solicitante</div>
                        </div>
                        <div class="ibox-body">
                            <div class="row">
                                <div class="form-group mb-6 col-md-12 ">
                                    <label class="col-sm-12 col-form-label">Usuario: </label>
                                    <div class="col-sm-12">
                                        <select class="form-control selectpicker col-sm-12" id="usrPrestamo" data-live-search="true" name="usrPrestamo">
                                            <option value="<?= $usuario->codigo ?>">
                                                <?= $usuario->usuario ?> => <?= $usuario->nombre_completo ?>
                                            </option>
                                            <? foreach ($reportantes as $reportante) {?>
                                            <option value="<?= $reportante->codigo ?>">
                                                <?= $reportante->usuario ?> => <?= $reportante->nombre_completo ?>
                                            </option>
                                            <?  } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label>Consecutivo</label>
                                    <div class="input-group">
                                        <input type="number" required="true" name="consecutivo" id="consecutivo" class="form-control-sm col-md-3">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-outline-info"><i class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Título</label>
                                    <input type="text" name="titulo" id="titulo" class="form-control">
                                </div>
                                <div id="infoLibro">
                                    <div class="col-md-12 form-group">
                                        <div class="col-md-12">
                                            <b>Autor: </b> <span id="txtAutor"></span>
                                        </div>
                                        <div class="col-md-12">
                                            <b>Editorial: </b> <span id="txtEditorial"></span>
                                        </div>
                                        <div class="col-md-12">
                                            <b>Categoría: </b> <span id="txtCategoria"></span>
                                        </div>
                                        <div class="col-md-12">
                                            <b>Estatus: </b> <span id="txtEstatus"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <a href="#" id="btnAgregar" class="btn btn-block btn-success"> Agregar al pedido </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-md-7">
                    <div class="ibox">
                        <div class="ibox ibox-head">
                            <div class="ibox-title">Libros solicitados</div>
                        </div>
                        <div class="ibox-body">
                            <div class="row">
                                <table class="table table-responsive table-hover">
                                    <tr>
                                        <th> Cons.</th>
                                        <th>Título</th>
                                        <th>Autor</th>
                                        <th>Editorial</th>
                                        <th>Categoria</th>
                                        <th>Acciones</th>
                                    </tr>
                                    <tbody id="pedido">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="ibox-footer">
                            <div class="row">
                                <div class="col">
                                    <a href="#" class="btn btn-danger btn-block col"> Cancelar y borrar prestamo</a>

                                </div>
                                <div class="col">
                                    <a href="#" id="btnRegistrar" class="btn btn-success btn-block col"> Registrar Prestamo</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="ibox-title">

                            </div>
                        </div>
                        <div class="ibox-body">

                        </div>

                    </div>
                </div>

        </section>

        <!-- /.content -->

        <!-- /.content-wrapper -->

        <script>
            $(function() {
                obtPedido();
            })
        </script>

        <script>
            $("#consecutivo").change(function() {
                busqueda = $("#consecutivo").val();
                datos = {
                    busqueda
                };

                $.ajax({
                    type: "GET",
                    dataType: 'json',
                    url: '<?= base_url() ?>index.php/biblio/obt_libro',
                    data: datos,
                }).done(function(respuesta) {
                    llenarDatos(respuesta);
                })
            });

            $("#btnAgregar").click(function() {
                libro = $("#consecutivo").val();
                data = {
                    libro
                };

                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: '<?= base_url() ?>index.php/biblio/agregarPedido',
                    data,
                }).done(function(respuesta) {
                    console.log(respuesta);
                    obtPedido();
                    llenarDatos(falso = '');
                })
            })

            $("#btnRegistrar").click(function() {
                opcion = $('select[name="usrPrestamo"] option:selected').text();
                nombre = opcion.split('>');
                usuario = $("#usrPrestamo").val();
                alertify.confirm("PRESTAR LIBROS", "<p align='center'>va a prestar los libros a <b>" + nombre[1] + "</b> <br> ¿desea continuar?</p>",
                    function() {
                        guardarPedido(usuario);
                        alertify.success('Eliminado');
                    },
                    function() {
                        alertify.error('Cancelado');
                    });                       
            });

            function guardarPedido(usr)
            {
                data = {
                    usr
                };

                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: '<?= base_url() ?>index.php/biblio/guardarPedido',
                    data,
                }).done(function(respuesta) {
                    console.log(respuesta);
                    obtPedido();
                    llenarDatos(falso = '');
                }) 
            }

            function llenarDatos(respuesta) {

                estatus = obt_estatus(respuesta.estatus);

                if (respuesta != '') {

                    $("#titulo").val(respuesta.titulo);
                    $("#txtAutor").html(respuesta.autor);
                    $("#txtCategoria").html(respuesta.categoria);
                    $("#txtEditorial").html(respuesta.editorial);
                    $("#txtEstatus").html(estatus);
                } else {
                    $("#titulo").val('');
                    $("#txtAutor, #txtCategoria, #txtCategoria,#txtEditorial, #txtEstatus ").html('');
                }

            }

            function quitar_pedido(id, titulo) {
                alertify.confirm("QUITAR LIBRO DEL PEDIDO", "¿Seguro de deseas quitar  <b>" + titulo + "</b> de la solicitud de prestamo?",
                    function() {
                        quitaLibro(id);
                        alertify.success('Eliminado');
                    },
                    function() {
                        alertify.error('Cancelado');
                    });
            }

            function quitaLibro(id) {
                data = {
                    id
                };

                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: '<?= base_url() ?>index.php/biblio/quitar_pedido',
                    data,
                }).done(function(respuesta) {
                    obtPedido();
                })

            }

            function obt_estatus(valor) {
                estatus = '';

                if (valor == 1) {
                    estatus = "<i class='fa fa-check' style='color: green;'></i> Disponible";
                    $("#btnAgregar").removeClass('disabled');
                } else {
                    estatus = "sin definir";
                    $("#btnAgregar").addClass('disabled');
                }
                return estatus;
            }

            function obtPedido() {
                $.ajax({
                    type: "GET",
                    dataType: 'json',
                    url: '<?= base_url() ?>index.php/biblio/obtPedido',
                }).done(function(respuesta) {

                    html = '';
                    $.each(respuesta, function(i, v) {
                        html += '<tr>' +
                            '<td>' + v.consecutivo + '</td>' +
                            '<td>' + v.titulo + '</td>' +
                            '<td>' + v.autor + '</td>' +
                            '<td>' + v.editorial + '</td>' +
                            '<td>' + v.categoria + '</td>' +
                            '<td> <a href="#" onclick="quitar_pedido(' + v.id + ',`' + v.titulo + '`)" class=""><i class="fa fa-close" style="color:red;"></i> </a></td>' +
                            '</tr>';
                    });

                    $("#pedido").html(html);

                })
            }
        </script>