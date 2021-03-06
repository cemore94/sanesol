 <?php

include '../../config/database.php';
include '../../objects/cliente.php';

$database  = new Database();
$db        = $database->getConnection();
$cliente = new Cliente($db);

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != null) ? $_REQUEST['action'] : '';


if ($action == 'ajax') {
    
    $q = strip_tags($_REQUEST['q'], ENT_QUOTES); 
    $aColumns = array('nombres', 'tipo_documento', 'num_documento');
    $sWhere = "";
    if ($_GET['q'] != "") {
        $sWhere = "WHERE (";
        for ($i = 0; $i < count($aColumns); $i++) {
            $sWhere .= $aColumns[$i] . " LIKE '%" . $q . "%' OR ";
        }
        $sWhere = substr_replace($sWhere, "", -3);
        $sWhere .= ')';
    }

    $sWhere .= "ORDER BY idcliente DESC";
    include '../../pagination/pagination.php';

    $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
    $p_page = (isset($_REQUEST['per_page']) && !empty($_REQUEST['per_page'])) ? $_REQUEST['per_page'] : 0;
    $per_page = $p_page;
    $adjacents = 4;
    $offset = ($page - 1) * $per_page;
    $numrows = $cliente->nRows($sWhere);
    $val     = $per_page * $page;
    if ($val > $numrows) {
        $val = $numrows;
    }
    $total_pages = ceil($numrows / $per_page);
    $reload = 'index.php';
    $stmt         = $cliente->readAllPaginate($sWhere, $offset, $per_page);
    $hayRegistros = $stmt->rowCount();
    if ($hayRegistros > 0) {
            ?>
            <div class="table-responsive">
              <table class="table table-condensed table-striped table-bordered table-hover">
                <tbody>
                  <tr>
                    <th>Id</th>
                    <th>Cliente</th>
                    <th>Tipo de Documento</th>
                    <th>Num. Documento</th>
                    <th>Teléfono</th>
                    <th>E-Mail</th>
                    <th>Opciones</th>
                  </tr>
                  <?php
                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                    <tr>
                      <td id="cliente-id"><?php echo $row['idcliente']; ?></td>
                      <td id="cliente"><span class="fa fa-user"></span> <?php echo $row['nombres']; ?></td>
                      <td><?php echo $row['tipo_documento']; ?></td>
                      <td><?php echo $row['num_documento']; ?></td>
                      <td><span class="fa fa-phone"></span> <?php echo $row['telefono']; ?></td>
                      <td><span class="fa fa-envelope"></span> <a href="#"><?php echo $row['email']; ?></a></td>
                      <td>
                        <button type="button" class="btn btn-info" id="btn-edit">Editar</button>
                        <button type="button" class="btn btn-danger" id="btn-remove">Eliminar</button>
                      </td>
                    </tr>
                  <?php
                  }
                 ?>

                </tbody>
              </table>
            </div>
            <div class="row">
              <div class="col-sm-6">
                Mostrando  del <?php echo $offset + 1; ?> al <?php echo $val; ?> de <?php echo $numrows; ?> Registro(s)
              </div>
              <div class="col-sm-6">
                <span class='pull-right'>
                        <?php echo paginate($reload, $page, $total_pages, $adjacents); ?>
                </span>
              </div>
            </div>
            <?php
    } else {
        ?>
          <div class="alert alert-info">No se encontró registros</div>
          <?php
    }
}

?>
