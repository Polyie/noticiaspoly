<html>
<main>
<div class="panel-heading"><h1>Notícias</h1></div>

<?php
if(isset($noticias)){
    foreach($noticias AS $noticia){
    ?>
    <div class="panel panel-primary">
    <div class="panel-heading"><h2><?php echo $noticia->titulo ?></h2></div>
        <?php echo substr($noticia->descricao,0,180)."..." ?>
        <a href="<?php echo HOME_URI."noticia/ver/".$noticia->id;?>">Ler mais</a>
        <div class='data'>
          <div>
          <span class="label label-primary"><?php echo $noticia->data ?></span>
          <span class="label label-primary"><?php echo "Por:".$noticia->nome_usuario ?></span>
          <?php
                      if(isset($_SESSION['nome']) && $_SESSION['nome'] == $noticia->nome_usuario){
                      echo "<a class='btn' href='" . HOME_URI . "noticia/delete/" . $noticia->id ."' >Deletar</a>";
                      }
                  ?>
        </div>
      </div>
    </div>
    <?php
        }}
        if(isset($_SESSION['user'])){
            echo "<a href='" .HOME_URI. "noticia/addNoticia' class='btn'>Nova Notícia</a>";
        }
    ?>
</main>
</html>
