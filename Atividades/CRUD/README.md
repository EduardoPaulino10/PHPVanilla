
1. Definição de CRUD

• Significado: Acrônimo para as quatro operações básicas de persistência de dados (Create, Read, Update, Delete).
• Correspondência no PostgreSQL:
	• C (Create / Criar): Comando INSERT (insere novos registros).
	• R (Read / Ler): Comando SELECT (consulta e recupera dados).
	• U (Update / Atualizar): Comando UPDATE (altera registros existentes).
	• D (Delete / Excluir): Comando DELETE (remove registros).

2. Anatomia do SQL Injection

Quando o código junta (concatena) diretamente o texto enviado pelo usuário na string da consulta SQL, o banco não consegue diferenciar o que é comando do programador e o que é dado digitado. O atacante insere aspas e operadores lógicos (como ' OR '1'='1) para fechar a string original prematuramente e injetar novas instruções SQL maliciosas, alterando a condição da consulta para vazar, alterar ou apagar dados.

3. Mecanismo das Prepared Statements

O processo ocorre em duas fases separadas:
• Etapa 1 (prepare): O banco recebe apenas o molde da consulta SQL com marcadores vazios, compila a estrutura e define o plano de execução antes de conhecer os valores.
• Etapa 2 (execute): Os dados do usuário são enviados separadamente e tratados estritamente como valores literais (texto ou número puro). Mesmo que contenham aspas ou comandos SQL, o banco nunca os interpreta como instruções executáveis.

4. Marcadores Nomeados

• Clareza e leitura: Nomes descritivos como :sku e :preco deixam claro qual dado pertence a cada coluna, facilitando a manutenção em consultas grandes.
• Independência de ordem: Diferente dos pontos de interrogação (?), onde a ordem no array precisa ser idêntica à da query, os marcadores nomeados permitem passar os parâmetros em qualquer ordem e até reutilizar o mesmo marcador várias vezes na mesma consulta.

5. Diferença entre Bindings (bindValue vs. bindParam)

• bindValue(): Vincula o valor exato que a variável possui no momento em que o método é chamado. Se a variável mudar de valor depois dessa linha, o parâmetro enviado ao banco não muda.
• bindParam(): Vincula a referência (endereço de memória) da variável. O valor só é lido no instante em que o método $stmt->execute() roda, permitindo alterar o valor da variável dentro de um laço foreach, por exemplo.

6. Tipagem no PDO

Sem especificar PDO::PARAM_INT, o PDO trata todos os parâmetros como strings (PDO::PARAM_STR) por padrão, envolvendo o valor em aspas simples na consulta final (ex: LIMIT '5'). Em bancos tipados rigorosamente como o PostgreSQL, enviar uma string onde se espera um inteiro gera erro de sintaxe SQL e interrompe a execução da consulta.

7. Padrão DAO (Data Access Object)

• Princípio da Responsabilidade Única (SOLID): Isola toda a lógica de acesso ao banco de dados (SQL, conexões e mapeamento) em uma classe dedicada, separando-a das regras de negócio e das telas HTML.
• Manutenibilidade: Se uma tabela mudar de nome ou uma consulta precisar ser otimizada, basta alterar o arquivo do DAO sem precisar caçar comandos SQL espalhados por todo o sistema.

8. Operações de Update

Executar um UPDATE sem a cláusula WHERE faz com que o banco aplique a alteração em todas as linhas da tabela simultaneamente. Em ambiente de produção, isso sobrescreve dados críticos de todos os clientes ou produtos de uma só vez, causando perda irreversível de integridade e exigindo restauração de backup.

9. Impacto da LGPD

O vazamento de dados pessoais por falhas evitáveis de segurança (como SQL Injection) gera graves consequências previstas na LGPD:
• Sanções financeiras: Advertências e multas simples ou diárias de até 2% do faturamento da empresa, limitadas a R$ 50 milhões por infração.
• Sanções operacionais: Bloqueio ou eliminação definitiva dos bancos de dados envolvidos na infração e suspensão parcial ou total das atividades de tratamento de dados.
• Impacto reputacional: Obrigação de divulgar publicamente o incidente, gerando perda de confiança dos clientes e processos judiciais de indenização por danos morais e materiais.
