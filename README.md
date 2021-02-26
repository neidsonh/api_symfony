# Api Symfony

Api local utilizando o Symfony.
Para rodar, é necessário possuir:
* MySql - Editar o arquivo .env na linha 25 e incluir senha e usuário.
    + DATABASE_URL=mysql://USUÁRIO:SENHA@127.0.0.1:3306/order_customer
* PHP
    + Executar o comando php .\bin\console doctrine:database:create para criar uma base de dados;
    + Executar o comando php .\bin\console doctrine:migrations:migrate para atualizar o esquema do banco de dados;
    + Executar o comando php -S localhost:8080 -t public para iniciar um servidor local.
* Postman - Realizar os testes nas rotas:
    + POST - http://localhost:[port]/products - criar o produto
        +     {
                "sku":"1254ASD",
                "description":"Protudo 3",
                "price":10
              }
    + POST - http://localhost:[port]/order - criar o pedido
        +     {
                "name_customer":"Segundo pedido",
                "email":"neidson@gmail.com",
                "cpf":"123.456.789-12",
                "cep":"12608-360",
                "shipping":50,
                "products":[
                    {
                        "id":1,
                        "quantity":100
                    },
                    {
                        "id":2,
                        "quantity":60
                    }
                ]
              }
    + GET - http://localhost:[port]/products - buscar todos os produtos

    + GET - http://localhost:[port]/products/{id} - buscar um produto específico
