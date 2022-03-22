# Desafio Pebmed

## Detalhes do Projeto:

- Api usando padrão REST
- Projeto feito em Laravel 8
- Validações de existencia e formato na inserção e atualização dos dados
- Tests de APIs (Testes unitários)
- Service Layer
- Repositories
- Projeto hospedado na Digital Ocean no endereço: (https://desafio-pebmed.tk)
- CI (Continuous Integration - GitHub Actions)
- CD (Continuous Delivery - Github Actions)  
- Instruções:
- clone o projeto com o comando: git clone https://github.com/zurctrebla/pebmed.git
- acesse a pasta do projeto (cd pebmed)
- na pasta do projeto, faça uma cópia do .env.example para .env (cp .env.example .env)
- preencha o .env com as credenciais
- projeto já acompanha o docker-composer.yml (execute sudo docker-compose up -d)
- acesse o container do projeto com (sudo docker-compose exec pebmeb bash)
- instale as dependencias com o comando: (composer install)
- crie a key com o comando (php artisan key:generate)
- crie as tabelas do banco de dados com o comando (php artisan migrate)

