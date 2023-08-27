<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boletines</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="<?= base_url('/css/boletin.css') ?>" rel="stylesheet">
</head>
<body>
    <?php foreach ($listadoEstudiantesCurso as $estudiante) : ?>
     
        <table class="contenedor  page-break"" >
         <tr>
            <th class="text-center" width="20%">
            <img src="<?= base_url('/img/logosiglo21.png') ?>" alt="logo" class="imagen" />
            </th>
            <th  width="80%" style="text-align:center">
                <p>
                    <b>INSTITUCIÓN EDUCATIVA SIGLO XXI</b> <br>
                    <b>Educamos para la vida</b> <br>
                    INFORME EVALUATIVO PRIMER PERIODO  <br>
                    CRITERIOS DE EVALUACIÓN Y PROMOCIÓN
                </p>
            </th>
          </tr>
        </table>
        <table class="contenedor" >
            <tr class="mt-4">
                <th class="text-center cuadro" width="50%">
                    <p>
                        DESEMPEÑO BAJO:    1,0 - 2,9 <br>
                        DESEMPEÑO BÁSICO:   3,0 - 3,9
                    </p>
                </th>
                <th class="text-center cuadro" width="50%">
                    <p>
                        DESEMPEÑO ALTO:    3,0 - 3,9 <br>
                        DESEMPEÑO SUPERIOR:   4,7 - 5,0
                    </p>
                </th>
            </tr>
        </table>

          <label class="mt-2 letraMediana"> <b>Grado:  <?= $nombrecurso['nombre_curso'] ?></b></label> 
        <br>
            <table class="contenedor" style="font-size:10px" >
                <tr style="font-size:10px" >
                    <th class="cuadro" width="15%" style="font-size:10px"  >
                        <b>NOMBRE DEL ESTUDIANTE: </b>
                    </th>
                    <th class="cuadro" width="67%" style="font-size:10px"  >
                     <?= $estudiante['nombre']; ?>
                    </th>
                    <th class="cuadro" width="9%" style="font-size:10px"  >
                        <b>DESEMPEÑO: </b>
                    </th>
                    <th class="cuadro" width="9%">

                    </th>
                </tr>
            </table>
            <table class="contenedor">
                <tr style="font-size:10px" >
                    <th class="cuadro" width="10%" style="font-size:10px"  >
                        <b>MATERIA <br>
                            /DOCENTE </b>
                    </th>
                    <th class="cuadro" width="18%" style="font-size:10px" >
                            <div class="mt-2">
                                <b>PRIMER PERIODO</b>
                            </div>
                            <table class="contenedor2">
                                <tr>
                                    <td class="cuadro2" width="80%" style="font-size:10px" >
                                        Promedio
                                    </td>
                                    <td class="cuadro3" width="20%" style="font-size:10px" >
                                        %
                                    </td>
                                </tr>
                            </table>
                    </th>
                    <th class="cuadro" width="18%" style="font-size:10px" >
                        <div class="mt-2">
                            <b>SEGUNDO PERIODO</b>
                        </div>
                        <table class="contenedor2">
                            <tr>
                                <td class="cuadro2" width="80%" style="font-size:10px">
                                    Promedio
                                </td>
                                <td class="cuadro3" width="20%" style="font-size:10px">
                                    %
                                </td>
                            </tr>
                        </table>
                    </th>
                    <th class="cuadro" width="18%"  style="font-size:10px">
                        <div class="mt-2">
                            <b>TERCER PERIODO</b>
                        </div>
                        <table class="contenedor2">
                            <tr>
                                <td class="cuadro2" width="80%" style="font-size:10px">
                                    Promedio
                                </td>
                                <td class="cuadro3" width="20%" style="font-size:10px">
                                    %
                                </td>
                            </tr>
                        </table>
                    </th>
                    <th class="cuadro" width="18%" style="font-size:10px" >
                           <div class="mt-2">
                            <b>CUARTO PERIODO</b>
                        </div>
                        <table class="contenedor2">
                            <tr>
                                <td class="cuadro2" width="80%" style="font-size:10px">
                                    Promedio
                                </td>
                                <td class="cuadro3" width="20%" style="font-size:10px">
                                    %
                                </td>
                            </tr>
                        </table>
                    </th>
                    <th class="cuadro" width="9%" style="font-size:10px">
                        <P>
                            <b>PROMEDIO</b> <br>
                            Total
                        </P> 
                    </th>
                    <th class="cuadro" width="9%" style="font-size:10px">
                        <b>DESEMPEÑO</b>
                    </th>
                </tr>
                <?php foreach ($estudiantesConNota as $notas) : ?> 

                    <?php if ($notas['documento'] === $estudiante['documento']) : ?>

                        <tr>
                        <th class="cuadro" style="font-size:10px">
                            <b><?=  $notas['area_asignatura']?> </b> <br>
                            <b><?=  $notas['docente']['nombre'] ?> </b>
                        </th>
                        <th class="cuadro" style="font-size:8px">
                            <table style="width:100%">
                                <tr>
                                    <th class="cuadro4" width="60%"   style="font-size:10px">
                                    SABER <?=  $notas['porcentajeSaber']?>% 
                                    </th>
                                    <th class="cuadro4" width="20%" style="font-size:10px">
                                    <?=  $notas['notaSb2']?>
                                    </th>
                                    <th style="font-size:10px" width="20%">
                                        <?=  $notas['notaSb']?>
                                    </th>
                                </tr>
                                <tr>
                                    <th class="cuadro2" width="60%"   style="font-size:10px">
                                        HACER <?=  $notas['porcentajeHacer']?>%
                                    </th>
                                    <th class="cuadro2" width="20%" style="font-size:10px">
                                        <?=  $notas['notaHc2']?>
                                    </th>
                                    <th class="cuadro3"  style="font-size:10px" width="20%">
                                        <?=  $notas['notaHc']?>
                                    </th>
                                </tr>
                                <tr>
                                    <th class="cuadro2" width="60%"   style="font-size:10px">
                                        SER <?=  $notas['porcentajeSer']?> %                       
                                    </th>
                                    <th class="cuadro2" width="20%" style="font-size:10px">
                                        <?=  $notas['notaSr2']?>
                                    </th>
                                    <th class="cuadro3"  style="font-size:10px" width="20%">
                                        <?=  $notas['notaSr']?>
                                    </th>
                                </tr>
                                <tr>
                                    <th class="cuadro2" width="60%"   style="font-size:10px">
                                        DEFINIT                    
                                    </th>
                                    <th class="cuadro3" colspan="2" style="font-size:11px">
                                        <?=  $notas['sumaNotas']?>                     
                                    </th>
                                </tr>
                            </table>
                        </th>
                        <th class="cuadro" style="font-size:10px" >

                        </th>
                        <th class="cuadro" >

                        </th>
                        <th class="cuadro" >

                        </th>
                        <th class="cuadro" style="font-size:10px" >
                            <P>
                                <?=  $notas['sumaNotas']?>
                            </P> 
                        </th>
                        <th class="cuadro" style="font-size:10px">
                            <?=  $notas['desempenio']?>
                        </th>
                    </tr>
                                
                    <?php endif; ?>
                <?php endforeach; ?>

                <th class="cuadro" width="10%" style="font-size:10px"  >
                        <b>PROMEDIO POR <br>
                        PERIODO </b>
                    </th>
                    <th class="cuadro" width="18%" style="font-size:10px" >
                            <div class="mt-2">
                                <b>PRIMER PERIODO</b>
                            </div>
                            <table class="contenedor2">
                                <tr>
                                    <td class="cuadro3" width="100%" style="font-size:10px" >
                                    <?=  $estudiante['sumaNotas']?>
                                    </td>
                                </tr>
                            </table>
                    </th>
                    <th class="cuadro" width="18%" style="font-size:10px" >
                        <div class="mt-2">
                            <b>SEGUNDO PERIODO</b>
                        </div>
                        <table class="contenedor2">
                            <tr>
                                <td class="cuadro3" width="100%" style="font-size:10px">
                                    --
                                </td>
                            </tr>
                        </table>
                    </th>
                    <th class="cuadro" width="18%"  style="font-size:10px">
                        <div class="mt-2">
                            <b>TERCER PERIODO</b>
                        </div>
                        <table class="contenedor2">
                            <tr>
                                <td class="cuadro3" width="100%" style="font-size:10px">
                                    --
                                </td>
                            </tr>
                        </table>
                    </th>
                    <th class="cuadro" width="18%" style="font-size:10px" >
                           <div class="mt-2">
                            <b>CUARTO PERIODO</b>
                        </div>
                        <table class="contenedor2">
                            <tr>
                                <td class="cuadro3" width="100%" style="font-size:10px">
                                  --
                                </td>
                            </tr>
                        </table>
                    </th>
                    <th class="cuadro" width="9%" style="font-size:10px">
                         <div class="mt-2">
                            <b>TOTAL</b>
                        </div>
                        <table class="contenedor2">
                            <tr>
                                <td class="cuadro3" width="100%" style="font-size:10px">
                                <?=  $estudiante['sumaNotas']?>
                                </td>
                            </tr>
                        </table> 
                    </th>
                    <th class="cuadro" width="9%" style="font-size:10px">
                         <div class="mt-2">
                            <b>DESEMPEÑO</b>
                        </div>
                        <table class="contenedor2">
                            <tr>
                                <td class="cuadro3" width="100%" style="font-size:10px">
                                <?=  $estudiante['desempenio']?>
                                </td>
                            </tr>
                        </table> 
                    </th>
                </tr>
                <tr>
                    <td class="cuadro" colspan="7" style="font-size:11px;   text-align: left;">
                       <b> Observaciones:</b>
                    </td>
                </tr>
                <tr>
                    <td class="cuadro7 " colspan="3" style="font-size:11px;   text-align: center;">
                    <img src="<?= base_url('/img/firma1.1.png') ?>" alt="logo"  class="imagen2" />
                    </td>
                    <td class="cuadro4" colspan="4" style="font-size:11px;  text-align: center;">
                    <img src="<?= base_url('/img/firma2.2.png') ?>" alt="logo"  class="imagen2"  />
                    </td>
                </tr>
                <tr>
                    <td class="cuadro6 " colspan="3" style="font-size:11px;   text-align: center;">
                        <p>
                            Mario Esteban López <br>
                        <b>DIRECTOR</b> 
                        </p>
                    </td>
                    <td class="cuadro5 " colspan="4" style="font-size:11px;  text-align: center;">
                        <p>
                            Betty Verónica Potosí <br>
                        <b>DIRECTOR DE GRUPO</b> 
                        </p>
                    </td>
                </tr>
            </table>    
         <br>
    <?php endforeach; ?>
    
</body>
</html>