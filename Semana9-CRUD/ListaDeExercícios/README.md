### **1. Definição de CRUD**

CRUD significa:

C — Create: criar dados → INSERT
R — Read: consultar dados → SELECT
U — Update: atualizar dados → UPDATE
D — Delete: excluir dados → DELETE

### **2. Anatomia do SQL Injection**

O SQL Injection acontece quando o sistema coloca diretamente um valor recebido pelo usuário, como $_GET ou $_POST, dentro de uma consulta SQL usando concatenação de strings.

O atacante pode enviar um texto que contenha comandos ou condições SQL. Como o banco recebe tudo como parte da consulta, esse texto pode alterar a lógica original do comando e permitir acesso ou alteração de dados.

### **3. Mecanismo das Prepared Statements**

As Prepared Statements separam a consulta SQL dos dados enviados pelo usuário.

Primeiro, o banco recebe a estrutura da consulta com prepare(). Depois, os valores são enviados com execute() ou algum método de binding.

Assim, um texto digitado pelo usuário é tratado como dado, e não como parte do comando SQL. Isso ajuda a impedir SQL Injection.

### **4. Marcadores Nomeados**

Marcadores nomeados, como :sku e :preco, deixam a consulta mais fácil de entender, principalmente quando ela possui vários valores.

Por exemplo:

INSERT INTO produtos (sku, preco)
VALUES (:sku, :preco)

É mais fácil identificar qual valor pertence a cada campo do que usando vários `?.`

### **5. Diferença entre Bindings**

bindValue() associa o valor atual de uma variável ao parâmetro.

$stmt->bindValue(":preco", $preco);

Já bindParam() associa o parâmetro à própria variável. Se o valor da variável mudar antes da execução, o novo valor será utilizado.

$stmt->bindParam(":preco", $preco);

Resumindo:

bindValue() → prende o valor.
bindParam() → prende a variável.

### **6. Tipagem no PDO**

Ao não informar corretamente o tipo, um valor que deveria ser numérico pode ser tratado como texto.

Em uma cláusula LIMIT, por exemplo, é importante informar:

$stmt->bindValue(":limite", $limite, PDO::PARAM_INT);

Isso garante que o valor seja tratado como inteiro e evita problemas de interpretação e validação dos dados.

### **7. Padrão DAO**

O DAO (Data Access Object) serve para separar o código responsável pelo acesso ao banco de dados do restante da aplicação.

Por exemplo, uma classe DAO pode ficar responsável por:

cadastrar;
consultar;
atualizar;
excluir dados.

Isso facilita a manutenção porque cada parte do sistema possui uma responsabilidade específica, seguindo o princípio da Responsabilidade Única (SRP) do SOLID.

### **8. Operações de UPDATE**

Um UPDATE sem WHERE pode alterar todos os registros da tabela.

Por exemplo:

UPDATE clientes
SET status = 'inativo';

Nesse caso, todos os clientes terão o status alterado.

Em produção, isso pode causar uma grande perda ou alteração incorreta de dados, sendo necessário restaurar um backup ou corrigir os registros afetados.

### **9. Impacto da LGPD**

Um vazamento de dados causado por uma falha de SQL Injection pode gerar consequências para a organização. Dependendo do caso e das circunstâncias, a LGPD prevê medidas como:

advertência;
multa simples de até 2% do faturamento da empresa, limitada a R$ 50 milhões por infração;
multa diária, respeitando o mesmo limite;
publicização da infração;
bloqueio ou eliminação dos dados pessoais envolvidos;
outras medidas previstas na legislação.

Além das penalidades legais, a organização pode sofrer prejuízo financeiro, perda de confiança dos clientes e danos à sua reputação. A aplicação das sanções depende da análise do caso concreto e das circunstâncias do incidente.