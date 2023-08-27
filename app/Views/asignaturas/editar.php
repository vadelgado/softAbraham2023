<?php echo $this->extend('layout\layout') ?>

<?php echo $this->section('content') ?>

<div class="content container-fluid mt-4">
        <div class="row">
            <div class="col-md-12" >
                <div class="card card-default"> 
                    <div class="card-header text-center">
                    <img src="..\public\img\crearasignatura.jpg" alt="usuarios"
                        class="icono-sidebar" /><b>EDITAR ASIGNATURAS</b>
                    </div>
                    <div class="card-body"> 
                         <div class="mt-4 table-container" >
                            <form method="POST" action="<?php echo base_url('Editar') ?>">
                                <div class="row">        
                                    <div class="col-md-4">
                                        <label for="area" class="control-label">Area </label>
                                        <input type="text" id="area" name="area" class="form-control" >
                                    </div>
                                    <div class="col-md-8">
                                        <label for="descripcion" class="control-label">Descripción</label>
                                        <input type="text" id="descripcion" name="descripcion"  class="form-control">
                                    </div>                                    
                                </div>
                                <br>
                                <div class="text-center mt-4">
                                    <button  class="botonRegistrar" type="submit" >
                                        <i class="fas fa-save"></i>&nbsp; Actualizar &nbsp;
                                    </button>
                                </div>
                                <br><br>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
</div>

<?php echo $this->endSection() ?>
