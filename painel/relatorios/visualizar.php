<?php

//Data Inicio
if( !empty($_GET['dataInicio']) and !empty($_GET['dataFim']) ){
    $datas = " AND c.cursos_registro BETWEEN '".$_GET['dataInicio']." 00:00:01' AND '".$_GET['dataFim']." 23:59:59' ";
}

if( $_GET['status'] >= 0  and isset($_GET['status'])){
   $_status = " AND c.cursos_status = '".$_GET['status']."' ";
}

$sqlFiltro = "SELECT c.cursos_registro, c.curso_valor, c.cursos_id_curso, c.aluno_aluno_id, c.cursos_codigo, c.cursos_tipo_pagamento, 
                     c.cursos_pagmento_id, c.cursos_id, c.cursos_status, d.cup_nome, cp.cup_id
              FROM aluno_cursos as c

              LEFT JOIN cupom_usado as cp
              ON cp.cup_aulo_cursos_id = c.cursos_id

              LEFT JOIN cupom as d
              ON d.cup_id = cp.cup_id

              WHERE 1
              {$datas}
              {$_status}
                ";


$InputSQL = new db();
$InputSQL->query( $sqlFiltro );
$InputSQL->execute();

 
?>


<h2 class="mb-3">Relatórios</h2>
<hr>

<form id="filtrar">

    <div class="row">

        <div class="col-lg-3 col-sm-6">
            <div class="form-group">
                <label for="dataInicio">Data Início</label>
                <input type="date" class="form-control" id="dataInicio" name="dataInicio" value="<?php echo $_GET['dataInicio']?>">
            </div> 
        </div>
        
        <div class="col-lg-3 col-sm-6">
            <div class="form-group">
                <label for="dataFim">Data Fim</label>
                <input type="date" class="form-control" id="dataFim" name="dataFim" value="<?php echo $_GET['dataFim']?>">
            </div> 
        </div>
        
        <div class="col-lg-2 col-sm-6">
            <div class="form-group">
                <label for="dataFim">Status</label>
                <select class="form-control" name="status" id="status">
                    <option value="-1" <?php if( $_GET['status'] == '-1' ){ echo "selected"; } ?>>Todos</option>
                    <option value="0" <?php if( $_GET['status'] == '0' ){ echo "selected"; } ?>>Inativo</option>
                    <option value="1" <?php if( $_GET['status'] == '1' ){ echo "selected"; } ?>>Ativo</option>
                </select>
            </div> 
        </div>
        
        <div class="col-lg-2 col-sm-6">
            <div class="form-group">
                <label for="dataFim">Filtrar</label>
                <button type="submit" class="btn btn-success w-100"><i class="fa fa-check"></i></button>
            </div> 
        </div>
        
        <div class="col-lg-2 col-sm-6">
            <div class="form-group">
                <label for="dataFim">Limpar</label>
                <a href="!/relatorios/visualizar" class="btn btn-outline-danger w-100"><i class="fa fa-retweet"></i></a>
            </div> 
        </div>

    </div>

</form>
<hr>

<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>assets/datatables/jquery.dataTables.min.css"></style>
<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>assets/datatables/buttons.dataTables.min.css"></style>
<script src="<?php echo $url; ?>assets/datatables/jquery.dataTables.min.js"></script>
<!-- <script src="<?php echo $url; ?>assets/datatables/buttons.flash.min.js"></script> -->
<script src="<?php echo $url; ?>assets/datatables/buttons.html5.min.js"></script>
<script src="<?php echo $url; ?>assets/datatables/buttons.print.min.js"></script>
<script src="<?php echo $url; ?>assets/datatables/dataTables.buttons.min.js"></script>
<script src="<?php echo $url; ?>assets/datatables/jszip.min.js"></script>
<script src="<?php echo $url; ?>assets/datatables/pdfmake.min.js"></script>
<script src="<?php echo $url; ?>assets/datatables/vfs_fonts.js"></script>
<script src="<?php echo $url; ?>assets/datatables/dataTables.select.min.js"></script>
<script src="<?php echo $url; ?>assets/datatables/dataTables.rowReorder.min.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function() {
    jQuery('#dataTables').DataTable( {
      select: true,
      stateSave: true,
      responsive: true,
      rowReorder: true,
      "order": [[ 0, 'DESC' ], [ 1, 'asc' ]],
    //   "dom": '<"top"i>lft<"bottom"Bi><"clear">',
      //buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
    //   "pagingType": "full_numbers"
    } );

    jQuery('.dataTables_length select').addClass('input-control');
    jQuery('.dataTables_filter label input').addClass('input-control');
    jQuery('.table').addClass('font-12');
    jQuery('.top #dataTables_info').css({'display':'none'});
    jQuery('.dt-buttons').css({'margin-top':'10px'});
  } );
</script>

<div class="card">
  <div class="card-body">
    <table class="table table-striped table-hover" id="dataTables">
      <thead>
        <tr class="success">
          <th>ID</th>
          <th>Código</th>
          <th>Criado</th>
          <th>Cupom</th>
          <th>Valor</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
          <?php
          foreach( $InputSQL->row() AS $row ){
                ?>
                    <tr>
                        <td><?php echo $row['cursos_pagmento_id']?></td>
                        <td><?php echo $row['cursos_codigo']?></td>
                        <td><?php echo $row['cursos_registro']?></td>
                        <td><?php echo $row['cup_nome']?></td>
                        <td><?php echo $row['curso_valor']?></td>
                        <td><?php echo empty($row['cursos_status']) ? "Inativo" : "Ativo" ?></td>
                    </tr>
                <?php
                $total += $row['curso_valor'];

                if( $row['cursos_status'] == 1 ){ $totalPago += $row['curso_valor']; }
                if( $row['cursos_status'] == 0 ){ $totalAberto += $row['curso_valor']; }
            }          
          ?>
      </tbody>
    </table>
  </div>
</div>


     <div class="row mt-4">

            <div class="col-lg-3 col-sm-6 my-2">
                <div class="card card-body h-100 text-success">
                    <h3>Vendas</h3>
                    <?php echo $InputSQL->rowCount()?>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 my-2 text-info">
                <div class="card card-body h-100">
                    <h3>Valor total</h3>
                    R$<?php echo $total?>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 my-2 text-primary">
                <div class="card card-body h-100">
                    <h3>Valor Pago</h3>
                    R$<?php echo $totalPago?>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 my-2 text-danger">
                <div class="card card-body h-100">
                    <h3>Valor Aberto</h3>
                    R$<?php echo $totalAberto?>
                </div>
            </div>

    </div>


    <script>

        $("#filtrar").submit(function(){


            $data1 = $("#dataInicio").val();
            $data2 = $("#dataFim").val();
            $status = $("#status").val();

             
           
             console.log('envio ');

             window.location.href= '!/relatorios/visualizar/&dataInicio='+$data1+'&dataFim='+$data2+'&status='+$status;

            return false;

        });

</script>