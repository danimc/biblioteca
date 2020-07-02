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
        <!-- Main content -->
        <section class="page-content fade-in-up">
            <div class="row">
                <div class="col-md-5">
                    <div class="ibox ibox-fullheight">
                        <div class="ibox-head">
                            <div class="ibox-title">Datos del Solicitante</div>
                        </div>
                        <div class="ibox-body">
                            <div class="row">
                                <div class="form-group mb-6 col-md-12 ">
                                    <label class="col-sm-12 col-form-label">Usuario: </label>
                                    <div class="col-sm-12">
                                        <select class="form-control selectpicker col-sm-12" id="usrIncidente" data-live-search="true" name="usrIncidente">
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
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-md-7">
                    <div class="ibox ibox-fullheight">
                        <div class="ibox-body">
                            <div class="row">
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
                                    <label>Titulo</label>
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
                                    <a href="#" id="btnAgregar" class="btn btn-block btn-success"> Agregar </a>
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
                                Lista de ejemplares a prestar
                            </div>
                        </div>
                        <div class="ibox-body">
                            <div class="row">
                                <table class="table table-responsive table-hover">
                                    <tr>
                                        <th> Cons.</th>
                                        <th>Titulo</th>
                                        <th>Autor</th>
                                        <th>Editorial</th>
                                        <th>Categoria</th>
                                        <th>Acciones</th>
                                    </tr>
                                    <tr>
                                        <div id="pedido"></div>
                                    </tr>

                                </table>

                            </div>
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
                    llenarDatos(falso = '');
                })
            })

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
                    llenarDatos(falso = '');

                    html = '';
                    $.each(respuesta, function(i, v) {
                        html += '<tr>' +
                            '<td>' + v.folio + '</td>' +
                            '<td>' + v.forma + '</td>' +
                            '<td>' + fecha + '</td>' +
                            '<td>' + v.fecha_inicio + '</td>' +
                            '<td>' + v.departamento + '</td>' +
                            '<td>' + v.titulo + '</td>' +
                            '<td>' + v.categoria + '</td>' +
                            '<td>' + v.id_situacion + '</td>' +
                            '</tr>';
                    })

                })
            }
        </script>

        <!-- <script>
    $("#nombre").change(function () {   
        busqueda = $("#nombre").val();
        datos = { busqueda : busqueda,
                  tipo     : 2   };
        $.ajax({
        type: "POST",
        dataType: 'json',
        url: '<?= base_url() ?>index.php/usuario/obt_usuario',
        data: datos,
          }).done(function(respuesta){
            $("#usrIncidente").val(respuesta.codigo);
            $("#extension").val(respuesta.extension);
            $("#correo").val(respuesta.correo);
            $("#extension").val(respuesta.extension);
            $("#dependencia").val(respuesta.depId);
          })
     })
</script>
 script de la impresora-->