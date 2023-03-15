<h1 align="center">
  <img src="https://www.gazin.com.br/images/svg/new-logo.svg" alt="Logo">
</h1>

<h3 align="center">
  <!-- alterar link para Gazin -->
  Challenge potential-crud <a href="https://www.gazin.com.br/">Gazin</a>
</h3>

## Sobre

Gazin Pontential CRUD

## Tecnologias


Utilizei a Stack: Para o Backend o laravel(php) e para o FrontEnd foi utilizado Vue.JS, no banco fui utilizado o mysql com o Xampp
## Rodando

### **Baixando o repositório**

```bash
git clone https://github.com/lucasfdcampos/gazin-tech-potential-crud.git
```

### **DataBase**

```bash
CREATE DATABASE db_gazin
```

Acesso ao banco de dados pelas credenciais

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_gazin
DB_USERNAME=root
DB_PASSWORD=
```

### **Back-end**

```bash
cd Gazin-Tech-Back 
```

### Instalar as dependências 

```bash
npm install
```

### Rodar as migrations :

```bash
php artisan migrate
```

### Rodar as seeders de do Nivel:
```bash
php artisan db:seed   
```

### Projeto
> Para start o servidor

```bash
php artisan serve
```

### **Front-end**

No front-end foi utilizado Vue.js, para consumir a APi do back end, com o layout resposivo, com algumas biliotecas para seu desempenho

<p align="center">
  O azul dos textos do menu lateral foi retiro do site "https://www.gazintech.com.br/" junto com o logo
</p>


```bash
cd Gazin-Tech-Front 
```
### Instalar as dependências 

```bash
npm install
```

### Projeto
> Para start 

```bash
npm run serve
```

## End-points 

### **Nível**

**Cadastrar um novo Nivel [POST]**

```bash
/niveis
```

**Buscar os níveis existentes  [POST]**
```bash
/niveis
```

**Alterar o nível existentes  [PUT]**
```bash
niveis/id
```

Deletar o nível existentes  [DELETE]**
```bash
niveis/id
```

### **Desenvolvedores**

**Cadastrar um novo Desenvolvedor[POST]**
```bash
/desenvolvedor/desenvolvedores
```

**Buscar todos os Desenvolvedor[GET]**
```bash
/desenvolvedor/desenvolvedores
```

**Buscar um Desenvolvedor[GET]**
```bash
/desenvolvedor/desenvolvedores/id
```

**Alterar um Desenvolvedor[PUT]**
```bash
/desenvolvedor/desenvolvedores/id
```

**Buscar um Desenvolvedor[DELETE]**
```bash
/desenvolvedor/desenvolvedores/id
```



