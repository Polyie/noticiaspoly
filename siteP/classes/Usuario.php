<?php
class Usuario{
    private $id;
    private $nome;
    private $email;
    private $senha;

    public function setId($id){
        $this->id=$id;
    }
    public function getId(){
        return $this->id;
    }
    public function setNome($nome){
        $this->nome=$nome;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setEmail($email){
        $this->email=$email;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setSenha($senha){
        $this->senha=$senha;
    }

    public function getSenha(){
        return $this->senha;
    }


    public function index(){
        if (!isset($_SESSION['user'])){
            $this->login();
        }
        else {
            $this->listar();
        }

    }

    public function listar(){
        include HOME_DIR."view/paginas/usuarios/listar.php";
    }

    public function criar(){
        include HOME_DIR."view/paginas/usuarios/form_usuario.php";
    }

    public function salvar(){
        $conexao = Conexao::getConexao();
        $senhastring='12345';
        $sql = 'INSERT INTO usuario (Nome, email, senha) VALUES ("'.$_POST['nomeSalvar'].'","'.$_POST['emailSalvar'].'","'.$senhastring.'")';
        if ($conexao->query($sql)){
//            $msg['msg'] = "Usuário salvo!";
//            $msg['class'] = "primary";
//            $_SESSION['msg'] = $msg;
        }
        else{
//            $msg['msg'] = "Ocorreu um erro ao salvar usuário!";
//            $msg['class'] = "danger";
//            $_SESSION['msg'] = $msg;
        }
    }

    public function exibir($id){
        echo "O id do usuario é".$id;
    }

    public function login(){
        include HOME_DIR."view/paginas/usuarios/login.php";
    }

    public function senha(){
        include HOME_DIR."view/paginas/usuarios/senha_padrao.php";
    }

    public function deletar($id){
        $conexao = Conexao::getConexao();
        $sql = 'DELETE FROM usuario WHERE id='.$id;
        if ($conexao->query($sql)){

        }
        $this->listar();
    }

    public function trocar_senha(){
        $conexao = Conexao::getConexao();
        $sql = 'UPDATE usuario SET senha = "'.$_POST['senhaTrocar'].'" WHERE id = '.$_SESSION['user']->id;
        if ($conexao->query($sql)){

        }
    }

    public function autenticar(){
        $conexao = Conexao::getConexao();

        $email = $_POST['email'];

        $sql = 'SELECT senha FROM usuario WHERE email ="'.$email.'"';

        if ($resultado = $conexao->query($sql)) {
          echo "a";
        }
        else {
          echo "b";
        }
       $password = $resultado->fetch(PDO::FETCH_OBJ);
       if (!$password) {
         echo "senha ou email incorreto";
       }
       else {

            if ($_POST['senha'] === $password -> senha){

                $sql = 'SELECT * FROM usuario WHERE email="'.$email.'"';
                $resultado = $conexao->query($sql);

                $_SESSION['user'] = $resultado -> fetch(PDO::FETCH_OBJ);

                if ($_SESSION['user'] -> senha == '12345' ){

                    $this->senha();
                }

                else{
                    header('Location:'.HOME_URI);
                }

            }

            else{
                $this->login();
            }
          }
        }


    public function logout(){
        session_destroy();
        header('Location:'.HOME_URI);
    }

}
