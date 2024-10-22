<?php


function filtroCertificadosDesk($con) {

    ?>
        <div class="container-filtro" role="group">
            <button class="filtro-button active" name="categoria" value="0">TODOS</button>

            <?php 
                $cAreaFormacao = cAreaFormacao($con);

                while ($arrayAreaFormacao = mysqli_fetch_assoc($cAreaFormacao)) {

                    $idAreaFormacao = $arrayAreaFormacao['id_area_formacao'];
                    $nomeAreaFormacao = $arrayAreaFormacao['nome'];
                    $nomeAreaFormacao = strtoupper($nomeAreaFormacao);
                    ?>
                        <button class="filtro-button" name="categoria" value="<?= $idAreaFormacao ?>"><?= $nomeAreaFormacao?></button>
                    <?php
                }
            ?>
        </div>
    <?php

}

function filtroCertificadosMobile($con) {

    ?>
        <div class="filtro-certificados-mobile">
            <select name="filtro-mobile-select" class="filtro-button-min" id="filtro-mobile-select">
                <option class="" value="0">TODOS</option>

                <?php 
                    $cAreaFormacao = cAreaFormacao($con);

                    while ($arrayAreaFormacaoMin = mysqli_fetch_assoc($cAreaFormacao)) {

                        $idAreaFormacaoMin = $arrayAreaFormacaoMin['id_area_formacao'];
                        $nomeAreaFormacaoMin = $arrayAreaFormacaoMin['nome'];
                        $nomeAreaFormacaoMin = strtoupper($nomeAreaFormacaoMin);
                        ?>
                            <option class="" value="<?= $idAreaFormacaoMin ?>"><?= $nomeAreaFormacaoMin ?></option>
                        <?php
                    }
                ?>
            </select>
            <button type="submit" class="filtro-mobile-button">Filtrar</button>
        </div>
    <?php

}

function filtroProjetosDesk($con) {
    
    ?>
        <div class="container-filtro projetos" role="group">
            <button class="filtro-button projeto active" name="categoria" value="0">TODOS</button>

            <?php 
                $cCategoriaProjeto = cCategoriaProjeto($con);

                foreach ($cCategoriaProjeto as $valor) {
                    $idCategoria = $valor['id_categoria'];
                    $nomeCategoria = $valor['nome'];
                    $nomeCategoria = strtoupper($nomeCategoria);
                    ?>
                        <button class="filtro-button projeto" name="categoria" value="<?= $idCategoria ?>"><?= $nomeCategoria?></button>
                    <?php
                }
            ?>
        </div>
    <?php

}

?>