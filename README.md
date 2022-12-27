# Avaliação Gerencial 

## Pré-requisitos

Antes de começar, verifique se você atendeu aos seguintes requisitos:

* Você necessita ter instalado `PHP 8.1 ou Superior / Composer 2.2.6 ou superior / Apache2 2.4.52 ou superior / Laravel 9.0 ou superior>`
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

> #### AG_USUARIOS
> Guarda todos os dados **necessários** para o login dos usuários.
> - ID (BIGINT): Chave primária da tabela auto incrementada. 
> - Name (VARCHAR(255)): Nome do usuário.
> - Password (NVARCHAR(255)): Senha do usuário criptografa com MD5.
> - Registration (NVARCHAR(255)): Matrícula do usuário.
> - Store (INT): Loja onde o usuário trabalha.
> - Manager (NVARCHAR(255)): Confirmação se o usuário é ou não um gerente.


 
    
 


 
