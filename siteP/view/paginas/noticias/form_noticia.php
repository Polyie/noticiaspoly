<main>

    <form action="<?php echo HOME_URI;?>noticia/novaNoticia" method="POST">
        

        <?php
                if(isset($_SESSION['erro'])){
                    echo  "<div class='alert alert-danger' role='alert'>".$_SESSION['erro']."</div>";  
                    unset($_SESSION['erro']);
                }
            ?>

        <div class='centro'>

        <h3>Cadastro de Notícias</h3>
            <div class="form-group">
                <input class="form-control" type="text" name="title" placeholder="Título da notícia" required />
                <textarea class="form-control" name="descricao" rows="3" placeholder="Descrição da notícia"></textarea>
            </div>

            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="button" value="Cadastrar" />
            </div>
        </div>


    </form>

</main>