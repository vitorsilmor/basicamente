# Processador de promessas de pagamento.

  - Muitos clientes atrasam o pagamento. Logo, é necessário entrar em contato com eles e solicitar uma promessa de pagamento para a nota em atraso.
  - Esse serviço faz exatamente isso: verifica se uma nota está com o status de vencida e, se estiver, a marca como 'prometida para pagamento' e envia um e-mail para o usuário.


Detalhes
  - Há um cliente na raiz que herda de duas abstrações.
  - A abstração mais superior, 'MarcarPromessaPagamentoBase', implementa uma interface chamada 'MarcarPromessaPagamentoService'.
  - O serviço é baseado em repositórios que são carregados nesse por meio do service container do Laravel.
  - Os repositórios se baseiam no eloquent.
