# Geolocalização (MVP de micro-serviço em PHP)

Laravel Lumen -  Microsserviços PHP e APIs e suas camadas de segurança.

## Enviar notificações de anúncios ao usuário que estiver a 15 metros do estabelecimento.

### Requisitos funcionais
- Realizar cadastros dos estabelecimentos 
- Realizar cadastros de usuários
- Realizar cadastros de anúncios 
- Enviar notificação de anúncios aos usuários
- Autenticação (usando email e senha)

### Requisitos não funcionais 	
- Utilizar o micro-framework Lumen 
- Gerenciar dependências com Composer
- Utilizar Eloquente como ORM 
- Utilizar banco de dados MySql
- Utilizar biblioteca laravel-mysql-spatial para Geolocalização
- Computar quantidade de acessos em um anúncio

### Regras de Negócio  
- O usuário deve estar logado para ter acesso aos anúncios 
- O email de cadastro não pode ser utilizado em mais de um cadastro 


## License

O micro-framework Lumen é um software de código aberto licenciado sob a [MIT license](https://opensource.org/licenses/MIT).
