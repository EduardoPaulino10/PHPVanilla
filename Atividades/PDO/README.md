## 1. O que é PDO?

PDO (*PHP Data Objects*) é uma interface do PHP para acessar bancos de dados. Em vez de aprender uma API diferente para cada SGBD, o projeto pode usar uma interface comum e trocar o driver — por exemplo, de PostgreSQL para MySQL — com menos alterações. Em projetos corporativos, isso facilita manutenção, testes e evolução do sistema. O PDO também oferece suporte a consultas preparadas, importantes para evitar injeção de SQL quando usadas corretamente.

## 2. DSN: os dados da conexão

DSN (*Data Source Name*) é a string que informa ao PDO qual driver e qual banco deve acessar. Para PostgreSQL, um exemplo é:

```php
$dsn = 'pgsql:host=localhost;port=5432;dbname=minha_base';
```

- `pgsql`: seleciona o driver PDO para PostgreSQL.
- `host`: endereço do servidor do banco; `localhost` indica que ele está na mesma máquina.
- `port`: porta de rede em que o PostgreSQL está atendendo.
- `dbname`: nome da base de dados que será usada.

## 3. Porta padrão

O PostgreSQL normalmente escuta na porta `5432`. Ela aparece no DSN como `port=5432`. Se o servidor tiver sido configurado para outra porta, use o valor correspondente.

## 4. Erros como exceções

Com `PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION`, erros de conexão ou de execução são lançados como `PDOException`. Isso permite tratar falhas em um bloco `try/catch`, em vez de depender de verificações manuais após cada operação.

O padrão depende da versão do PHP: desde o PHP 8.0, o modo padrão é `PDO::ERRMODE_EXCEPTION`; em versões anteriores, era `PDO::ERRMODE_SILENT`. Declarar o atributo explicitamente deixa a intenção clara e o comportamento previsível.

## 5. Modo de busca associativo

`PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC` faz cada linha retornada ser representada por um array associativo, com os nomes das colunas como chaves. Diferentemente do modo `PDO::FETCH_BOTH`, não mantém também uma cópia dos mesmos valores em índices numéricos, o que pode reduzir o uso de memória em resultados grandes. O ganho depende do volume de dados e não substitui limitar ou paginar consultas.

## 6. Reutilização de conexões

Cada `new PDO()` abre uma conexão com o servidor. Se a aplicação criar conexões repetidamente sem encerrá-las ou reutilizá-las, elas podem se acumular e consumir o limite `max_connections`, impedindo novas conexões. Reutilizar uma conexão durante o ciclo apropriado da aplicação evita esse desperdício. Em aplicações persistentes, também é importante entender o ciclo de vida das conexões; um Singleton, por si só, não gerencia todos os cenários.

## 7. Singleton e encapsulamento

Em uma implementação Singleton, o construtor `private` impede que outras partes do código criem instâncias com `new`. O método público de acesso devolve a instância única mantida pela classe. Para evitar cópias ou reconstrução por desserialização, normalmente também se bloqueiam `__clone()` e `__wakeup()` (ou `__unserialize()` em código que trate explicitamente esse mecanismo).

Esse padrão deve ser usado com critério: em muitos projetos, injeção de dependências é mais simples de testar e torna explícito quem usa a conexão.

## 8. Proteção das credenciais

Usuário e senha não devem ficar escritos diretamente nos scripts. O arquivo pode ser enviado ao controle de versão, compartilhado ou exposto por uma configuração incorreta do servidor. Prefira variáveis de ambiente ou um gerenciador de segredos, restrinja o acesso às credenciais e mantenha valores diferentes para desenvolvimento e produção. Se uma credencial for exposta, troque-a.

## 9. Exceções, informação sensível e LGPD

Exibir `$e->getMessage()` diretamente no navegador pode revelar nomes de servidores e bancos, caminhos, detalhes da consulta ou outras informações úteis para quem não deveria conhecê-las. Isso é uma falha de divulgação de informação e pode facilitar ataques; também pode expor dados pessoais ou detalhes do tratamento de dados, aumentando riscos de conformidade com a LGPD.

Em produção, registre detalhes em local protegido, com acesso controlado, e mostre ao usuário apenas uma mensagem genérica. Evite incluir senhas, dados pessoais ou consultas completas nos logs; registre somente o necessário e mantenha uma política adequada de retenção.