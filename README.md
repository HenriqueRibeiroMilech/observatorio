### Opção 1: Usando Laragon (Recomendado para Windows)
O [Laragon](https://laragon.org/) é um ambiente de desenvolvimento completo que já inclui:
- PHP 8.2+
- MySQL/MariaDB
- Apache/Nginx
- Node.js
- Composer
- Git

## Instalação

### 1. Clone o repositório
Se usando Laragon, clone dentro da pasta `C:\laragon\www\`:

```bash
# Navegue até a pasta www do Laragon
cd C:\laragon\www

# Clone o repositório
git clone <url-do-repositorio>
cd observatorio
```

**Nota:** No Laragon, o projeto ficará automaticamente disponível em `http://observatorio.test`

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

### 5. Gere a chave da aplicação
```bash
php artisan key:generate
```

### 6. Execute as migrações
```bash
php artisan migrate
```

### 7. Crie o link simbólico para o storage
```bash
php artisan storage:link
```

## Executando o projeto

### Com Laragon
1. Certifique-se de que o Laragon está rodando (Apache/Nginx iniciado)
2. Acesse `http://observatorio.test` no navegador
3. Para desenvolvimento com hot reload:
