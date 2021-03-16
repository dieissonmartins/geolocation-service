# Geolocalização (MVP de micro-serviço em PHP)

Laravel Lumen -  Microsserviços PHP e APIs e suas camadas de segurança.

## Enviar notificações de anúncios ao usuário que estiver a 15 metros do estabelecimento.

## Requisitos funcionais
- Realizar cadastros dos estabelecimentos 
- Realizar cadastros de usuários
- Realizar cadastros de anúncios 
- Enviar notificação de anúncios aos usuários
- Autenticação (usando email e senha)

## Requisitos não funcionais 	
- Utilizar o micro-framework Lumen 
- Gerenciar dependências com Composer
- Utilizar Eloquente como ORM 
- Utilizar banco de dados MySql
- Utilizar biblioteca laravel-mysql-spatial para Geolocalização
- Computar quantidade de acessos em um anúncio

## Regras de Negócio  
- O usuário deve estar logado para ter acesso aos anúncios 
- O email de cadastro não pode ser utilizado em mais de um cadastro 

## REST API Aplicação
### endpoints da API

### Cadastro de usuário
### Request

`POST /register/`

    'Accept: application/json' http://localhost:8000/register/

#### POSTMAN Body
    name:Dieisson Martins
    email:dieisson.user@gmail.com
    password:12345678
### Response

    HTTP/1.1 201 Created
    Date: 
    Status: 201 Created
    Connection: close
    Content-Type: application/json
    Content-Length: 36

   {
        "data": {
            "msg": "Conta criada com sucesso!"
        }
    }


### Cadastro de clientes
### Request

`POST /clients/create/store/`

    'Accept: application/json' http://localhost:8000/clients/create/store/

#### POSTMAN Body
    name:SUPERMERCADOS BH
    latitude:-19.8636393
    longitude:-43.9497783

    name:Santander
    latitude:-19.8612364
    longitude:-43.9501679

### Response

    HTTP/1.1 201 Created
    Date: 
    Status: 201 Created
    Connection: close
    Content-Type: application/json
    Location: /clients/
    Content-Length: 36

    {
        "data": {
            "msg": "Cliente cadastrado com sucesso!"
        }
    }

### Obter lista de clientes

### Request

`GET /clients/`

    'Accept: application/json' http://localhost:8000/clients/

### Response

    HTTP/1.1 200 OK
    Date: 
    Status: 200 OK
    Connection: close
    Content-Type: application/json
    Content-Length: 2

    {
        "data": [
            {
                "id": 3,
                "name": "SUPERMERCADOS BH",
                "location": {
                    "type": "Point",
                    "coordinates": [
                        -43.9497783,
                        -19.8636393
                    ]
                },
                "status": 1,
                "created_at": "16/03/2021 16:21:58",
                "updated_at": "16/03/2021 16:21:58"
            },
            {
                "id": 4,
                "name": "Santander",
                "location": {
                    "type": "Point",
                    "coordinates": [
                        -43.9501679,
                        -19.8612364
                    ]
                },
                "status": 1,
                "created_at": "16/03/2021 16:21:35",
                "updated_at": "16/03/2021 16:21:35"
            }
        ]
    }


### Cadastro de anúncio
### Request

`POST /adverts/create/store/`

    'Accept: application/json' http://localhost:8000/adverts/create/store/

#### POSTMAN Body
    client_id:4
    description:Transferências ilimitadas entre contas Santander.
    image:#
    start_date:2021-03-01 21:49:11
    final_date:2021-03-20 21:49:11
### Response

    HTTP/1.1 201 Created
    Date: 
    Status: 201 Created
    Connection: close
    Content-Type: application/json
    Content-Length: 36

    {
        "data": {
            "msg": "Anúncio cadastrado com sucesso!"
        }
    }

### Listagem de anúncios pela coordenada
### Request

`POST /adverts/local/`

    'Accept: application/json' http://localhost:8000/adverts/local/

#### POSTMAN Body (anúncios do santander próximo a coordenada ( -43.9501679, -19.8612364) )
    latitude:-19.8612364
    longitude:-43.9501679
### Response

    HTTP/1.1 201 Created
    Date: 
    Status: 201 Created
    Connection: close
    Content-Type: application/json
    Content-Length: 36

    {
        "data": {
            "advertsTitle": "Anúncios no raio de 15 metros",
            "dataAdverts": [
                {
                    "id": 4,
                    "name": "Santander",
                    "location": {
                        "type": "Point",
                        "coordinates": [
                            -43.9501679,
                            -19.8612364
                        ]
                    },
                    "status": 1,
                    "created_at": "16/03/2021 16:21:35",
                    "updated_at": "16/03/2021 16:21:35",
                    "adverts": [
                        {
                            "id": 1,
                            "client_id": 4,
                            "description": "Transferências ilimitadas entre contas Santander.",
                            "image": "#",
                            "start_date": "01/03/2021 00:21:00",
                            "final_date": "20/03/2021 00:21:00",
                            "qtd_view": 0,
                            "created_at": "16/03/2021 16:21:53",
                            "updated_at": "16/03/2021 16:21:53"
                        }
                    ]
                }
            ]
        }
    }

### Obter anúncio pelo seu ID 

### Request

`GET /adverts/{id}/show/`

    'Accept: application/json' http://localhost:8000/adverts/{id}/show/

### Response

    HTTP/1.1 200 OK
    Date: 
    Status: 200 OK
    Connection: close
    Content-Type: application/json
    Content-Length: 36

    {
        "data": {
            "id": 1,
            "client_id": 4,
            "description": "Transferências ilimitadas entre contas Santander.",
            "image": "#",
            "start_date": "01/03/2021 00:21:00",
            "final_date": "20/03/2021 00:21:00",
            "qtd_view": 1,
            "created_at": "16/03/2021 16:21:53",
            "updated_at": "16/03/2021 17:21:19"
        }
    }

## License

O micro-framework Lumen é um software de código aberto licenciado sob a [MIT license](https://opensource.org/licenses/MIT).
