### 1. Conceituação OWASP: O que significa a sigla XSS e por que ela é classificada como uma vulnerabilidade no lado do cliente (Client-Side) que deve ser prevenida pelo Back-End?
**R:**
XSS significa Cross-Site Scripting. É uma vulnerabilidade em que um atacante consegue inserir código, geralmente JavaScript, em uma página que será visualizada por outros usuários.

É considerada uma vulnerabilidade do lado do cliente porque o código malicioso é executado pelo navegador da vítima. Porém, o Back-End precisa prevenir o problema tratando corretamente os dados recebidos e, principalmente, escapando os dados antes de colocá-los no HTML.

### 2. Reflected vs Stored: Qual é a diferença entre um ataque XSS Refletido e um XSS Gravado (Stored)? Qual dos dois apresenta maior potencial de estrago para uma empresa e por quê?
**R:**
O XSS Refletido acontece quando o código malicioso é enviado em uma requisição e imediatamente refletido na resposta da página.

O XSS Stored (Gravado) acontece quando o conteúdo malicioso é salvo, por exemplo, em um banco de dados ou arquivo, e depois exibido para outros usuários.

O Stored pode ter um impacto maior porque o conteúdo malicioso fica armazenado e pode atingir várias pessoas que acessarem aquele conteúdo.

### 3. Mecanismo de Escapamento: Explique detalhadamente a transformação que a função htmlspecialchars() realiza nos caracteres < e >. Por que o navegador não executa o código após essa transformação?
**R:**
A função transforma caracteres especiais em entidades HTML.

Por exemplo:

<  →  &lt;
>  →  &gt;

Assim, um código como:

<script>alert('XSS')</script>

passa a ser exibido como texto:

&lt;script&gt;alert('XSS')&lt;/script&gt;

O navegador interpreta &lt; e &gt; como os caracteres < e >, mas não interpreta o conteúdo como uma nova tag HTML. Por isso o JavaScript não é executado.

### 4. Flags de Proteção: Qual é a função da flag ENT_QUOTES na chamada de htmlspecialchars()? O que pode acontecer se essa flag for omitida em um campo <input value="...">?
**R:**
ENT_QUOTES faz com que a função também escape aspas simples e duplas.

Isso é importante principalmente quando o valor está dentro de atributos HTML:

<input value="<?= e($busca) ?>">

Sem o tratamento das aspas, um atacante poderia tentar fechar o atributo value e inserir outro código HTML.

### 5. Anti-Alucinação PHP: Por que não devemos utilizar o filtro FILTER_SANITIZE_STRING em projetos modernos desenvolvidos em PHP 8.3?
**R:**
Porque FILTER_SANITIZE_STRING foi descontinuado no PHP 8.1 e não deve ser utilizado em projetos modernos.

Em vez de depender dessa função, devemos utilizar técnicas adequadas para cada situação, como:

trim() para remover espaços;
strip_tags() quando realmente necessário;
filter_var() para validação;
htmlspecialchars() para escapar dados antes de exibi-los no HTML.
### 6. Validação de E-mail: Qual é a diferença prática entre verificar um e-mail com empty($email) e verificar com filter_var($email, FILTER_VALIDATE_EMAIL)?
**R:**
empty($email) verifica basicamente se o valor está vazio.

Por exemplo:

empty("abc")

retorna false, mesmo que "abc" não seja um e-mail válido.

Já:

filter_var($email, FILTER_VALIDATE_EMAIL)

verifica se o conteúdo possui um formato válido de e-mail.

### 7. Roubo de Sessão: Como um atacante pode usar uma brecha XSS para capturar o cookie de sessão de um usuário logado?
**R:**
Se existir uma vulnerabilidade XSS, um atacante pode tentar executar JavaScript no navegador de um usuário logado.

Se o cookie de sessão estiver acessível via JavaScript, por exemplo sem HttpOnly, um código malicioso poderia tentar acessar:

document.cookie

e enviar o conteúdo para o atacante.

Por isso é importante prevenir XSS e também utilizar proteções de cookies, como HttpOnly e Secure quando apropriado.

### 8. Segurança em Camadas: Por que sanitizar na entrada (ex: com strip_tags) não elimina a necessidade de codificar na saída com htmlspecialchars()?

Porque são mecanismos com objetivos diferentes.

strip_tags() tenta remover tags HTML da entrada, mas não deve ser considerado uma proteção universal contra XSS.

Já htmlspecialchars() faz o escape no momento da saída, impedindo que caracteres especiais sejam interpretados como HTML.

Por isso, a proteção deve acontecer em camadas:

validar entrada → tratar dados quando necessário → escapar na saída.