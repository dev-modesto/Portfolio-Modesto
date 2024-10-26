<?php
    function dataFormatadaMesAno($data) {

        $mesesPtbr = [
            'Jan' => 'Jan',
            'Feb' => 'Fev',
            'Mar' => 'Mar',
            'Apr' => 'Abr',
            'May' => 'Mai',
            'Jun' => 'Jun',
            'Jul' => 'Jul',
            'Aug' => 'Ago',
            'Sep' => 'Set',
            'Oct' => 'Out',
            'Nov' => 'Nov',
            'Dec' => 'Dez',
        ];

        $data = new DateTime($data);
        $mes = date_format($data, "M");
        $ano = date_format($data, "Y");
        $dataFormatada = $mesesPtbr[$mes] . '/' . $ano;
        return $dataFormatada;
    }
