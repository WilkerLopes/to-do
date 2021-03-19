#Atividades

Aplicação construida com PHP 7 e Vue.js 2.6, no Backend foi usado SlinFamework, e no front foi usado Vue-bootstrap. Banco de dados foi usado o MYSQL. Abaixo segue as intruções para rodar a aplicação e poder testar.


## Start 
Clone o projeto para seu ambiente local. Na raíz do projeto, abra dois terminais, um será direcionado para o backend e outro para o frontend. E siga cada passo para cara terminal.


## Banco de dados
Antes de lavantar os servidores a seguir, primeiro, certifiquese que possui um servidor mysql rodanddo em segundo plano. Crie um novo banco, e rode o script 'db.sql', e certifique-se que todos os comandos rodaram sem erros.


## API
Em um terminal, entre na pasta '/API':
```bash
cd /API
```

DEntro da pasta da api, rode instale os pacotes usando o composer.
```bash
composer install
```

Carregue as informações banco de dados em: '/src/Query/Connetion.php'. Altere as informações de acordo com o bacno que for ultilizar.
```php
...
$host = '127.0.0.1';
$db   = 'pulse_test';
$user = 'root';
$pass = '';
$port = '3306';
...
```

Para levantar o servidor, use este comando:
```bash
composer start
```

Se tudo ocorrer bem, o seviodor está disponível em : 'http://localhost:5000'.


## Interface
No outro terminal, entre na pasta '/Interface':
```bash
cd /Interface
```

Façã a instalação dos pacotes por meio do npm com o comando:
```bash
npm install
```

Com todos os pacotws instalado, inicie a interface:
```
npm run serve
```

Se tudo correr bem, poderá acessar a interface em 'http://localhost:8080/'.

