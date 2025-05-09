# Laravel Docker Starter 🚀

Este projeto utiliza **Laravel + Docker** para desenvolvimento isolado, prático e escalável.

---

## 📦 Requisitos

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)
- `make` (opcional, para facilitar comandos em Linux/Mac)
- Linux ou WSL no Windows

---

## 🚀 Passos para rodar o projeto

```bash
# 1. Clone o repositório
git clone https://github.com/seu-usuario/seu-projeto.git
cd seu-projeto

# 2. Copie o arquivo de exemplo do .env
cp .env.example .env

# 3. Suba os containers com Docker Compose
docker-compose up -d --build

# 4. Instale as dependências do PHP (dentro do container)
docker exec -it laravel-app bash
php artisan key:generate
php artisan migrate
php artisan db:seed
npm install
npm run build