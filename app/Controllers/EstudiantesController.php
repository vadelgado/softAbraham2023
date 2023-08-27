<?php

namespace App\Controllers;
use App\Models\CursoModel;
use App\Models\usuarios;
use App\Models\EstudiantesModel;
use Dompdf\Dompdf;
use Dompdf\Options;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class EstudiantesController extends BaseController
{

    public function index()
    {
        $estudiante = new EstudiantesModel();
        $usuario = new usuarios();
        // Obtener todos los usuarios con rol "estudiante" y estado "1" junto con sus datos de estudiante asociado y los cursos asociados con los estudiantes
        $estudiantes = $usuario->where('rol', 'estudiante')
        ->where('estado', 1)
        ->join('estudiantes', 'estudiantes.usuario_id = usuarios.id_usuario') 
        ->join('cursos', 'cursos.id_curso = estudiantes.curso_id')
        ->findAll();
        $cursoModel = new CursoModel();
        $cursos = $cursoModel->findAll();
        $data = ['cursos' => $cursos];
    
        return view('estudiantes/studentsList', ['estudiantes' => $estudiantes] + $data);

    }

    public function newStudent()
    {
        $curso = new CursoModel();
        $data = $curso->findAll();
        $data =['data' => $data];

        return view('estudiantes\newStudent', $data);
    }

    public function searchStudent(){
        // Verificar si se recibió el documento del usuario en la solicitud POST
        if (isset($_POST['documento'])) {
        $documento = $_POST['documento'];

        $usuario = new usuarios();
        $estudiante = new EstudiantesModel();

        $datosEstudiante = $usuario->buscarEstudiante($documento);

        $validar = $usuario->where('documento', $documento)
        ->where('estado', 1)
        ->join('estudiantes', 'estudiantes.usuario_id = usuarios.id_usuario') 
        ->countAllResults();
       
        if($validar>0){
            $respuesta="error";
            echo json_encode($respuesta);
            exit;
        }
        else{
            echo json_encode($datosEstudiante);
            exit;
        }

        }
        // Si no se recibió el documento o ocurrió un error, devolver un mensaje de error
        echo json_encode(['error' => 'Error al obtener los datos del usuario']);
        exit;
    }

    
    public function newStudentSave(){

        $estudiante = new EstudiantesModel();
        $usuario = new usuarios();
        $id_usuario = $this->request->getPost('id_usuario');
        $fechaRegistro = $this->request->getPost('fechaReg');
        $direccion = $this->request->getPost('direccion');
        $celular = $this->request->getPost('celular');
        $fechaNac = $this->request->getPost('fechaNac');
        $genero = $this->request->getPost('genero');
        $curso = $this->request->getPost('curso');
        $documentoAcudiente = $this->request->getPost('documentoAcudiente');
        $nombreAcudiente = $this->request->getPost('nombreAcudiente');
        $telefonoAcudiente = $this->request->getPost('telefonoAcudiente');
        $correoAcudiente = $this->request->getPost('correoAcudiente');
        
        
        $validarEstudiante = $estudiante->where('usuario_id', $id_usuario)
        ->countAllResults();
        $validarUsuario = $usuario->where('id_usuario', $id_usuario)
        ->countAllResults();
            
        if($validarEstudiante>0 || $validarUsuario==0){
            return redirect()->to(base_url('/Estudiantes'))->with('mensajeError', 'Ha ocurrido un error al agregar al estudiante');
        }
        else{
            // Realizar la actualización utilizando el modelo
            $data = array(
                'usuario_id' => $id_usuario,
                'fecha_registro_estuediante' => $fechaRegistro,
                'direccion_estudiante' => $direccion,
                'celular_estudiante' => $celular,
                'fecha_nacimiento' => $fechaNac,
                'genero_estudiante' => $genero,
                'curso_id' => $curso,
                'documento_acudiente' => $documentoAcudiente,
                'nombre_acudiente' => $nombreAcudiente,
                'telefono_acudiente' => $telefonoAcudiente,
                'correo_acudiente' => $correoAcudiente

            );

            $correct = $estudiante->insert($data);
            if($correct){
                return redirect()->to(base_url('/Estudiantes'))->with('mensaje', 'Estudiante creado con éxito');
            }
            else{
                return redirect()->to(base_url('/Estudiantes'))->with('mensajeError', 'Ha ocurrido un error al agregar al estudiante');
            }
        }      
    }

    public function editStudent()
    {
       // Verificar si se recibió el id del usuario en la solicitud POST
       if (isset($_POST['id_usuario'])) {
        $id = $_POST['id_usuario'];


        $estudiante = new EstudiantesModel();
        $usuario = new usuarios();
        // Obtener todos los usuarios con rol "estudiante" y estado "1" junto con sus datos de estudiante asociado y los cursos asociados con los estudiantes
        $estudiantes = $usuario->where('id_usuario',$id)
        ->join('estudiantes', 'estudiantes.usuario_id = usuarios.id_usuario') 
        ->join('cursos', 'cursos.id_curso = estudiantes.curso_id')
        ->first();
        
        $curso = new CursoModel();
        $cursos = $curso->findAll();

        $response = [
            'estudiantes' => $estudiantes,
            'cursos' => $cursos
        ];
        // Devolver los datos del usuario en formato JSON
        echo json_encode($response);
        exit;
       }
    // Si no se recibió el documento o ocurrió un error, devolver un mensaje de error
    echo json_encode(['error' => 'Error al obtener los datos del usuario']);
    exit;

        return view('estudiantes\editStudent');
    }

    public function editStudentSave(){
        
        $estudiante = new EstudiantesModel();
        $usuario = new usuarios();

        $id_usuario = $this->request->getPost('id_usuario');
        $fechaRegistro = $this->request->getPost('fechaReg');
        $direccion = $this->request->getPost('direccion');
        $celular = $this->request->getPost('celular');
        $fechaNac = $this->request->getPost('fechaNac');
        $genero = $this->request->getPost('genero');
        $curso = $this->request->getPost('curso');
        $documentoAcudiente = $this->request->getPost('docAcudiente');
        $nombreAcudiente = $this->request->getPost('nomAcudiente');
        $telefonoAcudiente = $this->request->getPost('telAcudiente');
        $correoAcudiente = $this->request->getPost('correoAcudiente');
        $id_estudiante = $this->request->getPost('id_estudiante');

        $validarUsuario = $usuario->where('id_usuario', $id_usuario)
        ->countAllResults();
            
        if($validarUsuario==0){
            return redirect()->to(base_url('/Estudiantes'))->with('mensajeError', 'Ha ocurrido un error al agregar al estudiante');
        }
        else{
            // Realizar la actualización utilizando el modelo
            $data = array(
                'fecha_registro_estuediante' => $fechaRegistro,
                'direccion_estudiante' => $direccion,
                'celular_estudiante' => $celular,
                'fecha_nacimiento' => $fechaNac,
                'genero_estudiante' => $genero,
                'curso_id' => $curso,
                'documento_acudiente' => $documentoAcudiente,
                'nombre_acudiente' => $nombreAcudiente,
                'telefono_acudiente' => $telefonoAcudiente,
                'correo_acudiente' => $correoAcudiente
            );

            $isCorrect = $estudiante->actualizarEstudiante($id_estudiante, $data);
            if($isCorrect){
                return redirect()->to(base_url('/Estudiantes'))->with('mensaje', 'Estudiante actualizado con éxito');
            } 
            else{
                return redirect()->to(base_url('/Estudiantes'))->with('mensajeError', 'Ha ocurrido un error en la actualización');
            }
        }             
       
    }

    public function generateFilteredPDF($cursoId) {
        $estudiantes = $this->getFilteredDataForPDF($cursoId);
        if (empty($estudiantes)) {
            return redirect()->to(base_url('/Estudiantes'))->with('mensajeError', 'No hay estudiantes Registrados en el Curso.');
        }  
        
        $data['estudiantes'] = $estudiantes;
        $html = view('estudiantes/pdf_template', $data);
    
        $options = new Options();
        $options->setIsRemoteEnabled(true);        
        
        $dompdf = new Dompdf($options);
    
        $dompdf->loadHtml($html);

        $dompdf->setPaper('landscape');

        $dompdf->render();   

        $dompdf->stream('reporte_estudiantes.pdf', ['Attachment' => false]);
    }
    
    private function getFilteredDataForPDF($cursoId) {

        $estudiante = new EstudiantesModel();
        $usuario = new usuarios();

        $estudiantes = $usuario->where('rol', 'estudiante')
            ->where('estado', 1)
            ->join('estudiantes', 'estudiantes.usuario_id = usuarios.id_usuario') 
            ->join('cursos', 'cursos.id_curso = estudiantes.curso_id')
            ->where('estudiantes.curso_id', $cursoId)
            ->findAll();

        return $estudiantes;
    }

    public function generateExcel($cursoId) {
        $estudiantes = $this->getFilteredDataForPDF($cursoId);
    
        if (empty($estudiantes)) {
            return redirect()->to(base_url('/Estudiantes'))->with('mensajeError', 'No hay estudiantes Registrados en el Curso.');
        }
    
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
    
        // Establecer estilos para el encabezado
        $headerStyle = [
            'font' => [
                'bold' => true,
                'size' => 13,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];
    
        // Obtener el nombre del curso (puedes obtenerlo de tu base de datos)
        $nombreCurso = esc($estudiantes[0]['nombre_curso']);
    
        // Agregar el encabezado
        $sheet->mergeCells('A1:AK1'); // Fusionar celdas para el encabezado
        $sheet->setCellValue('A1', 'Planilla de Asistencia - ' . $nombreCurso);
        $sheet->getStyle('A1')->applyFromArray($headerStyle);
    
        $sheet->mergeCells('A2:AK2'); // Fusionar celdas para los detalles
        $sheet->setCellValue('A2', "Institución Educativa Siglo XXI | Código DANE: 305001800368");
        $sheet->getStyle('A2')->getFont()->setBold(true);
    
        $sheet->mergeCells('A3:AK3'); // Fusionar celdas para los detalles
        $sheet->setCellValue('A3', "Telf: - 3164549278 | Email: c.p.siglo21@gmail.com");
        $sheet->getStyle('A3')->getFont()->setBold(true);
    
        // URL del escudo del colegio
        $escudoUrl = 'https://scontent-bog1-1.xx.fbcdn.net/v/t39.30808-6/370483178_286424474011785_1632106532468805365_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=730e14&_nc_ohc=w6bdidAiJA4AX9kETKF&_nc_ht=scontent-bog1-1.xx&oh=00_AfCYD6qTfTCeqmcTbnmK5bAH36JQuK8XR7rBlo7iIeWLSg&oe=64EB11FB';
    
        // Agregar el escudo del colegio desde la URL
        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing->setName('Escudo');
        $drawing->setDescription('Escudo del colegio');
        $drawing->setPath($escudoUrl); // Utilizar la URL directamente
        $drawing->setHeight(60);
        $drawing->setCoordinates('AK1');
        $drawing->setOffsetX(10);
        $drawing->setOffsetY(10);
        $drawing->setWorksheet($sheet);
    
        // Encabezados de la tabla
        $row = 5;
        $sheet->setCellValue('A' . $row, 'Nombre Completo');
    
        // Agregar los días del 1 al 31
        for ($day = 1; $day <= 31; $day++) {
            $sheet->setCellValueByColumnAndRow($day + 1, $row, $day);
        }
        $sheet->setCellValueByColumnAndRow(33, $row, 'Observaciones');
        $sheet->setCellValueByColumnAndRow(34, $row, 'Justificado');
        $sheet->setCellValueByColumnAndRow(35, $row, 'Injustificado');
        $sheet->setCellValueByColumnAndRow(36, $row, 'Atrasado');
        $sheet->setCellValueByColumnAndRow(37, $row, 'Días Inasistidos');
        
        $row++;
    
        // Agregar los nombres de los estudiantes
        foreach ($estudiantes as $estudiante) {
            $sheet->setCellValue('A' . $row, $estudiante['nombre']);
    
            // Agregar espacios en blanco para los días
            for ($day = 1; $day <= 31; $day++) {
                $sheet->setCellValueByColumnAndRow($day + 1, $row, '');
            }
    
            // Agregar espacios en blanco para las columnas adicionales
            $sheet->setCellValueByColumnAndRow(34, $row, '');
            $sheet->setCellValueByColumnAndRow(35, $row, '');
            $sheet->setCellValueByColumnAndRow(36, $row, '');
            $sheet->setCellValueByColumnAndRow(37, $row, '');
    
            $row++;
        }
    
        // Ajustar el ancho de columna automáticamente
        foreach (range('A', 'AK') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    
        // Cambiar orientación de página y tamaño de papel
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $sheet->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_LEGAL);
    
        // Aplicar formato de bordes a toda la tabla
        $borders = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];
        $sheet->getStyle('A5:AK' . ($row - 1))->applyFromArray($borders);
    
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xls($spreadsheet);
    
        // Obtener el nombre del archivo con el nombre del curso
        $nombreArchivo = 'planilla_asistencia_' . str_replace(' ', '_', $nombreCurso) . '.xls';
    
        // Establecer los encabezados del archivo
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$nombreArchivo.'"');
        header('Cache-Control: max-age=0');
    
        // Deshabilitar el almacenamiento en caché en el navegador
        header('Cache-Control: no-cache, no-store, must-revalidate'); 
        header('Pragma: no-cache'); 
        header('Expires: 0');
    
        // Salida del archivo Excel en formato XLS
        $writer->save('php://output');
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    


}
