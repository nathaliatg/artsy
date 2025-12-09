# 🎨 Artsy: Plataforma de workshops criativos
![Linguagens](https://img.shields.io/badge/HTML-5-ffb6c1?style=for-the-badge)
![Linguagens](https://img.shields.io/badge/CSS-3-ffb6c1?style=for-the-badge)
![Linguagens](https://img.shields.io/badge/JavaScript-ES6-ffb6c1?style=for-the-badge)
![PHP](https://img.shields.io/badge/PHP-8-ffb6c1?style=for-the-badge)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-Database-ffb6c1?style=for-the-badge)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-ffb6c1?style=for-the-badge)

---

## Sobre o projeto

**Artsy** é uma aplicação web desenvolvida para a disciplina **Fundamentos da Programação Web**, com o objetivo de criar um sistema completo utilizando **HTML, CSS, JavaScript, PHP, PostgreSQL e Bootstrap**.

A aplicação conecta usuários a uma plataforma de **workshops criativos**, permitindo visualizar e gerenciar atividades apenas após autenticação.

---

## Funcionalidades

- 👤 **Cadastro de usuários** com senha criptografada  
- 🔐 **Login e autenticação**  
- 🖼️ **Interface responsiva** com Bootstrap  
- 🗂️ **CRUD completo** para workshops  
  - Criar  
  - Ler  
  - Atualizar  
  - Excluir  
- 🧩 Relacionamento **1:N** no banco de dados  
  - Ex.: `categorias` → `workshops`

---

## Banco de Dados (PostgreSQL)

O sistema utiliza três tabelas principais:

- `categorias` — tabela pai  
- `workshops` — tabela filha  
- `usuarios` — para login (senhas com `password_hash()`)

### Importar o banco

O arquivo SQL está em:

```
/db/artsydb.sql
```

Para importar:

```bash
psql -U seu_usuario -d seu_banco -f db/artsydb.sql
```

### 🔑 Configuração do banco de dados

Crie o arquivo **config/credenciais.php** 

```php
<?php
$host = 'localhost';
$dbname = 'seu_banco';
$user = 'seu_usuario';
$password = 'sua_senha';
?>
```


## Como executar o projeto

### 1️⃣ Clone o repositório

```bash
git clone https://github.com/seu-usuario/artsy.git
```

### 2️⃣ Importe o banco de dados

```bash
psql -U seu_usuario -d seu_banco -f db/artsydb.sql
```

### 3️⃣ Configure a conexão

Edite o arquivo:

```
config/credenciais.php
```

### 4️⃣ Inicie o servidor PHP

```bash
php -S localhost:8000
```

### 5️⃣ Acesse no navegador

```
http://localhost:8000
```

---

## ✨ Layout

O projeto utiliza **Bootstrap 5** para oferecer uma interface moderna, responsiva e consistente.

![Demo](ArtsyLinkedin.gif)

---

## 📷 Demonstração do Back-end

![Demo](ArtsyBack.gif)

---

## 💗 Desenvolvido por

**Nathalia Gonçalves**  
Estudante de Análise e Desenvolvimento de Sistemas  
Apaixonada por tecnologia, design e criação de experiências amigáveis 🌸

LinkedIn: https://www.linkedin.com/in/nathaliatg

Email: nathaliatgoncalves@gmail.com
