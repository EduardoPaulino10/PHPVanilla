### 1. O Colapso do Código Espaguete
**Manter consultas SQL, validações e HTML no mesmo arquivo dificulta a manutenção, pois mistura diferentes responsabilidades. Isso torna o código mais difícil de entender, corrigir e atualizar. Separar essas partes facilita a organização e permite que o sistema cresça sem aumentar a complexidade.**

### 2. A Tríade MVC
**O MVC é dividido em três componentes:**
**- Model: responsável pelos dados, acesso ao banco e regras de negócio.**
**- View: responsável pela parte visual e pela exibição das informações.**
**- Controller: recebe as requisições, processa as ações e conecta o Model à View.**
**As regras de negócio devem ficar no Model.**

### 3. O Papel do Composer
**O composer.json define as dependências e configurações do projeto. Já o composer.lock registra as versões exatas das bibliotecas instaladas. A pasta vendor/ não deve ser enviada ao Git porque contém bibliotecas que podem ser instaladas novamente pelo Composer, evitando arquivos desnecessários no repositório.**

### 4. A Especificação PSR-4
**O Autoloader PSR-4 utiliza o namespace para encontrar automaticamente o arquivo da classe. Nesse caso, o namespace App\Controllers é relacionado à pasta src/Controllers/, permitindo localizar o arquivo ProdutoController.php sem precisar utilizar vários comandos require.**

### 5. Front Controller
**A principal vantagem é a segurança, pois centraliza as requisições em public/index.php e impede que usuários acessem diretamente arquivos internos do sistema, como configurações, Models e Controllers.**

### 6. Roteador HTTP
**O Roteador verifica o método HTTP e a URL da requisição. Assim, consegue diferenciar GET /produtos, utilizado para consultar produtos, de POST /produtos, utilizado para cadastrar novos produtos.**

### 7. Injeção de Dados na View
**A função extract() transforma as chaves de um array em variáveis PHP. Dessa forma, o Controller consegue enviar informações para a View, permitindo utilizar essas variáveis diretamente no arquivo HTML.**

### 8. Segurança contra XSS nas Views
**A função htmlspecialchars() transforma caracteres especiais em entidades HTML, impedindo que códigos maliciosos sejam executados no navegador. Isso protege o sistema contra ataques XSS ao exibir informações fornecidas pelos usuários.**

### 9. Single Responsibility no Controller
**O Controller deve ter a responsabilidade de controlar o fluxo das requisições, não de acessar diretamente o banco de dados. Os comandos SQL e as conexões devem ficar separados, facilitando a manutenção, a organização e a reutilização do código.**

### 10. Transição para o Framework Laravel
**O Laravel 11 utiliza os mesmos conceitos aprendidos no MVC artesanal, como:**
**- MVC: separação entre Model, View e Controller.**
**- Rotas: identificação das requisições por método HTTP e URL.**
**- Composer: gerenciamento das dependências.**
**- PSR-4: carregamento automático das classes.**
**- Front Controller: centralização das requisições.**
**- Views: separação da parte visual.**
**- Controllers: controle das requisições.**
**- Segurança: proteção contra ataques como XSS**