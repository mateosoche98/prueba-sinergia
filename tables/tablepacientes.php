<table class="table table-bordered table-striped" id="example1">
    <thead>
        <th>#</th>
        <th>Tipo Documento</th>
        <th>Numero Documento</th>
        <th>Nombre</th>
        <th>Genero</th>
        <th>Departamento</th>
        <th>Municipio</th>
        <th><span class="fa fa-edit"></span></th>
        <th><span class="fa fa-trash"></span></th>
    </thead>
    <tbody>
        <?php foreach ($datos as $row) : ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['tipo_documento']; ?></td>
                <td><?php echo $row['numero_documento']; ?></td>
                <td><?php echo $row['nombres']; ?></td>
                <td><?php echo $row['genero']; ?></td>
                <td><?php echo $row['departamento']; ?></td>
                <td><?php echo $row['municipio']; ?></td>
                <td class="text-center"><button onclick="DatosPaciente(`<?php echo $row['id']; ?>`)" class="btn btn-warning"><span class="fa fa-edit"></span></button></td>
                <td class="text-center"><button onclick="EliminarPaciente(`<?php echo $row['id']; ?>`)" class="btn btn-danger"><span class="fa fa-trash"></span></button></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>