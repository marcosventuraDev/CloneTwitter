<?php

namespace App\Controllers;
use MF\Controller\Action;
use MF\Model\Container;



class indexController extends Action{

    public function index(){

        $this->render('index');
  } 

  
    public function inscreverse(){

        $this->view->usuario = array(
            'nome'=> '',
            'email'=> ''
        );
        $this->view->erroCadastro= false;
        $this->render('inscreverse');

    }
    public function registrar(){

        //receber os dados do formulario

        $usuario = Container::getModel('Usuario');

        $usuario->__set('nome', $_POST['nome']);
        $usuario->__set('email', $_POST['email']);
        $usuario->__set('senha', $_POST['senha']);

        if($usuario->validarCadastro() && count($usuario->getUsuarioPorEmail())==0){

         
            $usuario->salvar();
            $this->render('cadastro');
     

        }else{

            $this->view->usuario = array(
                'nome'=> $_POST['nome'],
                'email'=> $_POST['email']
            );

            $this->view->erroCadastro = true;
            $this->render('inscreverse');

        }
      
       

     
    }

}