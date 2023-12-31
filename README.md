# #PREPARANDO O AMBIENTE
### Arquivo .env
É necessário rodar o seguinte comando para criar o arquivo de configuração:

```
cp .env.example .env
```

Dentro do arquivo ```.env``` editar as linhas com as configurações de seu banco de dados:

```
 database.default.hostname = <host do banco>
 database.default.database = <nome do banco>
 database.default.username = <usuario>
 database.default.password = <senha>
 database.default.DBDriver = Postgre
 # database.default.DBPrefix =
 database.default.port = <porta do banco>
```

### Instalando as dependências do composer:
Utilize o seguinte comando:
```
composer install
```

# #BANCO DE DADOS
### Criando o banco de dados :
```
php spark db:create <nome do banco>
```
##### ```'<nome do banco>' deve ser o mesmo que foi colocado no arquivo .env```

### Criando a tabela (com migrations):
```
php spark migrate
```
### Populando a tabela (com seeders):
```
php spark make:seeder pacientes
```

# #SUBINDO E TESTANDO A APLICAÇÃO
### Iniciar o servidor:
```
php spark serve
``` 

### Acessando o sistema:
No navegador acesse: ```http://localhost:8080```

# #O PROJETO
### Linguagens:
Para o frontend foi utilizado Boostrap e Javascript. Já para o backend foi utilizado PHP com framework CodeIgniter.

### Validações:
As validações responsáveis pelos documentos (CNS e CPF) e dados pessoais estão no backend, enquanto que as validações do endereço estão no frontend (com Javascript) utilizando api do [viaCEP](https://viacep.com.br/)).

### Usando o sistema:
Ao acessar a página inicial, o usuário se depara com a listagem dos pacientes já cadastrados (filtrado apenas Nome, CPF e CNS), podendo fazer a exclusão ou edição dos mesmos.
Na página de Cadastro de pacientes o usuário tem a opção de além de inserir os dados do paciente (obrigatório), inserir uma foto (opcional)
Na página de edição o usuário pode ver e editar caso necessário todos os dados e visualizar a foto do paciente(caso tenha sido inserida no cadastro).


# #OBSERVAÇÕES

### API:

[Seguindo a documentação](https://codeigniter.com/user_guide/incoming/filters.html#except-for-a-few-uris) não obtive êxito ao criar rotas de API, pois sempre me retornava erro de segurança como esse abaixo:

```
{
    "title": "CodeIgniter\\Security\\Exceptions\\SecurityException",
    "type": "CodeIgniter\\Security\\Exceptions\\SecurityException",
    "code": 403,
    "message": "The action you requested is not allowed.",
    "file": "C:\\xampp\\htdocs\\om30\\vendor\\codeigniter4\\framework\\system\\Security\\Security.php",
    "line": 300
}
```


# #PADRÕES

### Comits 
Os padrões de commits foram criados baseados no [Conventional Commits](https://www.conventionalcommits.org/en/v1.0.0/).