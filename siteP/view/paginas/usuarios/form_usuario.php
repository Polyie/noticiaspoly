<main>
    <form action="<?php echo HOME_URI;?>usuario/salvar" method="POST">
        <legend>Cadastro</legend>
        <div class="form-group">
            <label for="inputEmailCadastro">Endereço de Email</label>
            <input type="email" name="emailSalvar" class="form-control" id="inputEmailCadastro" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="inputNomeCadastro">Nome Completo</label>
            <input type="text" name="nomeSalvar" class="form-control" id="inputNomeCadastro" placeholder="Nome Completo">
        </div>
        <div class="form-group">
            <label>
                <select class="form-control" name="funcaoSalvar">
                    <option value="0">Aluno</option>
                    <option value="1">Professor</option>
                    <option value="2">Administrador</option>
                </select>
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
        <a class="btn btn-danger" href="<?php echo HOME_URI;?>usuario">Voltar</a>

    </form>
</main>