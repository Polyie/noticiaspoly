<?php
class Conexao {
  private static $conexao=null;
   /**
   * @author Cândido
   * @access public
   * @since 09/07/2020
   * @copyright GPL 2020 INFO CIMOL
   * @version 0.1
   */

  static public function getConexao(){
          if(!self::$conexao){
      return new PDO (SGBD.":host=".HOST_DB.";dbname=".DB."",USER_DB, PASS_DB);
          }
      return self::$conexao;
  }

}
