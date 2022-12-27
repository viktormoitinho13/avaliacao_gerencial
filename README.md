# Avaliação Gerencial 

## Pré-requisitos

Antes de começar, verifique se você atendeu aos seguintes requisitos:

* Você necessita ter instalado 
     `' <br>
     'Composer 2.2.6 ou superior' <br>
     'Apache2 2.4.52 ou superior' <br>
     'Laravel 9.0 ou superior` <br>
     'PHP 8.1 ou Superior'<br>
     And this is the second line.
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

> #### 5 - AG_FORM_RESPOSTAS
> Guarda todas as perguntas e respostas dados pelos usuários.
> - AG_FORM_RESPOSTA (NUMERIC(15,0)): Chave primária da tabela auto incrementada. 
> - AG_QUESTAO (NUMERIC(15,2)): Chave estrangeira da tabela <STRONG>AG_QUESTOES</STRONG>.
> - AG_RESPOSTA (VARCHAR(MAX)) : Chave estrangeira da tabela <STRONG>AG_RESPOSTAS</STRONG> ou texto inserido pelo usuário nas questões dissertativas.
> - AG_CLASSIFICACAO (NUMERIC(15,2)): Chave estrangeira da tabela <STRONG>AG_CLASSIFICACAO</STRONG>.
> - AG_USUARIO (NUMERIC(15,2)) : Usuário logado no sistema (ID da tabela AG_USUARIOS).
> - AG_MATRICULA (NUMERIC(15,2)) : Matricula do usuário logado no sistema (Registration da tabela AG_USUARIOS).
> - DATA_RESPOSTAS (VARCHAR(15)) : Mês e ano no horário da resposta.
> - AG_LOJA (NUMERIC(15,2)) : Loja do usuário logado no sistema (Store da tabela AG_USUARIOS).

 ---

> #### 6 - AG_STATUS
> Guarda a informação de quais usuários e quais formulários ele já respondeu.
> - AG_STATUS (NUMERIC(15,0)): Chave primária da tabela auto incrementada. 
> - AG_CLASSIFICACAO (NUMERIC(15,2)): Chave estrangeira da tabela <STRONG>AG_CLASSIFICACAO</STRONG>.
> - AG_USUARIO (NUMERIC(15,2)) : Usuário logado no sistema (ID da tabela AG_USUARIOS).
> - AG_MATRICULA (NUMERIC(15,2)) : Matricula do usuário logado no sistema (Registration da tabela AG_USUARIOS).
> - AG_DATA (VARCHAR(15)) : Mês e ano no horário da resposta.

 ### Inserção de dados 
  
Para o cadastro de usuários é feito um select dentro de algumas tabelas no banco. A regra do usuário e senha são o nome ou a matrícula do usuários e a senha é o CPF sem pontuação. 

````
INSERT INTO AG_USUARIOS (NAME, PASSWORD, REGISTRATION, STORE, MANAGER)	
	SELECT 
		A.NOME,
		CONVERT(VARCHAR(32), HASHBYTES('MD5', (REPLACE(REPLACE(REPLACE(A.INSCRICAO_FEDERAL,'.', ''),'-', ''),'/', ''))), 2) AS CPF ,
		--(REPLACE(REPLACE(REPLACE(A.INSCRICAO_FEDERAL,'.', ''),'-', ''),'/', '')) AS CPF,
		F.VENDEDOR,
		F.EMPRESA_USUARIA,
		CASE 
			WHEN G.DEPARTAMENTO_FOLHA_NIVEL = 12 THEN 'S'
			ELSE 'N'
		END AS GERENTE
	FROM 
		FUNCIONARIOS A WITH(NOLOCK)
		INNER JOIN DBO.FUNCIONARIOS_PARAMETROS B WITH(NOLOCK) ON B.ENTIDADE = A.ENTIDADE
		INNER JOIN DBO.SITUACOES_CONTRATUAIS C WITH(NOLOCK) ON C.SITUACAO_CONTRATUAL = B.SITUACAO_CONTRATUAL
		INNER JOIN DBO.TIPOS_SITUACOES_CONTRATUAIS D WITH(NOLOCK) ON D.TIPO_SITUACAO_CONTRATUAL = C.TIPO_SITUACAO_CONTRATUAL
		INNER JOIN DBO.CARGOS_FOLHA E WITH(NOLOCK) ON E.CARGO_FOLHA = B.CARGO
		INNER JOIN DBO.VENDEDORES F WITH(NOLOCK) ON F.ENTIDADE = A.ENTIDADE AND A.REGISTRO = F.CODIGO_DP     
		INNER JOIN DBO.DEPARTAMENTOS_FOLHA G WITH(NOLOCK) ON G.DEPARTAMENTO_FOLHA = B.DEPARTAMENTO
	WHERE
		--G.DEPARTAMENTO_FOLHA_NIVEL=2
		--AND G.DEPARTAMENTO_FOLHA_NIVEL = 12
		--AND E.CARGO_FOLHA IN (60,64,155,156,157)
		  F.EMPRESA_USUARIA <= (SELECT MAX(LOJA) FROM GERENTES_LOJAS)
		  AND F.CADASTRO_ATIVO = 'S'
	UNION ALL 

	SELECT 
		A.NOME,  
		CONVERT(VARCHAR(32), HASHBYTES('MD5', (REPLACE(REPLACE(REPLACE(C.INSCRICAO_FEDERAL,'.', ''),'-', ''),'/', ''))), 2) AS CPF ,
		--	(REPLACE(REPLACE(REPLACE(C.INSCRICAO_FEDERAL,'.', ''),'-', ''),'/', '')) AS CPF,
		B.VENDEDOR ,
		B.EMPRESA_USUARIA AS LOJA, 
		'S' AS MANAGER
		FROM USUARIOS A   
		JOIN VENDEDORES B ON A.ENTIDADE = B.ENTIDADE 
		JOIN ENTIDADES C ON A.ENTIDADE = C.ENTIDADE 
		WHERE A.PERFIL_USUARIO IN (1546) AND USUARIO = 324

