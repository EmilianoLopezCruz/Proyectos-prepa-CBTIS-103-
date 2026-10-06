<?php
$frases=array('
Destaca con elegancia en cada ocasión.',
'Sofisticación que te hará brillar.',
'El vestido perfecto para deslumbrar.',
'Glamour que marca tendencia.',
'Un toque de magia para tu look.',
'Frescura y estilo en cada paso.',
'Diseñado para robar miradas.',
'La combinación perfecta de moda y confort.',
'Elegancia que habla por sí sola.',
'La opción ideal para cualquier evento.',
'Crea momentos memorables con este diseño.',
'Romántico, único y lleno de estilo.',
'Un clásico renovado para lucir impecable.',
'Haz de este vestido tu nuevo favorito.',
'La prenda que necesitas para destacar.'
);


include('cnn.php');
$criteriosBusqueda = $_POST['s_bar'];
$stmt = $cnn->prepare('SELECT * FROM Vestidos WHERE nom_vestido LIKE :criterios');
$stmt->execute(['criterios' => '%' . $criteriosBusqueda . '%']);
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
if($stmt->rowCount()>0){
    $regConHtml = '';
    foreach ($resultados as $diseño) {
        $idDiseño= $diseño['id_vestido'];
        $nombreDiseño = $diseño['nom_vestido'];
        $direccionDiseño= $diseño['img_vestido'];
        $regConHtml .= '
        <div class="imagenVestido">
            <div class="contenedorImagen">
                <a href=vestido.php?id=' . $idDiseño . '>
                    <img src="' . $direccionDiseño . '" alt="Vestido ' . $idDiseño . '">
                    <div class="descripcion"><b>' . $frases[random_int(0, 14)] . '</b></div>
                </a>
            </div>
            <p><b>' . $nombreDiseño . '</b></p>
        </div>';
    }
    // echo $regConHtml;
    echo json_encode($regConHtml);
}
?>