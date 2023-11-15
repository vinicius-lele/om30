<?php session()->getFlashdata('errors') ?>

<div class="container bg-light d-flex justify-content-around rounded mt-3" style="padding: 35px;">
    <form action="/pacientes/store" method="post" id="cadastra_paciente" class="text-center" enctype="multipart/form-data">
        <h1>CADASTRO DE PACIENTE</h1>
        <?= csrf_field() ?>
        <div class="row g-3 ">
            <div class="col">
                <label for="nome">Nome*:</label>
                <span class="text text-danger">
                    <?= isset(session()->getFlashdata('errors')['nome']) ? 'Campo obrigatório.' : '' ?>
                </span>
                <input class="form-control form-control-lg" type="input" name="nome" value="<?= set_value('nome') ?>">
            </div>
            <div class="col">
                <label for="nome_mae">Nome da Mãe*:</label>
                <span class="text text-danger">
                    <?= isset(session()->getFlashdata('errors')['nome_mae']) ? 'Campo obrigatório.' : '' ?>
                </span>
                <input class="form-control form-control-lg" type="input" name="nome_mae" value="<?= set_value('nome_mae') ?>">
            </div>
        </div>

        <div class="row g-3 ">
            <div class="col">
                <label for="cpf">CPF*:</label>
                <span class="text text-danger">
                    <?= isset(session()->getFlashdata('errors')['cpf']) ? session()->getFlashdata('errors')['cpf'] : '' ?>
                </span>
                <input class="form-control form-control-lg" onkeypress="$(this).mask('000.000.000-00');" type="input" 
                minlength="11" maxlength="14" name="cpf" value="<?= set_value('cpf') ?>">
            </div>
            <div class="col">
                <label for="cns">CNS*:</label>
                <span class="text text-danger">
                    <?= isset(session()->getFlashdata('errors')['cns']) ? session()->getFlashdata('errors')['cns'] : '' ?>
                </span>
                <input class="form-control form-control-lg" type="input" onkeypress="$(this).mask('000 0000 0000 0000');" 
                minlength="15" maxlength="18" name="cns" value="<?= set_value('cns') ?>">
            </div>
        </div>

        <div class="row g-3 ">
            <div class="col">
                <label for="data_nascimento">Data de Nascimento*:</label>
                <span class="text text-danger">
                    <?= isset(session()->getFlashdata('errors')['data_nascimento']) ? 'Campo obrigatório.' : '' ?>
                </span>
                <input class="form-control form-control-lg" type="date" name="data_nascimento" value="<?= set_value('data_nascimento') ?>">
            </div>
            <div class="col">
                <label for="userfile">Foto do Paciente:</label>
                <input class="form-control form-control-lg" type="file" name="userfile" size="20" />
            </div>
        </div>
        <form method="get" action=".">
            <div class="row g-3">
                <div class="col">
                    <input type="input" name="endereco" value="<?= set_value('endereco') ?>" hidden>
                </div>
            </div>
            <div class="row g-3 ">
                <div class="col">
                    <label>Cep*:</label>
                    <input class="form-control form-control-lg" onkeypress="$(this).mask('00.000-000');"
                     name="cep" type="text" id="cep" value="" size="10" maxlength="9" onblur="pesquisacep(this.value);" required />
                </div>
                <div class="col">
                    <label>Cidade*:</label>
                    <input class="form-control form-control-lg" name="cidade" type="text" id="cidade" size="40" required />
                </div>
                <div class="col">
                    <label>Estado*:</label>
                    <input class="form-control form-control-lg" name="uf" type="text" id="uf" size="2" required />
                </div>
            </div>
            <div class="row g-3 ">
                <div class="col">
                    <label>Rua*:</label>
                    <input class="form-control form-control-lg" name="rua" type="text" id="rua" size="60" required />
                </div>
                <div class="col">
                    <label>Número*:</label>
                    <input class="form-control form-control-lg" name="numero" type="text" id="numero" required />
                </div>
                <div class="col">
                    <label>Bairro*:</label>
                    <input class="form-control form-control-lg" name="bairro" type="text" id="bairro" size="40" required />
                </div>
            </div>
            <div class="row g-3" style="padding: 20px;">
                <div class="col">
                    <button type="submit" class="btn btn-primary" form="cadastra_paciente" value="Cadastra Paciente">Cadastrar Paciente</button>
                </div>
                <div class="col">
                    <a class="btn btn-danger" href="/">Voltar</a>
                </div>
            </div>
        </form>
    </form>
</div>
<script>
    const myInput = document.querySelector('input[name="numero"]');

    myInput.addEventListener("change", (e) => {
        let cep = document.getElementById('cep').value;
        cep = cep.replace(/\D/g, '');
        let endereco_completo = document.getElementById('rua').value +
            ', ' + document.getElementById('numero').value +
            ' - ' + document.getElementById('bairro').value +
            '. ' + document.getElementById('cidade').value +
            ' - ' + document.getElementById('uf').value +
            ' CEP: ' + cep;
        document.querySelector('input[name="endereco"]').value = (endereco_completo);
    });

    function limpa_formulário_cep() {
        document.getElementById('rua').value = ("");
        document.getElementById('bairro').value = ("");
        document.getElementById('cidade').value = ("");
        document.getElementById('uf').value = ("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            document.getElementById('rua').value = (conteudo.logradouro);
            document.getElementById('bairro').value = (conteudo.bairro);
            document.getElementById('cidade').value = (conteudo.localidade);
            document.getElementById('uf').value = (conteudo.uf);
        } else {
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }

    function pesquisacep(valor) {
        var cep = valor.replace(/\D/g, '');

        if (cep != "") {
            var validacep = /^[0-9]{8}$/;
            if (validacep.test(cep)) {
                document.getElementById('rua').value = "...";
                document.getElementById('bairro').value = "...";
                document.getElementById('cidade').value = "...";
                document.getElementById('uf').value = "...";
                var script = document.createElement('script');
                script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';
                document.body.appendChild(script);
            } else {
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } else {
            limpa_formulário_cep();
        }
    };
</script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
