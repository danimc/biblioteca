<?
$pieResuletos   =   $cerrados/$total * 100;
$pieAbiertos    =   $abiertos/$total * 100;
$pieNoasig      =   $noasig/$total   * 100; 
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="page-content fade-in-up">
        <? if( $usuario->id_rol == 1 )  {
    ?>

        <div class="row mb-4">
            <div class="col">
                <div class="card mb-4">
                    <div class="card-body flexbox-b">
                        <div class="easypie mr-4" data-percent="100" data-bar-color="#a4daff" data-size="80"
                            data-line-width="8">
                            <span class="easypie-data text-blue" style="font-size:32px;"><i
                                    class="la la-book"></i></span>
                        </div>
                        <div>
                            <h3 class="font-strong text-blue"><?=$total?></h3>
                            <div class="text-muted">TOTAL DE LIBROS</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4">
                    <div class="card-body flexbox-b">
                        <div class="easypie mr-4" data-percent="<?=$pieResuletos?>" data-bar-color="#006815"
                            data-size="80" data-line-width="8">
                            <span class="easypie-data text-success" style="font-size:32px;"><i
                                    class="la la-check"></i></span>
                        </div>
                        <div>
                            <h3 class="font-strong text-success"><?=$cerrados?></h3>
                            <div class="text-muted">LIBROS DISPONIBLES</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4">
                    <div class="card-body flexbox-b">
                        <div class="easypie mr-4" data-percent="<?=$pieAbiertos?>" data-bar-color="#f39c12"
                            data-size="80" data-line-width="8">
                            <span class="easypie-data text-warning" style="font-size:32px;"><i
                                    class="la la-exclamation"></i></span>
                        </div>
                        <div>
                            <h3 class="font-strong text-warning"><?=$abiertos?></h3>
                            <div class="text-muted">LIBROS PRESTADOS</div>
                        </div>
                    </div>
                </div>
            </div>
            <!--
                <div class="col">
                    <div class="card mb-4">
                        <div class="card-body flexbox-b">
                            <div class="easypie mr-4" data-percent="<?=$pieNoasig?>" data-bar-color="#f39c12" data-size="80" data-line-width="8">
                                <span class="easypie-data text-warning" style="font-size:32px;"><i class="la la-info"></i></span>
                            </div>
                            <div>
                                <h3 class="font-strong text-warning"><?=$noasig?></h3>
                                <div class="text-muted">INCIDENTES SIN ASIGNAR</div>
                            </div>
                        </div>
                    </div>
                </div>
    -->
        </div>
        <?
               }
         ?>
        <!-- BOTONES DE ACCION -->
        <div class="row">

            <div class="col mb-4">
                <a href="<?=base_url()?>index.php?/biblio/prestamo">
                    <div class="card bg-warning">
                        <div class="card-body">
                            <h2 class="text-white">Prestamo <i class="ti-book float-right"></i></h2>
                            <div class="text-white mt-1"><i class="ti-stats-up mr-1"></i><small>solicitar un nuevo
                                    prestamo</small></div>
                        </div>
                        <div class="progress mb-2 widget-dark-progress">
                            <div class="progress-bar" role="progressbar" style="width:100%; height:5px;"
                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col mb-4">
                <a href="<?=base_url()?>index.php?/biblio/lista_tickets">
                    <div class="card bg-info">
                        <div class="card-body">
                            <h2 class="text-white">Acervo <i class="ti-list float-right"></i></h2>
                            <div class="text-white mt-1"><i class="ti-stats-up mr-1"></i><small> Revise todo el acervo
                                    de libros de la OAG</small></div>
                        </div>
                        <div class="progress mb-2 widget-dark-progress">
                            <div class="progress-bar" role="progressbar" style="width:100%; height:5px;"
                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </a>
            </div>
            <!--
        <?  $accesoUsr = $this->m_seguridad->acceso_modulo(1);
            if($accesoUsr != 0){
        ?>
                    <div class="col-lg-3 col-md-6 mb-4">
                      <a href="<?=base_url()?>index.php?/usuario/lista_usuarios">
                        <div class="card bg-success">
                            <div class="card-body">
                                <h2 class="text-white">Ctrl Usuarios <i class="ti-user float-right"></i></h2>
                                <div class="text-white mt-1"><i class="ti-stats-up mr-1"></i><small> Gestion del personal</small></div>
                            </div>
                            <div class="progress mb-2 widget-dark-progress">
                                <div class="progress-bar" role="progressbar" style="width:50%; height:5px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                          </a>
                    </div>


        <div class="col-lg-3 col-md-3 mb-4">
            <a href="<?=base_url()?>index.php?/reportes">
            <div class="card bg-danger">
                <div class="card-body">
                    <h2 class="text-white">Reportes <i class="ti-bar-chart  float-right"></i></h2>
                    <div class="text-white mt-1"><i class="ti-stats-up mr-1"></i><small> Reporteador del sistema</small></div>
                </div>
                <div class="progress mb-2 widget-dark-progress">
                    <div class="progress-bar" role="progressbar" style="width:100%; height:5px;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            </a>
        </div>
            -->

            <?
            }


            $accesoActivos = $this->m_seguridad->acceso_modulo(2);
            if ($accesoActivos != 0) {
        ?>
            <!-- <div class="col-lg-3 col-md-6 mb-4">
                      <a href="<?=base_url()?>index.php?/activos/lista_activos">
                        <div class="card bg-pink">
                            <div class="card-body">
                                <h2 class="text-white">Ctrl Activos <i class="ti-desktop float-right"></i></h2>
                                <div class="text-white mt-1"><i class="ti-stats-up mr-1"></i><small> Altas y Bajas de Activos</small></div>
                            </div>
                            <div class="progress mb-2 widget-dark-progress">
                                <div class="progress-bar" role="progressbar" style="width:50%; height:5px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                          </a>
                    </div>-->
            <?
            }
        ?>
            <!-- <div class="col-lg-3 col-md-6 mb-4">
                      <a href="<?=base_url()?>index.php?/inicio/descargar_formatos">
                        <div class="card bg-danger">
                            <div class="card-body">
                                <h2 class="text-white">Formatos <i class="ti-cloud-down float-right"></i></h2>
                                <div class="text-white mt-1"><i class="ti-stats-up mr-1"></i><small> Descarga de Formatos Varios</small></div>
                            </div>
                            <div class="progress mb-2 widget-dark-progress">
                                <div class="progress-bar" role="progressbar" style="width:50%; height:5px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                          </a>
                    </div>-->

        </div>
        <!-- TABLAS --->
        <div class="row">

            <div class="col-md-8">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Prestamos en curso </div>
                    </div>
                    <div class="ibox-body">
                        <div class="table">
                            <table class="table table-bordered table-hover table-responsive">
                                <tr class="bg-secondary">
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Fecha Prestamo</th>
                                    <th> Cant. Libros</th>
                                    <th>Entrega</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Mora Carbajal Luis Daniel</td>
                                    <td>12 de Julio 2020</td>
                                    <td>1</td>
                                    <td>30 Junio 2020</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

        </div>

</div>

</section>