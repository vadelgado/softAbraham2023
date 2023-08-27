<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AsignaturaVerCrear;
use Dompdf\Dompdf;
use Dompdf\Options;

class AsignaturasVerCrear extends BaseController
{
    public function index()
    {
        $asignaturas =new AsignaturaVerCrear();
        $data = $asignaturas->findAll();
        $data =['data'=> $data];
        return view('asignaturas/principal', $data);
    }

    public function regAsignatura(){

        return view('asignaturas/regAsignatura');
    }
    public function registrar(){
        $asignaturas = new AsignaturaVerCrear();
        $data = [
            'area_asignatura'=> $this->request->getPost('area'),
            'descripcion_asignatura'=> $this->request->getPost('descripcion')
        ];
        $asignaturas->insert($data);
        return redirect()->to(base_url().'Asignaturas');
    }







    public function form_editar()
    {
        if (isset($_POST['id_asignatura'])) {
            $id = $_POST['id_asignatura'];

            $asignaturas = new AsignaturaVerCrear();
            $data = $asignaturas->find($id);
            $data = ['data' => $data];

            echo json_encode($data);
                exit;
        }
        else{
            echo json_encode(['error' => 'Error al obtener las asignaturas']);
            exit;
        }   

    }
    public function edicionAsignatura(){
       
        $asignaturas = new AsignaturaVerCrear();
        $id_asignatura = $this->request->getPost('id_asignatura');
        $data = [
            'area_asignatura' => $this->request->getPost('area_asignatura'),
            'descripcion_asignatura' => $this->request->getPost('descripcion_asignatura'),
            'estado_asignatura'=> $this->request->getPost('estado_asignatura')
        ];
                
        $isCorrect = $asignaturas->actualizarAsignatura($id_asignatura, $data);
        if($isCorrect){
            return redirect()->to(base_url('/Asignaturas'))->with('mensaje', 'Asignatura actualizado con éxito');
        } 
        else{
            return redirect()->to(base_url('/Asignaturas'))->with('mensajeError', 'Ha ocurrido un error en la actualización');
        }

     }
    
    public function reporte()
    {   
        $asignaturas =new AsignaturaVerCrear();
        $data = $asignaturas->findAll();
        $data =['data'=> $data];
        return view('asignaturas/reporte', $data);
      
    }

    public function demoPDF(){
        $asignaturas =new AsignaturaVerCrear();
        $data = $asignaturas->findAll();
        $data =['data'=> $data];
        $html = view('asignaturas/reporte', $data);
        $options = new Options();
        $options->setIsRemoteEnabled(true);                
        $dompdf = new Dompdf($options);
        //$dompdf = new Dompdf();
        $dompdf->loadHtml($html);  
        $dompdf->setPaper('A4','portrait');
        $dompdf->render();
        $dompdf->stream('ReporteAsignaturas', ['Attachment' => false]);
        
    }
    
    public function eliminar($id){
        $asignaturas = new AsignaturaVerCrear();
        $asignaturas->delete($id);
        return redirect()->to(base_url().'asignaturas/principal');  
    }

    /*public function eliminar($id){
        $this->usuarios_model->eliminar_usuario($id_asignatura);
        redirect('Asignaturas'); // Redirige a la lista de usuarios u otra página
    
    }*/
   
    
    

}
