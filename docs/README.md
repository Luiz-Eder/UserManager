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
- Valida se o e-mail e senha estão corretos.
- Senha validada com password_verify.

### Reset de senha
- Permite atualizar a senha de um usuário existente.
- Aplica novamente as regras de senha forte.
- Substitui pela nova senha com password_hash.

---

## Exemplos de uso (Caso de testes)

### Caso 1 — Cadastro válido

Entrada: nome Maria Oliveira, email maria@email.com, senha Senha123.
Saída esperada: Usuário cadastrado com sucesso.


### Caso 2 — Cadastro com e-mail inválido

Entrada: nome Pedro, email pedro@@email, senha Senha123.
Saída esperada: Erro: E-mail inválido.


### Caso 3 — Tentativa de login com senha errada

Entrada: email eder@email.com, senha SenhaIncorreta.
Saída esperada: Erro: Credenciais inválidas.


### Caso 4 — Reset de senha válido
Entrada: id 2, nova senha NovaSenhaPoliana2.
Saída esperada: Sucesso: Senha de 'Poliana' alterada.


### Caso 5 — Cadastro de usuário com e-mail duplicado
Entrada: email já existente (eder@email.com).
Saída esperada: Erro: E-mail já está em uso.


### Caso 6 — Login após reset de senha (extra)
Entrada: email poliana@email.com, senha NovaSenhaPoliana2.
Saída esperada: Sucesso: Login realizado. Bem-vindo, Poliana!

