### 1. Procedural vs. OO
Arrays associativos aceitam qualquer erro de digitação sem reclamar e espalham regras pelo sistema. A OO centraliza as regras em um único lugar e garante que os dados estejam sempre tipados e corretos.

### 2. Ciclo de Vida & __construct()
O comando new reserva um espaço na memória do servidor (Heap) para o objeto. O __construct() entra em ação logo em seguida para obrigar que o objeto já nasça com os dados certos e validados.

### 3. A Variável $this
O uso de $this->saldo mexe no saldo real guardado dentro daquele objeto específico. Uma variável local comum como $saldo é só um rascunho temporário que some da memória assim que o método acaba.

### 4. Encapsulamento & setSaldo
Mudar o saldo direto com um setSaldo(1000) pula todas as regras do banco (taxas, extrato, limites). O saldo só deve mudar através de ações reais do negócio, como os métodos sacar() e depositar().

### 5. Modificadores (private vs protected)
Atributos private só a própria classe enxerga. Atributos protected a própria classe e todas as suas classes filhas (através do extends) podem ver e alterar diretamente.

### 6. Property Promotion (PHP 8)
É um atalho visual moderno. Em vez de escrever a mesma variável três vezes na classe para conseguir inicializá-la, você escreve o atributo uma única vez direto no argumento do construtor.

### 7. Propriedades readonly
Bloqueiam o atributo para escrita depois que ele recebe o primeiro valor. Excelente para classes como CPF, impedindo que o documento mude de número por acidente no meio da execução do sistema.

### 8. Classes Abstratas
ContaBancaria é abstrata porque é apenas um conceito. Você não abre uma conta genérica no mundo real; você abre uma ContaCorrente ou ContaPoupanca (que são as classes reais e concretas).

### 9. Polimorfismo
O método transferir pede como destino uma ContaBancaria genérica. O PHP aceita qualquer classe filha e descobre sozinho, em tempo de execução, se deve usar o depósito da corrente ou da poupança.

### 10. Exceções de Domínio
Retornar false faz o erro passar batido se você esquecer de colocar um if. Lançar uma Exception trava o sistema na hora, aponta a linha exata do erro e obriga o programador a tratar a falta de saldo.