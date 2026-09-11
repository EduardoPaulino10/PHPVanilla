### Diferença Estrutural: Explique a diferença física entre onde os dados são anexados em uma requisição GET e em uma requisição POST:

**Resposta:** Na requisição GET, os dados são anexados diretamente à URL, geralmente após o símbolo `?`, ficando visíveis no endereço da página. Já na requisição POST, os dados são enviados dentro do corpo (body) da requisição HTTP, não aparecendo diretamente na URL.

---

### Segurança e Privacidade: Por que senhas de usuário nunca devem ser enviadas via método GET? Cite pelo menos dois locais onde essa senha ficaria gravada de forma insegura:

**Resposta:** Senhas de usuário nunca devem ser enviadas pelo método GET porque os dados são colocados diretamente na URL, podendo ficar expostos e registrados em diferentes locais. A senha pode ser armazenada no histórico do navegador e também nos logs de acesso do servidor web ou de proxies. Além disso, URLs podem ser compartilhadas ou armazenadas por outros sistemas. A boa prática é utilizar o método POST junto com HTTPS para proteger os dados durante a transmissão.

---

### Coalescência Nula: Por que a instrução `$nome = $_POST['nome'];` dispara um Warning na primeira vez que a página é carregada no navegador? Como o operador `??` resolve isso?

**Resposta:** A instrução dispara um Warning porque, na primeira vez que a página é carregada, o formulário ainda não foi enviado. Dessa forma, a chave `'nome'` ainda não existe dentro do array `$_POST`, causando um aviso de chave indefinida. O operador `??` verifica se o valor existe; caso não exista, utiliza o valor padrão informado depois dele, evitando o Warning.

```php
$nome = $_POST['nome'] ?? '';
```

Nesse exemplo, se `$_POST['nome']` não existir, a variável `$nome` receberá uma string vazia.

---

### Idempotência: O que significa dizer que uma requisição GET é idempotente? Por que atualizar ou deletar dados no banco usando links GET é uma má prática de segurança?

**Resposta:** Idempotência significa que realizar várias vezes a mesma requisição GET deve produzir o mesmo efeito no servidor, sem causar uma nova alteração a cada execução. Por exemplo, uma requisição GET usada para consultar um produto pode ser repetida várias vezes sem modificar o produto.

Usar links GET para atualizar ou deletar dados é uma má prática porque uma simples visita à URL pode executar uma ação que altera o sistema. Robôs, navegadores e outros mecanismos podem acessar URLs automaticamente, e um atacante também pode tentar induzir um usuário a acessar uma URL maliciosa. Por isso, operações que alteram dados devem utilizar métodos apropriados, como POST, PUT ou DELETE, além de mecanismos de proteção contra CSRF quando necessário.

---

### Validação Client vs Server: Um desenvolvedor júnior afirma que o formulário dele é 100% seguro porque colocou `required` e `type="email"` em todas as tags HTML. Explique por que essa afirmação é falsa.

**Resposta:** A afirmação é falsa porque `required` e `type="email"` realizam validações no lado do cliente, principalmente para melhorar a experiência do usuário. Essas validações podem ser desativadas, alteradas ou simplesmente ignoradas. Um usuário também pode enviar uma requisição diretamente para o servidor utilizando ferramentas como Postman ou scripts, sem passar pela validação do formulário HTML.

Por isso, a aplicação deve sempre realizar as validações no lado do servidor (backend), pois é o servidor que precisa verificar se os dados recebidos realmente são válidos e seguros antes de processá-los ou armazená-los.

---

### XSS e Sanitização: Qual é o risco de exibir dados vindos de um `$_POST` diretamente na tela sem utilizar `htmlspecialchars()`?

**Resposta:** O principal risco é um ataque de XSS (Cross-Site Scripting). Nesse tipo de ataque, um usuário mal-intencionado pode inserir código HTML ou JavaScript em um formulário. Se esse conteúdo for exibido diretamente na página, o navegador pode interpretar o código como parte da página e executá-lo.

Isso pode permitir ações maliciosas, como redirecionamentos, alteração do conteúdo da página ou tentativa de acesso a informações da sessão do usuário. A função `htmlspecialchars()` ajuda a evitar esse problema ao converter caracteres especiais, como `<` e `>`, em entidades HTML, fazendo com que o conteúdo seja tratado como texto em vez de código.

---

### Sticky Forms: O que é a técnica de Sticky Forms e qual é o seu impacto na experiência do usuário (UX)?

**Resposta:** Sticky Forms é uma técnica utilizada para manter os dados que o usuário já digitou no formulário depois que ele é enviado. Dessa forma, caso ocorra algum erro de validação, os campos preenchidos continuam com seus valores.

Essa técnica melhora a experiência do usuário (UX), pois evita que a pessoa precise preencher novamente todas as informações depois de um erro. Porém, informações sensíveis, como senhas, não devem ser repopuladas por motivos de segurança.

---

### DevTools: Como você utilizaria a aba Network do navegador para comprovar que um formulário foi enviado via POST e não via GET?

**Resposta:** Primeiro, eu abriria as ferramentas de desenvolvedor do navegador utilizando `F12` e acessaria a aba **Network**. Depois, enviaria o formulário normalmente e procuraria a requisição criada na lista de solicitações.

Ao selecionar essa requisição, seria possível verificar os detalhes da comunicação HTTP. No campo **Request Method**, apareceria o método utilizado.

Se estivesse escrito:

```text
Request Method: POST
```

o formulário teria sido enviado utilizando POST.

Se estivesse escrito:

```text
Request Method: GET
```

o formulário teria sido enviado utilizando GET.