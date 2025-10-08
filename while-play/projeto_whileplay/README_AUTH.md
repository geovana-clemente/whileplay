# Sistema de Autenticação WhilePlay

Este é o sistema de cadastro e login para a plataforma WhilePlay.

## Configuração

### 1. Banco de Dados
1. Certifique-se de que o XAMPP está rodando (Apache + MySQL)
2. Acesse o phpMyAdmin (http://localhost/phpmyadmin)
3. Execute o script SQL em `back-end/users_table.sql` para criar o banco e a tabela

### 2. Configuração do Servidor
- Coloque o projeto na pasta `htdocs` do XAMPP
- O caminho deve ser: `C:\xampp\htdocs\GitHub\whileplay\whileplay\while-play\projeto_whileplay`

### 3. Testar o Sistema
1. Acesse: `http://localhost/GitHub/whileplay/whileplay/while-play/projeto_whileplay/front-end/views/teste_auth.html`
2. Teste as funcionalidades:
   - Cadastro de usuário
   - Login
   - Verificação de autenticação
   - Logout

## Rotas Disponíveis

### Back-end (API)
- `POST /GitHub/whileplay/while-play/projeto_whileplay/back-end/register` - Cadastro de usuário
- `POST /GitHub/whileplay/while-play/projeto_whileplay/back-end/login` - Login
- `GET /GitHub/whileplay/while-play/projeto_whileplay/back-end/logout` - Logout  
- `GET /GitHub/whileplay/while-play/projeto_whileplay/back-end/check-auth` - Verificar autenticação

### Front-end (Páginas)
- `cadastro.html` - Página de cadastro
- `login.html` - Página de login
- `teste_auth.html` - Página de teste do sistema

## Funcionalidades Implementadas

### ✅ Cadastro de Usuários
- Validação de nome (mínimo 3 caracteres, apenas letras)
- Validação de email (formato válido)
- Validação de senha (mínimo 6 caracteres)
- Confirmação de senha
- Verificação de email único
- Hash seguro da senha (password_hash)

### ✅ Sistema de Login
- Autenticação por email e senha
- Verificação de senha com password_verify
- Gerenciamento de sessões
- Redirecionamento automático

### ✅ Controle de Sessão
- Sessões PHP seguras
- Verificação de autenticação via AJAX
- Logout funcional
- Proteção de páginas que requerem login

### ✅ Tratamento de Erros
- Mensagens de erro específicas
- Redirecionamentos com parâmetros
- Validação tanto no front-end quanto no back-end

## Estrutura de Arquivos

```
back-end/
├── config/
│   └── database.php          # Configuração do banco
├── controllers/
│   ├── UserController.php    # Controller de autenticação (NOVO)
│   └── ...outros controllers
├── models/
│   ├── User.php             # Model do usuário (NOVO)
│   └── ...outros models
├── public/
│   └── index.php            # Router principal (ATUALIZADO)
└── users_table.sql          # Script do banco (ATUALIZADO)

front-end/views/
├── cadastro.html            # Página de cadastro (ATUALIZADA)
├── login.html               # Página de login (ATUALIZADA)
├── auth.js                  # JavaScript de autenticação (NOVO)
└── teste_auth.html          # Página de teste (NOVA)
```

## Como Usar

### 1. Cadastro
```html
<!-- Formulário já configurado em cadastro.html -->
<form action="../../back-end/register" method="POST">
    <input type="text" name="nome" placeholder="Nome completo" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Senha" required>
    <input type="password" name="password_confirm" placeholder="Confirme a senha" required>
    <button type="submit">Cadastrar</button>
</form>
```

### 2. Login
```html
<!-- Formulário já configurado em login.html -->
<form action="../../back-end/login" method="POST">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Logar</button>
</form>
```

### 3. Verificar Autenticação (JavaScript)
```javascript
// Incluir auth.js na página
<script src="auth.js"></script>

// A verificação automática já está configurada
// Para verificar manualmente:
checkAuth().then(response => {
    if (response.logged) {
        console.log('Usuário:', response.user.nome);
    } else {
        console.log('Não logado');
    }
});
```

## Próximos Passos

Para continuar o desenvolvimento:

1. **Integrar com outras páginas**: Adicionar verificação de autenticação em páginas que precisam
2. **Melhorar UX**: Adicionar loading, melhor feedback visual
3. **Recuperação de senha**: Implementar sistema de reset de senha
4. **Perfil do usuário**: Criar páginas para editar dados do usuário
5. **Roles e permissões**: Adicionar sistema de papéis (admin, user, etc.)

## Problemas Conhecidos

- Certifique-se de que o Apache e MySQL estão rodando no XAMPP
- Verifique se as configurações do banco em `config/database.php` estão corretas
- Os caminhos das rotas são específicos para a estrutura atual do projeto

## Teste Rápido

1. Acesse: http://localhost/GitHub/whileplay/whileplay/while-play/projeto_whileplay/front-end/views/teste_auth.html
2. Cadastre um usuário
3. Faça login com as credenciais
4. Verifique se o status mostra "usuário logado"
5. Teste o logout