<?php

namespace Sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}


class SobreEmpresa
{
    private $Dados;


    public function index()
    {
        $listarSobEmp = new \Sts\Models\StsSobEmp();
        $this->Dados['sts_sobs_emps'] = $listarSobEmp->listarSobEmp();


        $carregarView = new \Core\ConfigView('sts/Views/sobEmp/sobEmp', $this->Dados);
        $carregarView->renderizar();
    
    }

}
