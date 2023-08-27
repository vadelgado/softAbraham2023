<?php echo $this->extend('layout\layout') ?>

<?php echo $this->section('content') ?>

<!--DATATABLES-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap.min.css">


<div class="content container-fluid mt-4">
        <div class="row">
            <div class="col-md-12" >
                <div class="card card-default"> 
                    <div class="card-header text-center">
                    <img src="..\public\img\boletin.png" alt="usuarios"
                        class="icono-sidebar" /><b>BOLETINES</b>
                    </div>
                    <div class="card-body">
                        
                        <div class="mt-4 table-container" >
                            <table class="table mt-4 table-striped table-bordered table-container" 
                            id="miTabla" name="miTabla" style="width:100%">
                                <thead class="headerTable bordered-table text-center">
                                    <tr class="text-center">
                                        <th scope="col">Código</th>
                                        <th scope="col">Curso</th>
                                        <th scope="col">Periodo</th>
                                        <th scope="col">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody class="bordered-table bodyTable normal" style="font-weight:normal">
                                <?php foreach($boletines as $boletin): ?>
                                    <tr>
                                        <th class="normal">
                                        <?php echo $boletin['id_curso'] ?>
                                        </th>
                                        <th class="normal">
                                            <?php echo $boletin['nombre_curso'] ?>
                                        </th>
                                        <th class="normal">
                                            <?php echo $boletin['periodo'] ?>
                                        </th>
                                        <th> 
                                            <a href="<?php echo base_url()?>verBoletin/<?php echo $boletin['id_curso']; ?>"
                                             type="button" class="btn botonEditar edit-btn" title="Ver boletin">
                                                <i id="pencil-icon" class="fas fa-eye" aria-hidden="true"></i>
                                            </a>
                                            <a href="#" class=" btn botonRegistrar imprimir-boletin" data-curso-id="<?= $boletin['id_curso'] ?>" title="imprimir">
                                                <i class="fas fa-print"></i> 
                                            </a>
                                        </th>                            
                                    </tr>
                                <?php endforeach ?>
                                </tbody>
                            </table>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!--Datatables-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="../public/js/boletin.js"></script>

<script>
    $(document).ready(function() {
    $('#miTabla').DataTable(
        {
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            },
        }
    );
    
    });
</script>

<script id="base-url" data-url="<?php echo base_url(); ?>"></script>

<script>
    // Espera a que el documento esté listo
    $(document).ready(function() {
        // Agrega un manejador de clic para los botones "Imprimir"
        $(".imprimir-boletin").click(function() {
            var cursoId = $(this).data("curso-id");  
            var nuevaVentana =  window.open("<?= base_url('/verBoletin/') ?>" + cursoId, "_blank");
            nuevaVentana.onload = function() {
                nuevaVentana.print();
            };
        });
    });
</script>


<?php echo $this->endSection() ?>