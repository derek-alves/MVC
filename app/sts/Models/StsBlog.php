<?php

namespace Sts\Models;


if (!defined('URL')) {
    header("Location: /");
    exit();
}

class StsBlog{
    private $Resultado;
    private $PageId;
    private $ResultadoPg;


    function getResultadoPg(){

        return $this->ResultadoPg;
    }

    public function ListarArtigos($PageId = null){

        $this->PageId = (int) $PageId;
        $paginacao = new \Sts\Models\helper\StsPaginacao(URL.'blog');

        $paginacao->condicao($this->PageId, 3);
        $paginacao->paginacao('SELECT COUNT(id) AS num_result 
        FROM sts_artigos
        WHERE adms_sit_id =:adms_sit_id', 'adms_sit_id=1');

        $this->ResultadoPg = $paginacao->getResultado();


        $listar = new \Sts\Models\helper\StsRead();
        $listar->fullRead('SELECT id, titulo, descricao, imagem, slug FROM sts_artigos
        WHERE adms_sit_id =:adms_sit_id
        ORDER BY id DESC
        LIMIT :limit','adms_sit_id=1&limit=5');

       $this->Resultado = $listar->getResultado();
       return $this->Resultado;
    }


}




?>