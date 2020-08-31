<?php
class Noticia{
       /**
       * Identificador
       * @access private
       * @name id
       */
      private $id;
       /**
       * Titulo Noticia
       * @access private
       * @name titulo
       */
      private $titulo;
       /**
       * Decrição
       * @access private
       * @name descricao
       */
      private $descricao;
       /**
       * Comentarios
       * @access private
       * @name comentarios
       */
      private $comentarios;
       /**
       * Data
       * @access private
       * @name data
       */
      private $data;

       /**
       * Usuario
       * @access private
       * @name usuario
       */
      private $usuario;
       /**
       * @access public
       * @param id
       */


       public function setId($id){
           $this->id=$id;
       }

       /**
        * @access public
        * @return id
        */
       public function getId(){
           return $this->id;
       }

       /**
        * @access public
        * @param titulo
        */
       public function setTitulo($titulo){
           $this->titulo=$titulo;
       }

       /**
        * @access public
        * @return titulo
        */
       public function getTitulo(){
           return $this->titulo;
       }

       /**
        * @access public
        * @param descricao
        */
       public function setDescricao($descricao){
           $this->descricao=$descricao;
       }

       /**
        * @access public
        * @return descricao
        */
       public function getDescricao(){
           return $this->descricao;
       }

       /**
        * @access public
        * @param comentarios
        */
       public function setComentarios($comentarios){
           $this->comentarios=$comentarios;
       }

       /**
        * @access public
        * @return comentarios
        */
       public function getComentarios(){
           return $this->comentarios;
       }

       /**
        * @access public
        * @param data
        */
       public function setData($data){
           $this->data=$data;
       }

       /**
        * @access public
        * @return data
        */
       public function getData(){
           return $this->data;
       }

       /**
        * @access public
        * @param usuario
        */
       public function setUsuario($usuario){
           $this->usuario=$usuario;
       }

       /**
        * @access public
        * @return usuario
        */
       public function getUsuario(){
           return $this->usuario;
       }

       public function index(){
           $this->listar();
        }

    public function listar(){
        $conexao=Conexao::getConexao();

        $resultado=$conexao->query(
            "SELECT id, titulo, descricao,DATE_FORMAT(data, '%d/%m/%Y') AS data, (SELECT nome FROM usuario WHERE id=noticia.usuario_id) AS nome_usuario FROM noticia ORDER BY id DESC LIMIT 5"
        );
        $noticias=null;
        while($noticia=$resultado->fetch(PDO::FETCH_OBJ)){
            $noticias[]=$noticia;
        }
        include HOME_DIR."view/paginas/noticias/noticias.php";
    }
    public  function salvar(){
            $sql="INSERT INTO noticia (usuario_id, titulo, descricao,data) VALUES (".$_SESSION['usuario']['id'].",)";
    }

    public  function nova(){
        if(isset($_SESSION['usuario'])){
            /**chamar a tela de cadastro de noticia */
        }else{
            header("location:index.php");
        }
    }

    public  function ver($id){
        $conexao=Conexao::getConexao();
        $resultado=$conexao->query(
            "SELECT id, titulo, descricao,DATE_FORMAT(data, '%d/%m/%Y') AS data,
             (SELECT nome FROM usuario WHERE id=noticia.usuario_id) AS nome_usuario
             FROM noticia
             WHERE id=".$id
        );

        $_SESSION['id-noticia'] = intval($id);
        $noticia=$resultado->fetch(PDO::FETCH_OBJ);

        $resultado=$conexao->query(
            "SELECT comentario,nome FROM comentario where noticia_id = $id"
        );


        $comentarios=null;


        while($comentario=$resultado->fetch(PDO::FETCH_OBJ)){
            $comentarios[]=$comentario;
        }

        include HOME_DIR."view/paginas/noticias/noticia.php";
    }



    public function novaNoticia(){

        $envio = filter_input(INPUT_POST, 'button', FILTER_SANITIZE_STRING);

        if(isset($envio)){

            $titulo = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
            $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
            
            $id = $_SESSION['id'];
            $id = intval($id);

            $data = date("Ymd");
            $data = intval($data);

            $cnx=Conexao::getConexao();
            $noticiasinserir = "INSERT INTO noticia (id, titulo, descricao, data, usuario_id) VALUES (0, '$titulo', '$descricao', $data, $id)";

            // manda para a página de listar

            $exec = $cnx->prepare($noticiasinserir);
            $exec->execute();
            $this->listar();
        }
    }

     public function novoComentario($id){

        $envio = filter_input(INPUT_POST, 'button', FILTER_SANITIZE_STRING);

        if(isset($envio)){
        $id_noticia = $_SESSION['id-noticia'];
        $comentario = filter_input(INPUT_POST, 'coment', FILTER_SANITIZE_STRING);

            if(isset($_SESSION['nome'])){
                $nome = $_SESSION['nome'];
            }else{
                $nome = 'Indefinido';
            }

            $cnx=Conexao::getConexao();

            $insert = "INSERT INTO comentario (id, comentario, nome, noticia_id) VALUES (0, '$comentario', '$nome', $id_noticia)";
            var_dump($insert);

            $resultado = $cnx->prepare($insert);
            $resultado->execute();
            $this->ver($id);

        }
     }

     public function delete($noticia_id){

         $conexao=Conexao::getConexao();

         $delete = "DELETE FROM comentario WHERE noticia_id=$id";
         $resultado = $conexao->prepare($delete);
         $resultado->execute();

         $delete = "DELETE FROM noticia WHERE id=$id";
         $resultado = $conexao->prepare($delete);
         $resultado->execute();

         $this->listar();

     }
     public  function addNoticia(){
         include HOME_DIR."view/paginas/noticias/form_noticia.php";
     }


    public  function excluir(){

    }

}


?>
