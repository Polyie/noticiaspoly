<?php

class Comentario{

    /**
     * Identificador
     * @access private
     * @name id
     */
    private $id;

    /**
     * Comentario
     * @access private
     * @name comentario
     */
    private $comentario;

    /**
     * Data
     * @access private
     * @name data
     */
    private $data;

    /**
     * Noticia a qual pertence
     * @access private
     * @name noticia
     */
    private $noticia;

    /**
     * Usuario
     * @access private
     * @name usuario
     */
    private $usuario;

    public function setId($id){
        $this->id=$id;
    }

    public function getId(){
        return $this->id;
    }

    public function setComentario($comentario){
        $this->comentario=$comentario;
    }

    public function getComentario(){
        return $this->comentario;
    }

    public function setDatad($data){
        $this->data=$data;
    }

    public function getData(){
        return $this->data;
    }

    public function setNoticia($noticia){
        $this->noticia=$noticia;
    }

    public function getNoticia(){
        return $this->noticia;
    }

    public function setUsuario($usuario){
        $this->usuario=$usuario;
    }

    public function getUsuario(){
        return $this->usuario;
    }

}
