# Manager Materials

Este é um projeto Laravel. Siga os passos abaixo para configurar e executar o projeto em seu ambiente local.

---

## Pré-requisitos

Antes de começar, você precisará ter instalado o seguinte em sua máquina:

- [PHP](https://www.php.net/) (recomendado versão 7.4 ou superior)
- [Composer](https://getcomposer.org/) (gerenciador de dependências PHP)
- [MySQL](https://www.mysql.com/) ou [SQLite](https://www.sqlite.org/) (banco de dados)
- [Node.js](https://nodejs.org/) e [NPM](https://www.npmjs.com/) (para compilar os arquivos front-end, se necessário)

---

## Configuração do ambiente local

### 1. Clonar o repositório

Primeiro, clone o repositório do projeto para sua máquina local. Abra o terminal e execute o seguinte comando:

```bash
git clone https://github.com/DarioPrazeres/ManagerRequest.git
```

### 2. Instalar dependências PHP

```bash
cd nome-do-projeto
composer install
```

### 3. Configuração do arquivo .env

```bash
cp .env.example .env
```

- configure as variáveis de ambiente:

 ```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

### 4. Gerar chave de aplicação

```bash
php artisan key:generate
```

### 5. Migrar o banco de dados

```bash
php artisan migrate
```

### 6. Rodar o servidor local

```bash
php artisan serve
```