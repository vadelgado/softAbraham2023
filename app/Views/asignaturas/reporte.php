<!--///////////////////////////////////////////////////////////////-->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Asignaturas</title>
    <style>
        @page {
            
            size:  216mm 356mm;
            margin: 2cm;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .header {
            display: flex;
            align-items: center;
            height: 120px;
            margin-bottom: 20px;
        }

        .logo img {
            height: 130px;
            max-width: 130px;
        }

        .header-content {
            text-align: center;
            margin-left: 20px;
        }

        h1,
        p {
            margin: 0;
            padding: 0;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 5px;
        }

        p {
            font-size: 16px;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        #inicio{
            background-color: red;
        }
    </style>
</head>

<body>

    <table>
        <tr>
            <td rowspan="3">
                <div class="logo">
                    <img src="https://scontent-bog1-1.xx.fbcdn.net/v/t39.30808-6/370483178_286424474011785_1632106532468805365_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=730e14&_nc_ohc=i8cMloBCbhUAX8EoXrW&_nc_ht=scontent-bog1-1.xx&oh=00_AfDfx_vc4vXVXN-bkDDb7ASuhvXSF_6RnvFMIDQ4zCIBZQ&oe=64EB11FB"
                        alt="Logo" class="imagen-pequena">
                </div>
            </td>
            <td>
                <h1>Institución Educativa Siglo XXI</h1>
            </td>
        </tr>
        <tr>
            <td>
                <p>Código DANE: 305001800368 :</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Telf:  3164549278 | Email: c.p.siglo21@gmail.com</p>
            </td>
        </tr>
    </table>
    <table>
        <thead>
            <tr id="inicio">
                <th scope="col">Código</th>
                <th scope="col">Área</th>
                <th scope="col">Descripción</th>
                <th scope="col">Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data as $i): ?>
            <tr>
                <td class="normal">
                    <?php echo $i['id_asignatura'] ?>
                </td>
                <td class="normal">
                    <?php echo $i['area_asignatura'] ?>
                </td>
                <td class="normal td-description">
                    <?php echo $i['descripcion_asignatura'] ?>
                </td>
                <td class="normal">
                    <?php echo $i['estado_asignatura'] ? 'Activa' : 'Inactiva'; ?>
                </td>

            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    

</html>