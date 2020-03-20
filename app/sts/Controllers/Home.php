<?php

namespace Sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}


class Home
{

    private $Dados;

    public function index()
    {

        $listar_car = new \Sts\Models\StsCarousel();
        $this->Dados['sts_carousels'] = $listar_car->listar();

        $listar_serv = new \Sts\Models\StsServico();
        $this->Dados['sts_servicos']=$listar_serv->listar();

        $listar_video = new \Sts\Models\StsVideo();
        $this->Dados['sts_videos']= $listar_video->listar();
        
        $listar_art = new \Sts\Models\StsArtigos();
        $this->Dados['sts_artigos'] = $listar_art->listar();
        

        $carregarView = new \Core\ConfigView("sts/Views/home/home", $this->Dados);
        $carregarView->renderizar();
    }

}
