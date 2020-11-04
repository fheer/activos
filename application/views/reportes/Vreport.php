<?php
if(!$this->session->userdata('logueado')){
      $Urlu = base_url()."Clogin";
        echo '<script language="javascript">alert("No se identifico como Usuario");</script>';  
        echo '<script type="text/javascript">window.location="'.$Urlu.'"; </script>';
}
?>
<script type="text/javascript">
function confirma(){
 if (confirm("¿Realmente desea eliminarlo?")){ 
 //alert("El registro ha sido eliminado.") 
 }else{ 
 return false
 }
}
</script>
<section class="content-header">
    <h1><small></small></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>Cmenu"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active"><i class="fa fa-file-text-o"></i> Reportes</li>
      </ol>
</section>
  
<div class="box-header" with-border>
  <?php
  if (isset($msje)){
      echo '<div class="alert alert-info alert-dismissable" align="center">';
      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
      echo $msje;
      echo '</div>';
    }
  ?>
<div class="box-body no-padding" >
     <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title" style="align:center;">--- Reporte por cursos ---</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <form action="<?php echo base_url();?>reportes/Creport/generar" method="post" target="_blank">
              <div class="form-group">
                <label for="curso" class="col-sm-1 control-label">Curso</label>
                <div class="col-sm-2">
                  <select id="cboCurso" class="form-control" name="curso" ></select>
                </div>
                <div class="form-group col-sm-2">
                 <button type="button" id="btnMostrar" class="btn btn-block btn-default">Mostrar</button>
                </div>
                <div class="form-group col-sm-2">
                 <button type="submit" id="btnPdf" class="btn btn-block btn-info">Imprimir</button>
                </div>
              </div>
              </form>
          
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.box-body -->
        <div class="box-footer" align="center">
          Selecione el curso click en Imprimir
        </div>
      </div><!-- /.box info datos sancion-->
</div>
<div class="box-body no-padding" >
     <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title" style="align:center;">--- Reportes Semanales, Mensuales por cursos---</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <form action="<?php echo base_url();?>reportes/Creport/generar" method="post" target="_blank">
              <div class="form-group">
                <label for="curso" class="col-sm-1 control-label">Curso</label>
                <br>
                <div class="col-sm-2">
                  <select id="cboCurso" class="form-control" name="curso" ></select>
                </div>
              </div>  
              <div class="form-group">
                <div class="col-sm-3">
                  <label>Fecha:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="reservation">
                  </div><!-- /.input group -->
                </div>
              </div>
                
                <div class="form-group col-sm-2">
                 <button type="submit" id="btnPdf1" class="btn btn-block btn-info">Imprimir</button>
                </div>
              
              </form>
          
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.box-body -->
        <div class="box-footer" align="center">
          Selecione el curso click en Imprimir
        </div>
      </div><!-- /.box info datos sancion-->

</div>
<div class="box-body no-padding" >
<br/>
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Notas de Disciplina del personal de DD. y CC. Cadetes</h3>
  </div>
  <!-- /.box-header -->
  <table id="tblRpt" class="table table-bordered table table-striped">
    <thead>
      <tr>
        <th style="width:5%; background-color:#cccccc; color:black; align:center">N</th>
        <th style="width:16%; background-color:#cccccc; color:black;">Grado y Arma</th>
        <th style="width:22%; background-color:#cccccc; color:black;">Apellidos y Nombres</th>
        <th style="width:5%; background-color:#cccccc; color:black;">Demerito(s)</th>
        <th style="width:5%; background-color:#cccccc; color:black;">Merito(s)</th>
        <th style="width:7%; background-color:#cccccc; color:black;">Nota Discplina</th>
        <th style="width:2%; background-color:#cccccc; color:black;">Curso</th>
        <th style="width:2%; background-color:#cccccc; color:black;">Acciones</th>
      </tr>
    </thead>
    <tbody>
      
    </tbody>  
  </table>
  </div> <!-- /.box-body -->
</div> <!-- /.box-box -->
</div> <!-- /.col-sm-12 -->
<!-- -->
<!-- Modal Editar Cdtes -->
<!-- -->
<script type="text/javascript">
  var baseurl = "<?php echo base_url(); ?>";
</script>

