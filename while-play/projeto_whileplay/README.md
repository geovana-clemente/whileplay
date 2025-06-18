## Testando o sistema de autenticação

1. **Cadastro**
   - Acesse `/while-play/projeto_whileplay/front-end/views/cadastro.html`.
   - Preencha nome, email, senha e confirme a senha.
   - Se o cadastro for bem-sucedido, você será redirecionado para o login.

2. **Login**
   - Acesse `/while-play/projeto_whileplay/front-end/views/login.html`.
   - Entre com o email e senha cadastrados.
   - Se o login for bem-sucedido, você será redirecionado para a área logada.

3. **Recuperação de senha**
   - Acesse `/while-play/projeto_whileplay/front-end/views/recuperar_senha.html`.
   - Informe o email cadastrado e defina uma nova senha.
   - Se a senha for alterada, faça login normalmente.

4. **Logout**
   - Clique em "Sair" ou acesse `/while_play/logout` para encerrar a sessão.

5. **Proteção de páginas**
   - As páginas PHP do back-end só podem ser acessadas se estiver logado.
   - Se tentar acessar sem login, será redirecionado para o login.

**Dica:**
- Para criar um usuário de teste rapidamente, rode o script `create_test_user.php` no back-end.
