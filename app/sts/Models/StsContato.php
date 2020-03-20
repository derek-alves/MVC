<?php

namespace Sts\Models;


class StsContato
{
    private $Resultado;
    private $Dados;


    function getResultado()
    {
        return $this->Resultado;
    }

    public function cadContato(array $Dados)

    {
        $this->Dados = $Dados;
        $this->validarDados();
        if($this->Resultado){


            $this->inserir();

        }
        
    }

    public function validarDados()
    {
        $this->Dados = array_map('strip_tags',$this->Dados);
        $this->Dados = array_map('trim',$this->Dados);
        if(in_array('',$this->Dados)){
            $_SESSION['msg'] = "<div class='alert-danger'>Para enviar a mensagem preencha todos os campos!</div>";
            $this->Resultado = false;
        }else{

            if(filter_var($this->Dados['email'],FILTER_VALIDATE_EMAIL)){
                $this->Resultado = true;
            }else{
                $_SESSION['msg'] = "<div class='alert-danger'>E-mail invalido!</div>";
                $this->Resultado = false;

            }
            

        }   
    
    }
    private function inserir(){
        $cadContato = new \Sts\Models\helper\StsCreate();
        $cadContato->exeCreate('sts_contatos',$this->Dados);
        if($cadContato->getResultado()){

            $_SESSION['msg'] = "<div class='alert-success'>Mensagem enviado com sucesso!</div>";
            $this->Resultado = true;
        }else{
            $_SESSION['msg'] = "<div class='alert-danger'>Mensagem não foi enviada!</div>";
            $this->Resultado = false;

        }

    }

}