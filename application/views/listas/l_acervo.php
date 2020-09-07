<?
$estados = $this->m_ticket->estatus();
?>

 <div class="content-wrapper">
  <!-- Content Header (Page header) -->
 <div class="page-heading">

 <div class="flexbox-b mb-5 page-title">
            <span class="mr-4 static-badge badge-warning"><i class="ti-book"></i></span>
            <div>
                <h5 class="font-strong">Acervo de la Oficia del Abogado General</h5>
                       
            </div>
  </div>
               
    <a href="<?=base_url()?>" class="btn btn-blue btn-icon-only btn-lg"><i class="fa fa-arrow-left"></i></a>
    <a href="<?=base_url()?>index.php?/biblio/nuevo" class="btn btn-warning btn-icon-only btn-lg "><span class="fa fa-plus"></span></a>
    </div>
  <!-- Main content -->
  <section class="page-content fade-in-up">



    <div class="ibox">
                    <div class="ibox-body">
                        <h5 class="font-strong mb-4"></h5>
                        <div class="flexbox mb-4">
                            <div class="flexbox">
                                <label class="mb-0 mr-2">Filtrar por:</label>
                                <div class="btn-group bootstrap-select show-tick form-control" style="width: 250px;">

                                  <select class="selectpicker show-tick form-control" id="type-filter" title="Please select" data-style="btn-solid" data-width="250px" tabindex="-98">
                                    <option class="bs-title-option" value="">Seleccione una opción</option>
                                    <option value="">Todos</option>
                                    <? foreach($categorias as $c) {?>
                                      <option><?=$c->categoria?></option>
                                    <?}?>
                                   
                                  </select>
                              </div>
                            </div>
                            <div class="input-group-icon input-group-icon-left mr-3">
                                <span class="input-icon input-icon-right font-16"><i class="ti-search"></i></span>
                                <input class="form-control form-control-rounded form-control-solid" id="key-search" type="text" placeholder="Buscar ...">
                            </div>
                        </div>
                        <div class="table-responsive row">
                            <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                              <table class="table table-bordered table-hover dataTable no-footer dtr-inline" id="datatable" role="grid" aria-describedby="datatable_info" style="width: 1042px;">
                                <thead class="thead-default thead-lg">
                                    <tr role="row">
                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 103.017px;" aria-label="Order ID: activate to sort column ascending">
                                       CONS.
                                    </th>                                    
                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 103.017px;" aria-label="Order ID: activate to sort column ascending">
                                       TITULO
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 134px;" aria-label="Estatus: activate to sort column ascending">
                                      AUTOR
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 125.783px;" aria-label=" Usuario: activate to sort column ascending">
                                       EDITORIAL
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 99.15px;" aria-label="Incidente: activate to sort column ascending">
                                      CATEGORÍA</th>
                                      <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 113.117px;" aria-label="Categoria: activate to sort column ascending">
                                        ESTATUS
                                      </th>
                                      <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 99.15px;" aria-label="Incidente: activate to sort column ascending">
                                      UBICACIÓN</th>

                                      <th class="no-sort sorting_disabled" rowspan="1" colspan="1" style="width: 33.8667px;" aria-label="">

                                      </th>
                                    </tr>
                                </thead>

                                <tbody>
                                  <? foreach ($libros as $l) 
                                   {
                                    $estatus = $this->m_ticket->etiqueta($l->estatus);
                                    ?>
                                    <tr class="">
                                    <td > <?=$l->consecutivo?></td>
                                      <td > <?=$l->titulo?></td>
                                      <td ><?=$l->autor?></td>
                                      <td ><?=$l->editorial?></td>
                                      <td ><?=$l->categoria?></td>
                                      <td data-toggle="tooltip"><?=$estatus?></td>
                                      <td><?=$l->ubicacion?></td>
                                      <td width="10" align="center">
                                        <a class="btn btn-sm " href="<?=base_url()?>index.php?/l/seguimiento/<?=$l->consecutivo?>" data-toggle="tooltip" title="Información"><i class="fa fa-info text-pink"></i></a>
                                      </td>
                                    </tr>
                                  <?
                                    }
                                  ?>
                                    </tbody>
                            </table>
                            <div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
                       </div></div>
                        </div>
                    </div>
                </div>

  </section>


 <script>
        $(function() {
            $('#datatable').DataTable({
                pageLength: 10,
                fixedHeader: true,
                responsive: true,
                "sDom": 'rtip',
                columnDefs: [{
                    targets: 'no-sort',
                    orderable: false
                }]
            });
            var table = $('#datatable').DataTable();
            $('#key-search').on('keyup', function() {
                table.search(this.value).draw();
            });
            $('#type-filter').on('change', function() {
                table.column(3).search($(this).val()).draw();
            });
        });
    </script>