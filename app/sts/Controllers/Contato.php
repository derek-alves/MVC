<?php

namespace Sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Contato
{

    private $Dados;

    public function index()
    {
     $this->Dados = filter_input_array(INPUT_POST,FILTER_DEFAULT);

     if(!empty($this->Dados['CadMsgCont'])){
         unset($this->Dados['CadMsgCont']);
        $cadContato = new \Sts\Models\StsContato();
        $cadContato->cadContato($this->Dados);
        if($cadContato->getResultado())
        {
            $this->Dados['form'] = null;
        
        }else{
            $this->Dados['form'] = $this->Dados;

        }
        

     }
    
        $CarregarView =  new \Core\ConfigView('sts/Views/contato/contato',$this->Dados);
        $CarregarView->renderizar();
    }

}
