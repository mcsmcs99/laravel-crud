## Requisitos

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)
- Linux ou WSL no Windows

---

## Passos para rodar o projeto

```bash
# 1. Clone o repositório
git clone https://github.com/mcsmcs99/laravel-crud.git
cd laravel-crud

# 2. Copie o arquivo de exemplo do .env
cp .env.example .env

# 3. Se estiver no linux rode esse comando antes de gerar os containers para não dar erro de permissão
chmod 777 -R .

# 4. Suba os containers com Docker Compose
docker-compose up -d --build

# 5. Instale as dependências do PHP (dentro do container)
docker exec -it laravel-app bash
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
npm install

# 6. Navegador
http://localhost:8000/

# 7. Acesso
usuário: edgard@medeiros.com
senha: 12345678