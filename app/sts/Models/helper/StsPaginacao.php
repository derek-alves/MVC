<?php

namespace Sts\Models\helper;
if (!defined('URL')) {
    header("Location: /");
    exit();
}

class StsPaginacao{
    private $Link;
    private $MaxLinks;
    private $Pagina;
    private $LimitResultlado;
    private $Offset;
    private $Query;
    private $ResultBd;
    private $Resultado;


    function getResultado(){

        return $this->Resultado;
    }


    function __construct($Link)
    {
        $this->Link = $Link;
        $this->MaxLinks = 2;
    }

    public function condicao($Pagina , $LimitResultlado)
    {
       $this->Pagina = (int) $Pagina ? $Pagina : 1;
       $this->LimitResultlado = (int) $LimitResultlado;
       $this->Offset = ($this->Pagina * $this->LimitResultlado) - $this->LimitResultlado;
    }

    public function paginacao($Query, $ParseString = null){

        $this->Query = (string) $Query;
        $this->ParseString = (string) $ParseString;
        $contar = new \Sts\Models\helper\StsRead();
        $contar->fullRead($this->$Query,$this->$ParseString);
        $this->ResultBd = $contar->getResultado();

        if($this->ResultBd[0]['num_result'] > $this->LimitResultlado){

            $this->instrucaoPaginacao();

        }else{

            $this->Resultado = null;
        }
    }

    private function instrucaoPaginacao(){

        $paginas = ceil($this->Resultado[0]['num_result']/ $this->LimitResultlado);

        $this->Resultado = "<nav aria-label='paginacao'>";
        $this->Resultado .= "<ul class='pagination justify-content-center'>";
        $this->Resultado .= "<li class='page-item'>";
        $this->Resultado .= "<a class='page-link' href=\"{$this->Link}\" tabindex='-1'>Primeira</a>";
        $this->Resultado .= "</li>";
        $this->Resultado .= "<li class='page-item'><a class='page-link' href='#'>1</a></li>";
        $this->Resultado .= "<li class='page-item active'>";
        $this->Resultado .= "<a class='page-link' href='#'>2 <span class='sr-only'>(current)</span></a>";
        $this->Resultado .= "</li>";
        $this->Resultado .= "<li class='page-item'><a class='page-link' href='#'>3</a></li>";
        $this->Resultado .= "<li class='page-item'>";
        $this->Resultado .= "<a class='page-link' href='#'>Next</a>";
        $this->Resultado .= "</li>";
        $this->Resultado .= "</ul>";
        $this->Resultado .= "</nav>";
    }
}