````

#### Visualização de dados 
A view *AG_GERENTE_PERCEPCAO* traz os dados necessários para que o gerente visualize as respostas dados pelos funcionários

````
									
create view AG_GERENTE_PERCEPCAO
AS 
SELECT 
A.AG_LOJA,
A.AG_QUESTAO,
A.AG_CLASSIFICACAO,
C.CLASSIFICACAO  ,
A.AG_RESPOSTA,
A.RESPOSTA,
CASE 
	WHEN A.AG_RESPOSTA = A.RESPOSTA THEN 0
	ELSE ((CONVERT(DECIMAL(15,2),A.QTD_RESPOSTA) / CONVERT(DECIMAL(15,2),B.QTD_RESPOSTAS_POR_QUESTAO)) * 100)
END AS PORCENTAGEM,
CASE 
	WHEN A.AG_RESPOSTA = A.RESPOSTA THEN 'S'
	ELSE 'N'
END AS COMENTARIO ,
A.DATA_RESPOSTAS
FROM 
(	 
	SELECT
	AG_LOJA,
	 A.AG_QUESTAO,
	 A.AG_RESPOSTA,
	 A.AG_CLASSIFICACAO,
	 A.DATA_RESPOSTAS,
    CASE
        WHEN LTRIM(RTRIM( A.AG_RESPOSTA)) NOT LIKE '%[0-9]%' AND B.RESPOSTA IS NULL 
           
          THEN A.AG_RESPOSTA
          ELSE B.RESPOSTA
    END AS RESPOSTA,
	 
	 COUNT(A.AG_RESPOSTA) AS QTD_RESPOSTA
	 FROM AG_FORM_RESPOSTAS A
	 left  JOIN(
	 	 SELECT 
	 	 	CONVERT(VARCHAR(MAX),AG_RESPOSTA ) AS AG_RESPOSTA,
	 	 	RESPOSTA,
	 	 	NOTA FROM AG_RESPOSTAS
	 	 	WHERE RESPOSTA NOT IN ('0','1','2','3','4','5')
	 	 	
	  ) B ON A.AG_RESPOSTA = B.AG_RESPOSTA 
	 WHERE A.DATA_RESPOSTAS = (SELECT CONCAT(MONTH(GETDATE()), '/',YEAR(GETDATE()) ))
	  GROUP BY AG_LOJA,
	 A.AG_QUESTAO,
	 A.AG_RESPOSTA,
	 A.AG_CLASSIFICACAO,
	 A.DATA_RESPOSTAS,A.AG_RESPOSTA, B.RESPOSTA
) A
	  left JOIN ( 
			SELECT 
			AG_LOJA,	
			AG_QUESTAO , 
			COUNT(AG_RESPOSTA) AS QTD_RESPOSTAS_POR_QUESTAO 
			FROM AG_FORM_RESPOSTAS A
			WHERE A.DATA_RESPOSTAS = (SELECT CONCAT(MONTH(GETDATE()), '/',YEAR(GETDATE()) ))
	 		GROUP BY AG_QUESTAO , AG_LOJA
) B ON A.AG_QUESTAO = B.AG_QUESTAO AND  A.AG_LOJA = B.AG_LOJA
JOIN AG_CLASSIFICACAO  C ON A.AG_CLASSIFICACAO = C.AG_CLASSIFICACAO 
WHERE A.RESPOSTA IS NOT NULL 
AND A.DATA_RESPOSTAS = (SELECT CONCAT(MONTH(GETDATE()), '/',YEAR(GETDATE()) ))
 


````
