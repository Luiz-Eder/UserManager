# Cadastro e Autenticação de Usuários
### Projeto da disciplina Design Patterns & Clean Code.

---

Poliana Gomes Rodriguez - 2000444

Eder Luiz - 1971959

## Funcionalidades Implementadas

### Cadastro do usuário
- Valida se o e-mail é válido.
- Gera hash seguro da senha com `passowrd_hash`.
- Valida se a senha é forte (A senha deve ter no mínimo 8 caracteres, 1 número e 1 letra maiúscula.)
- Não permite e-mails duplicados.

### Login do usuário 
- Valida se o e-mail e senha estâo corretos.
- 
---

## Exemplos de uso (Caso de testes)

Caso 1: Usuário se registra com o seu nome, email e senha. Saída esperada: cadastrado com sucesso.

Caso 2: Usuário se cadastra com email inválido. Saída esperada: “E-mail inválido”

Caso 3: Usuário tenta logar com senha incorreta. Saída esperada: "
