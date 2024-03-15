# Teste Gazin

## Instalação
> Após clonar o projeto e instalar o docker, acesse o diretório do projeto (pelo terminal, prompt) e execute os comandos:
```
composer install
docker-compose up --build
```

> Quando a imagem estiver rodando no docker, acesse o terminal de setup-php e execute os seguinte comandos para atualizar o banco:
```
composer install
php artisan migrate
php artisan db:seed
```

> Pronto, agora é só seguir a documentação no postman:

[Link Documentação](https://www.postman.com/higorsovinski/workspace/gazin/collection/25334332-9838577a-c065-49ad-8c82-45c31aa76072?action=share&creator=25334332)


> Para efetuar os testes unitários, no terminal de setup-php, execute o seguinte comando:
```
php artisan test --filter NivelTest --testsuite=Unit
php artisan test --filter DesenvolvedorTest --testsuite=Unit
```

> Para acessar o CRUD, utilize o link do projeto: http://localhost:8080/ 