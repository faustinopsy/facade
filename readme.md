# Implementação do Padrão Facade em um Sistema de Login com Verificação de Código
1. Estrutura do Sistema
## Subsistemas Complexos:

- AuthService: Autentica as credenciais do usuário.
- EmailService: Envia códigos de verificação por e-mail.
- CodeService: Gera e valida códigos de verificação.
- TokenService: Gera tokens JWT.
- LogService: Registra logs de acesso.

## Facade:

- LoginFacade: Encapsula a interação com os subsistemas para realizar o processo de login completo.

## Processo de Login sem Facade
Sem o Padrão Facade, o controlador de login precisaria interagir diretamente com cada subsistema:

### Autenticar o Usuário:
- Verificar as credenciais no AuthService.
### Gerar e Enviar Código:
- Gerar o código no CodeService.
- Enviar o código via EmailService.
### Validar o Código:
- Validar o código no CodeService.
### Gerar Token:
- Gerar o token JWT no TokenService.
### Registrar Log:
- Registrar cada ação no LogService.
Isso resultaria em um controlador com múltiplas responsabilidades, aumentando a complexidade e o acoplamento.

## Processo de Login com Facade
Com o Padrão Facade, toda essa lógica é encapsulada na LoginFacade, proporcionando uma interface única e simplificada para o controlador de login:

### Chamar loginFacade->login($username, $password, $email):
- Internamente, autentica o usuário.
- Gera e envia o código de verificação.
- Registra os logs correspondentes.
### Chamar loginFacade->confirmCode($username, $code):
- Valida o código de verificação.
- Gera o token JWT.
- Registra os logs correspondentes.
### Chamar loginFacade->logout($username) (opcional):
- Registra o logout.

## Vantagens:

- Simplificação: O controlador lida apenas com a fachada, sem precisar conhecer os detalhes dos subsistemas.
- Desacoplamento: Mudanças nos subsistemas não afetam o controlador, desde que a interface da fachada permaneça a mesma.
- Centralização: Toda a lógica de login está centralizada na fachada, facilitando manutenção e extensão.

## UML

```
+----------------+          +----------------+          +-----------------------+
|  LoginFacade   |<>------->|  AuthService   |          | EmailService          |
+----------------+          +----------------+          +-----------------------+
| +login()       |          | +authenticate()|          | +sendVerificationCode()|
| +confirmCode() |          +----------------+          +-----------------------+
| +logout()      |                                            |
+----------------+            +----------------+          +----------------+
            |                 | CodeService    |          | TokenService   |
            |                 +----------------+          +----------------+
            |                        |
            |                        |
            |                        |
            |                 +----------------+
            |                 | LogService     |
            |                 +----------------+
            |
            |
            v
    +----------------+
    |    Controller  |
    +----------------+
    | +login()       |
    | +confirmCode() |
    +----------------+
```

## Considerações Finais
O conteudo do repositório é experimental como um modelo apenas para exemplificar em uma aula sobre padrões de projeto e é apenas um modelo que precisa ser expandido.
O uso do Padrão Facade neste contexto de login:

Simplifica o controlador, que agora lida apenas com a fachada e não com múltiplos subsistemas.
Desacopla os componentes, permitindo alterações internas sem impactar o controlador.
Centraliza a lógica de login, facilitando manutenção e extensão.

## Recursos Adicionais
- Documentação do Firebase JWT: Firebase PHP-JWT
- Livros:
Design Patterns: Elements of Reusable Object-Oriented Software por Erich Gamma, Richard Helm, Ralph Johnson e John Vlissides (Gang of Four).
- Sites:
Refactoring Guru
SourceMaking
