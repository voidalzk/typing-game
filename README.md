# typing-game
# Sistema de Jogo de Digitação - README

## Front-end

### Páginas

- **Página de Registro e Login:** Contém formulários para registro e login de usuários.
- **Página Principal:** Após o login, exibe opções para jogar, ver o histórico de partidas e acessar quadros de pontuação.
- **Página do Jogo:** Onde ocorre o jogo de digitação.
- **Página do Histórico de Partidas:** Mostra o histórico de partidas e pontuações.
- **Página de Ligas:** Permite aos usuários criar ou entrar em ligas.
- **Página de Quadros de Pontuação:** Exibe pontuações gerais, por liga e semanais.

### Tecnologias Utilizadas

- **HTML5, CSS3 e JavaScript:** Responsáveis pela estrutura, estilo e funcionalidades das páginas.
- **Validação de Campos:** Utilização do JavaScript para validar os formulários antes de serem enviados para o back-end.
- **Interação com Back-end:** Uso de AJAX ou Fetch API para comunicação com o back-end.

## Back-end

### Tecnologias Utilizadas

- **PHP:** Utilizado para processar e armazenar dados no banco de dados.
- **Banco de Dados:** MySQL, PostgreSQL, etc., utilizados para armazenar informações dos usuários, partidas e pontuações.
- **Sistema de Autenticação:** Implementação de um sistema de registro e login com hashing de senhas.

### Estrutura

- **Registro e Login de Usuários:** Recebe, valida e armazena informações de usuários no banco de dados.
- **Jogo de Digitação em JavaScript:** Componente JS que verifica a digitação correta de palavras.
- **Sistema de Pontuação:** Calcula e armazena as pontuações das partidas no banco de dados associadas aos usuários.
- **Gestão de Ligas:** Lógica para criar ligas, associar usuários a elas e calcular as pontuações.
- **Quadros de Pontuação:** Consultas ao banco de dados para extrair informações de pontuação e exibi-las no front-end.

### Estrutura de Diretórios

- index.php (Página inicial)
- login.php (Página de Login)
- registro.php (Página de Registro)
- jogo.php (Página do Jogo)
- historico.php (Página do Histórico de Partidas)
- ligas.php (Página de Ligas)
- quadros.php (Página de Quadros de Pontuação)

/css
  - style.css (Arquivo CSS)

/js
  - script.js (Arquivo JavaScript para funcionalidades do front-end)

/inc
  - config.php (Arquivo de configuração do banco de dados)
  - functions.php (Funções PHP úteis)

/auth
  - auth.php (Lógica de autenticação e autorização)
  
/game
  - game_logic.js (Lógica do Jogo em JavaScript)

/backend
  - database.php (Conexão com o banco de dados)
  - user_actions.php (Operações de usuários: registro, login)
  - game_actions.php (Operações do jogo: pontuação, histórico)
  - league_actions.php (Operações de ligas)


### Explicação da Estrutura

- `index.php`, `login.php`, `registro.php`, `jogo.php`, `historico.php`, `ligas.php`, `quadros.php`: Representam as diferentes páginas do sistema.
- `/css`: Pasta para arquivos CSS, onde `style.css` contém os estilos para o site.
- `/js`: Pasta para arquivos JavaScript, onde `script.js` gerencia as funcionalidades do front-end.
- `/inc`: Pasta para arquivos de inclusão, como configurações (`config.php`) e funções úteis (`functions.php`).
- `/auth`: Pasta para arquivos relacionados à autenticação de usuários.
- `/game`: Pasta para lógica do jogo em JavaScript.
- `/backend`: Pasta para arquivos de back-end, incluindo a conexão com o banco de dados (`database.php`), operações de usuários (`user_actions.php`), operações do jogo (`game_actions.php`) e operações de ligas (`league_actions.php`).

Esse arquivo README.md serve como uma visão geral da estrutura do projeto e das tecnologias utilizadas no front-end e no back-end.
