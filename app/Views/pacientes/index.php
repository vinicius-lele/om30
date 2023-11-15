   <div class="container bg-light d-flex-column justify-content-center rounded mt-5" style="padding: 35px;">
       <div class="row g-3 ">
           <div class="col">
               <h1>Pacientes</h1>
           </div>
           <div class="row g">
               <div class="col">
                   <a class="btn btn-secondary" href="/new">Cadastrar Paciente</a>
               </div>
           </div>
       </div>
       <?php if (!empty($pacientes) && is_array($pacientes)) : ?>
           <div class="row mt-4">
               <div class="col">
                   <table class="table table-striped table-dark table-hover">
                       <thead class="thead-dark">
                           <tr>
                               <th scope="col">Nome</th>
                               <th scope="col">CPF</th>
                               <th scope="col">CNS</th>
                               <th scope="col">Ações</th>
                           </tr>
                       </thead>
                       <tbody>
                           <?php foreach ($pacientes as $paciente) : ?>
                               <tr>
                                   <td><?= esc($paciente['nome']) ?></td>
                                   <td><?= esc($paciente['cpf']) ?></td>
                                   <td><?= esc($paciente['cns']) ?></td>
                                   <td>
                                       <a class="btn btn-primary btn-sm m-1" 
                                            href="/<?= esc($paciente['id']) ?>">
                                            <i class="bi bi-trash-fill"></i> Excluir
                                        </a>
                                       <a class="btn btn-primary btn-sm m-1" 
                                            href="/edit/<?= esc($paciente['id']) ?>"
                                            ><i class="bi bi-pencil-fill"></i> Editar
                                       </a>
                                   </td>
                               </tr>
                           <?php endforeach ?>
                       <?php else : ?>
                           Nenhum paciente encontrado.
                       <?php endif ?>
                       </tbody>
                   </table>
               </div>
           </div>
   </div>
