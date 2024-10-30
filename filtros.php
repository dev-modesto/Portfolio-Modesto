<?php


function filtroCertificadosDesk($con) {

    ?>
        <div class="container-filtro" role="group">
            <button class="filtro-btn filtro-btn-certificado active" name="categoria" value="0">TODOS</button>

            <?php 
                $cAreaFormacao = cAreaFormacao($con);

                while ($arrayAreaFormacao = mysqli_fetch_assoc($cAreaFormacao)) {

                    $idAreaFormacao = $arrayAreaFormacao['id_area_formacao'];
                    $nomeAreaFormacao = $arrayAreaFormacao['nome'];
                    $nomeAreaFormacao = strtoupper($nomeAreaFormacao);
                    ?>
                        <button class="filtro-btn filtro-btn-certificado" name="categoria" value="<?= $idAreaFormacao ?>"><?= $nomeAreaFormacao?></button>
                    <?php
                }
            ?>
        </div>
    <?php

}

function filtroCertificadosMobile($con) {

    ?>
        <div class="filtro-certificados-mobile">
            <select name="filtro-mobile-select" class="filtro-btn-min" id="filtro-mobile-select">
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
            <button class="filtro-btn filtro-btn-projeto projeto active" name="categoria" value="0">TODOS</button>

            <?php 
                $cCategoriaProjeto = cCategoriaProjeto($con);
                $arrayCategoriaProjeto = mysqli_fetch_all($cCategoriaProjeto, MYSQLI_ASSOC); 
                foreach ($arrayCategoriaProjeto as $valor) {
                    $idCategoria = $valor['id_categoria'];
                    $nomeCategoria = $valor['nome'];
                    $nomeCategoria = strtoupper($nomeCategoria);
                    ?>
                        <button class="filtro-btn filtro-btn-projeto" name="categoria" value="<?= $idCategoria ?>"><?= $nomeCategoria?></button>
                    <?php
                }
            ?>
        </div>
    <?php

}

function filtroProjetosMobile($con) {

    ?>
        <div class="filtro-mobile-projetos">

           <div class="filtro-select">
                <div class="container-select-cabecalho">
                    <button class="btn-cabecalho-select peso-semi-bold">TODOS<span class="material-symbols-rounded ico-icodown-projetos">keyboard_arrow_down</span></button>
                    <div class="container-select-conteudo">

                        <?php 
                            $cCategoriaProjeto = cCategoriaProjeto($con);
                            $arrayCategoriaProjeto = mysqli_fetch_all($cCategoriaProjeto, MYSQLI_ASSOC); 

                            ?>
                                <button class="filtro-btn-conteudo-select ativo peso-semi-bold" value="0"> TODOS</button>
                            <?php

                            foreach ($arrayCategoriaProjeto as $valor) {

                                $idCategoriaProjeto = $valor['id_categoria'];
                                $nomeCategoriaProjeto = $valor['nome'];
                                $nomeCategoriaUpperCase = strtoupper($nomeCategoriaProjeto);

                                ?>
                                    <button class="filtro-btn-conteudo-select peso-semi-bold" value="<?= $idCategoriaProjeto ?>"><?= $nomeCategoriaUpperCase ?></button>
                                <?php
                            }
                        ?>
                    </div>
                </div>
           </div>
        </div>
    <?php

}

?>