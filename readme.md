## Sistema de atendimento para empresas de ramos variados exemplo distribuidoras, criado para trabalhar em conjunto com chatboot no messenger.
Video de uso de uma distribuidora: [https://youtu.be/ZmHmlF7Gi0Q](https://youtu.be/ZmHmlF7Gi0Q)  
### Resumo
Esse sistema foi criado para fornecer um chatboot no messenger para empresas de vendas de produtos no geral.  
Para criar chatboot no messenger foi utilizado o chatfuel [https://chatfuel.com/](https://chatfuel.com/)
Esse sistema possui os seguintes cadastros:  
Clientes, forma de pagamento, taxas de entrega, horario de atendimento, configurações gerais, dados cadastrais.  
[https://github.com/AlexandreTomasi/produto-api/blob/master/image/menu.JPG](https://github.com/AlexandreTomasi/produto-api/blob/master/image/menu.JPG)  
#### Tela de Pedidos:
Para o cliente solicitar um pedido ele deverá acessar o messenger da empresa e mandar uma mensagem  
a atendente vitual Ana irá iniciar o chatboot para atender o cliente. A Ana irá fazer a solicitação de pedido  
junto com cliente e enviar para esse sistema o pedido com todos os dados do pedido.  
A tela de pedidos lista todos os pedidos solicitados por um periodo padrao de 3 dias podendo ser alterado.  
A tela de pedidos atualiza a cadas 10 segundos para verificar se chegaram novos pedidos, quando chegar um novo pedido o atendente  
poderá atender ou cancelar esse pedido. Quando clicar em atender sera aberto um modal com todos os dados do pedido no fim ao  
clicar em iniciar atendimento será enviado para a pessoa que solicitou o pedido via messenger uma reposta dizendo que o pedido  
foi recebido e está sendo preparado. Não avendo necessidade nenhuma do atendente ter que acessar o messenger.  
O atendente poderá tambem pausar o bot caso a empresa estiver com muitos pedidos, clicando no botão flutuante "ON", podendo  
assim pausar o bot pelo tempo desejado ou reinicialo.  
[https://github.com/AlexandreTomasi/produto-api/blob/master/image/telapedidos.JPG](https://github.com/AlexandreTomasi/produto-api/blob/master/image/telapedidos.JPG)


### Arquitetura
- PHP 
- Framework Codeigniter
- AngularJs
- Mysql 
- Windows 7

### Ferramentas
- Netbeans
- Xampp

### Configuração inicial
**Para executar o projeto deve existir um banco chamado “skybots_produto” e “skybots_gerencia”** usando login padrão:  
Abra o phpMyAdmin e abra a aba de SQL desse banco, execute esse sql: [skybots_gerencia.sql](https://github.com/AlexandreTomasi/produto-api/blob/master/skybots_gerencia.sql)  
e execute esse sql: [skybots_produto.sql](https://github.com/AlexandreTomasi/produto-api/blob/master/skybots_produto.sql)  

### Iniciando/Autenticando
- Acesse no navegador [http://[::1]/produto-api/](http://[::1]/produto-api/) e faça o login:  
logim: skybots@skybots.com.br  
senha: 123456  





