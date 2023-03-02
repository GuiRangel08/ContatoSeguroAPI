Dificuldades do projeto:
    - falha na comunicação entre o React e a API do PHP, retornava erro de bloqueio. 
        - Como o Conteiner do Node não continha muitos componentes essenciais, como o curl, por exemplo, eu tive que fazer toda a instalação de todos as dependencias manualmente.
    - Resolvido fazendo a inclusão das linhas 16 e 17 no public/index.php
Não tive tempo de validar algumas coisas na API
Não tive tempo de estilizar da maneira que eu queria com um design responsivo no frontend


### Dificuldades
- falha na comunicação entre o React e a API do PHP, retornava erro de bloqueio. 
        - Como o Conteiner do Node não continha muitos componentes essenciais, como o curl, por exemplo, eu tive que fazer toda a instalação de todos as dependencias manualmente.
    - Resolvido fazendo a inclusão das linhas 16 e 17 no public/index.php
    - Pouca familiaridade com o React
        - Não tive tempo de finalizar o front

### Testes
    - Devido a um grande tempo corrigindo problemas técnicos no meu pc e servidor não tive tempo de implementar todos os testes, apenas um no phpUnit.

### Banco
O banco de dados foi o MySQL pois é o que eu tenho mais conhecimento, é de código aberto e utilizado mundialmente e possui os recursos de segurança abaixo.
 	- Criptografia SSL
 	- suporte para autenticação de dois fatores
 	- gerenciamento avançado de privilégios.
 	- Suporte a transações ACID (Atomicidade, Consistência, Isolamento e Durabilidade), que garantem a integridade dos dados.