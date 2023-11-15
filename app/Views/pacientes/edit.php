<?php session()->getFlashdata('errors') ?>
<div class="container bg-light d-flex justify-content-around rounded mt-3" style="padding: 35px;">
    <form action="/update" method="post" id="atualiza_paciente" class="text-center">
        <h1>EDITAR PACIENTE</h1>
        <?= csrf_field() ?>
        <img src="<?= esc($pacientes['image'] ?? '/assets/img/default.jpeg') ?>" height="150px" width="120px" class="rounded-circle border border-info">

        <div class="row g-3 ">
            <div class="col">
                <label for="nome">Nome:*</label>
                <span class="text text-danger">
                    <?= isset(session()->getFlashdata('errors')['nome']) ? 'Campo obrigatório.' : '' ?>
                </span>
                <input class="form-control form-control-lg" type="input" name="nome" value="<?= esc($pacientes['nome']) ?>" >
            </div>
            <div class="col">
                <label for="nome_mae">Nome da Mãe:*</label>
                <span class="text text-danger">
                    <?= isset(session()->getFlashdata('errors')['nome_mae']) ? 'Campo obrigatório.' : '' ?>
                </span>
                <input class="form-control form-control-lg" type="input" name="nome_mae" value="<?= esc($pacientes['nome_mae']) ?>" >
            </div>
        </div>

        <div class="row g-3">
            <div class="col">
                <label for="data_nascimento">Data de Nascimento:*</label>
                <span class="text text-danger">
                    <?= isset(session()->getFlashdata('errors')['data_nascimento']) ? 'Campo obrigatório.' : '' ?>
                </span>
                <input class="form-control form-control-lg" type="date" name="data_nascimento" value="<?= esc($pacientes['data_nascimento']) ?>" >
            </div>
            <div class="col">
                <label for="cpf">CPF:*</label>
                <span class="text text-danger">
                    <?= isset(session()->getFlashdata('errors')['cpf']) ? session()->getFlashdata('errors')['cpf'] : '' ?>
                </span>
                <input class="form-control form-control-lg" type="input" onkeypress="$(this).mask('000.000.000-00');" 
                name="cpf" value="<?= esc($pacientes['cpf']) ?>" >
            </div>
            <div class="col">
                <label for="cns">CNS:*</label>
                <span class="text text-danger">
                    <?= isset(session()->getFlashdata('errors')['cns']) ? session()->getFlashdata('errors')['cns']  : '' ?>
                </span>
                <input class="form-control form-control-lg" type="input" onkeypress="$(this).mask('000 0000 0000 0000');" 
                name="cns" value="<?= esc($pacientes['cns']) ?>" >
            </div>
        </div>

        <div class="row g-3">
            <div class="col">
                <label for="endereco">Endereço:*</label>
                <span class="text text-danger">
                    <?= isset(session()->getFlashdata('errors')['endereco']) ? 'Campo obrigatório.' : '' ?>
                </span>
                <input class="form-control form-control-lg" type="input" name="endereco" value="<?= esc($pacientes['endereco']) ?>" >
            </div>
        </div>
        <div class="row g-3">
            <div class="col">
                <input type="input" name="id" value="<?= esc($pacientes['id']) ?>" hidden>
            </div>
        </div>
        <div class="row g-3" style="padding: 20px;">
            <div class="col">
                <button type="submit" form="atualiza_paciente" class="btn btn-info g-3">Atualizar</button>
            </div>
            <div class="col">
                <a class="btn btn-danger" href="/">Voltar</a>
            </div>
        </div>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
