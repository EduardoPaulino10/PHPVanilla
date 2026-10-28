1. Abstração de Dados
**Respostas:**O PDO é uma extensão do PHP que permite conectar a diferentes bancos de dados usando uma interface padrão. Ele é preferível porque facilita a troca de banco de dados e oferece recursos de segurança, como consultas preparadas.

2. Ciclo do DSN
**Respostas:**DSN é uma string que contém as informações para conectar ao banco de dados. O host indica o endereço do servidor, o port informa a porta utilizada e o dbname indica o nome do banco de dados.

3. Padrão de Portas
**Respostas:**A porta padrão do PostgreSQL é 5432. Ela é informada na string DSN usando port=5432.

4. Flags de Integridade
**Respostas:**A configuração PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION faz com que os erros gerem exceções, permitindo tratá-los com try-catch. No PHP 8.0 ou superior, esse já é o comportamento padrão do PDO.

### 5. Fetch Mode
**Respostas:**O PDO::FETCH_ASSOC retorna os dados em arrays associativos, usando os nomes das colunas como índices. Isso evita a duplicação dos dados em índices numéricos e associativos, podendo reduzir o consumo de memória.

### 6. Padrão Singleton
**Respostas:**Criar várias conexões com new PDO() pode consumir mais recursos do servidor. Se muitas conexões forem abertas ao mesmo tempo, o limite de max_connections pode ser atingido.

### 7. Encapsulamento do Singleton
**Respostas:**O construtor private impede que a classe seja instanciada diretamente. Os métodos __clone() e __wakeup() devem ser bloqueados para impedir a clonagem e a recriação do objeto por desserialização.

### 8. Segurança de Credenciais
**Respostas:**Não devemos deixar usuário e senha diretamente no código, pois essas informações podem ser expostas ao compartilhar o projeto ou enviá-lo ao GitHub. O ideal é guardá-las em um arquivo de configuração protegido e adicioná-lo ao .gitignore.

### 9. Tratamento de Exceções e LGPD
**Respostas:**Exibir $e->getMessage() diretamente pode revelar informações internas do banco de dados e do sistema, facilitando ataques. O correto é mostrar uma mensagem genérica ao usuário e guardar os detalhes técnicos em um log protegido.