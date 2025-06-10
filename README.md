# Observatório - Guia de Instalação

Este é um projeto Laravel 12 com TailwindCSS e Vite. Siga este guia para configurar o projeto em um PC zerado.

## Pré-requisitos

Antes de começar, certifique-se de ter os seguintes softwares instalados:

### 1. PHP 8.2 ou superior
- **Windows**: Baixe do [site oficial do PHP](https://www.php.net/downloads.php) ou use [XAMPP](https://www.apachefriends.org/pt_br/index.html)/[Laragon](https://laragon.org/)
- **macOS**: Use Homebrew: `brew install php`
- **Linux**: `sudo apt install php8.2 php8.2-cli php8.2-common php8.2-mysql php8.2-zip php8.2-gd php8.2-mbstring php8.2-curl php8.2-xml php8.2-bcmath`

### 2. Composer
Baixe e instale o [Composer](https://getcomposer.org/download/) (gerenciador de dependências PHP)

### 3. Node.js e npm
- Baixe e instale do [site oficial do Node.js](https://nodejs.org/) (versão LTS recomendada)
- Ou use o gerenciador de versões [nvm](https://github.com/nvm-sh/nvm)

### 4. Git
- **Windows**: [Git for Windows](https://gitforwindows.org/)
- **macOS**: `brew install git`
- **Linux**: `sudo apt install git`

## Instalação

### 1. Clone o repositório
```bash
git clone <url-do-repositorio>
cd observatorio
```

### 2. Instale as dependências PHP
```bash
composer install
```

### 3. Instale as dependências JavaScript
```bash
npm install
```

### 4. Configure o arquivo de ambiente
```bash
# Copie o arquivo de exemplo (se existir) ou crie um novo
cp .env.example .env
# ou se não existir o .env.example:
php artisan env:create
```

### 5. Gere a chave da aplicação
```bash
php artisan key:generate
```

### 7. Execute as migrações
```bash
php artisan migrate
```

### 9. Crie o link simbólico para o storage
```bash
php artisan storage:link
```

## Executando o projeto

### Modo de desenvolvimento
Para executar o projeto em modo de desenvolvimento com hot reload:

```bash
# Inicia o servidor Laravel, queue worker, logs e Vite simultaneamente
composer run dev
```

