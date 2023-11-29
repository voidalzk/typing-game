- Feito por:
- Bruno Brugnerotto de Lara GRR20230933
- Gabriel Francelino Voidaleski GRR20234966
- João Pedro Guerios GRR20234965
- Pedro Henrique GRR20230960

# typing-game
# Sistema de Jogo de Digitação - README

## Front-end

### Páginas

- **Página de Registro e Login:** Contém formulários para registro e login de usuários.
- **Página Principal:** Após o login, exibe opções para jogar, ver o histórico de partidas e acessar quadros de pontuação.
- **Página do Jogo:** Onde ocorre o jogo de digitação.
- **Página do Histórico de Partidas:** Mostra o histórico de partidas e pontuações.
- **Página de Clans:** Permite aos usuários visualizar seu clan, pontuações semanais e mais.
- **Página de Criar/entrar em Clans:** Permite aos usuários criar ou entrar em Clans.

### Tecnologias Utilizadas

- **HTML5, CSS3, PHP e JavaScript:** Responsáveis pela estrutura, estilo e funcionalidades das páginas.

## Back-end

### Tecnologias Utilizadas

- **PHP:** Utilizado para processar e armazenar dados no banco de dados.
- **Banco de Dados:** MySQL

![Exemplo](assets/img/bd.png)

### Estrutura

- **Registro e Login de Usuários:** Recebe, valida e armazena informações de usuários no banco de dados.
- **Jogo de Digitação em JavaScript:** Componente JS que verifica a digitação correta de palavras.
- **Sistema de Pontuação:** Calcula e armazena as pontuações das partidas no banco de dados associadas aos usuários.
- **Gestão de Clans:** Lógica para criar Clans, associar usuários a elas e calcular as pontuações.
- **Quadros de Pontuação:** Consultas ao banco de dados para extrair informações de pontuação e exibi-las no front-end.

### Estrutura de Diretórios

- index.php (Página inicial)
- login.php (Página de Login)
- signup.php (Página de Registro)
- jogo.php (Página do Jogo)
- historico.php (Página do Histórico de Partidas)
- clans.php (Página de Clans)
- ger-clans.php (Página de Criação de Clans)

/public
  - public/ (pasta com arquivos CSS)
  - game.js (Arquivo JavaScript para funcionalidades do jogo)
  - signup.js (Arquivo JavaScript para autentificação do usuário)

/inc
  - config.php (Arquivo de configuração do banco de dados)
  - functions.php (Funções PHP úteis)
  - auth.php (Lógica de autenticação e autorização)


### Explicação da Estrutura

- `index.php`, `login.php`, `signup.php`, `jogo.php`, `hist.php`,  `clans.php`, `ger-clans.php`: Representam as diferentes páginas do sistema.
- `/public`: Pasta para arquivos CSS e JS  para o site.
- `/inc`: Pasta para arquivos de inclusão, como configurações (`config.php`) e funções úteis (`functions.php`).
- `/views`: Pasta para arquivos das telas.