# Avaliação Gerencial 

## Pré-requisitos

Antes de começar, verifique se você atendeu aos seguintes requisitos:

* Você necessita ter instalado 
    `PHP 8.1 ou Superior / <br>
    Composer 2.2.6 ou superior 
    / Apache2 2.4.52 ou superior 
    / Laravel 9.0 ou superior>`
* Compatível com  `<Windows / Linux / Mac>`.


## Instalando o projeto 

Para instalação, siga estas etapas:

Linux :
```
1 - Faça a clonagem do repositório dentro da pasta /var/www/hmtl.
    1.1 - Sugestão: Dê permissão 755 de forma recursiva para a pasta /var e adicione o seu usuário ao grupo de donos da pasta. 
2 - Após a clonagem do projeto, abra o mesmo em seu editor de texto. 
3 - Utilize o comando composer update para a atualização do projeto.
4 - Crie o arquivo .Env com base no .Env.example
```

Windows:
```
1 - Faça a clonagem do repositório dentro da pasta htdocs.
2 - Após a clonagem do projeto, abra o mesmo em seu editor de texto. 
3 - Utilize o comando composer update para a atualização do projeto.
4 - Crie o arquivo .Env com base no .Env.example
```

## Dependências do projeto

Para a utilização do projeto é necessário alguns dependências, configurações e recursos do nosso banco de dados, elas são:

### Tabelas 

> #### 1 - AG_USUARIOS
> Guarda todos os dados **necessários** para o login dos usuários.
> - ID (BIGINT): Chave primária da tabela auto incrementada. 
> - Name (VARCHAR(255)): Nome do usuário.
> - Password (NVARCHAR(255)): Senha do usuário criptografa com MD5.
> - Registration (NVARCHAR(255)): Matrícula do usuário.
> - Store (INT): Loja onde o usuário trabalha.
> - Manager (NVARCHAR(255)): Confirmação se o usuário é ou não um gerente.

---

> #### 2 - AG_CLASSIFICACAO
> Guarda todas as classificações das perguntas da avaliação gerencial.
> - AG_CLASSIFICACAO (NUMERIC(15,2)): Chave primária da tabela auto incrementada. 
> - CLASSIFICACAO (VARCHAR(50)): Nome da classificação.

---

> #### 3 - AG_QUESTOES
> Guarda todas as perguntas necessários para a avaliação gerencial.
> - AG_QUESTAO (NUMERIC(15,2)): Chave primária da tabela auto incrementada. 
> - DATA_HORA (DATETIME): Data e hora da inserção da pergunta no banco de dados.
> - AG_CLASSIFICACAO (NUMERIC(15,0)) : Chave estrangeira da tabela <STRONG>AG_CLASSIFICACAO</STRONG>
> - QUESTAO (VARCHAR(MAX)) : Campo de texto com a pergunta cadastrada no banco.
    
---

> #### 4 - AG_RESPOSTAS
> Guarda todas as respostas necessários para a avaliação gerencial.
> - AG_RESPOSTA (NUMERIC(15,0)): Chave primária da tabela auto incrementada. 
> - AG_QUESTAO (NUMERIC(15,2)): Chave estrangeira da tabela <STRONG>AG_QUESTOES</STRONG>
> - RESPOSTA (VARCHAR(MAX)) : Campo de texto com a resposta cadastrada no banco, que pode ser fixa ou um campo dissertativo.
> - NOTA (NUMERIC(5,2)) : Nota fixa que é atribuida a cada resposta
    
 ---

> #### 4 - AG_FORM_RESPOSTAS
> Guarda todas as respostas necessários para a avaliação gerencial.
> - AG_FORM_RESPOSTA (NUMERIC(15,0)): Chave primária da tabela auto incrementada. 
> - AG_QUESTAO (NUMERIC(15,2)): Chave estrangeira da tabela <STRONG>AG_QUESTOES</STRONG>.
> - AG_RESPOSTA (VARCHAR(MAX)) : Chave estrangeira da tabela <STRONG>AG_RESPOSTAS</STRONG> ou texto inserido pelo usuário nas questões dissertativas.
> - AG_CLASSIFICACAO (NUMERIC(15,2)): Chave estrangeira da tabela <STRONG>AG_CLASSIFICACAO</STRONG>.
> - AG_USUARIO (NUMERIC(15,2)) : Usuário logado no sistema (ID da tabela AG_USUARIOS).
> - AG_MATRICULA (NUMERIC(15,2)) : Matricula do usuário logado no sistema (Registration da tabela AG_USUARIOS).
> - DATA_RESPOSTAS (VARCHAR(15)) : Mês e ano no horário da resposta.
> - AG_LOJA (NUMERIC(15,2)) : Loja do usuário logado no sistema (Store da tabela AG_USUARIOS).


 
