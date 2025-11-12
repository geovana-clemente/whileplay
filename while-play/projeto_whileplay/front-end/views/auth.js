// Utilitários para autenticação

// Verificar se o usuário está logado
function checkAuth() {
    return fetch('../../back-end/public/auth_router.php?action=check-auth', {
        method: 'GET',
        credentials: 'same-origin'
    })
    .then(response => response.json())
    .catch(error => {
        console.error('Erro ao verificar autenticação:', error);
        return { logged: false, user: null };
    });
}

// Fazer logout
function logout() {
    if (confirm('Deseja realmente sair?')) {
        window.location.href = '../../back-end/public/auth_router.php?action=logout';
    }
}

// Redirecionar para login se não autenticado
function requireAuth() {
    checkAuth().then(response => {
        if (!response.logged) {
            alert('Você precisa estar logado para acessar esta página.');
            window.location.href = 'login.html';
        }
    });
}

// Exibir informações do usuário na página
function displayUserInfo(elementId) {
    checkAuth().then(response => {
        if (response.logged) {
            const element = document.getElementById(elementId);
            if (element) {
                element.textContent = `Olá, ${response.user.nome}!`;
            }
        }
    });
}

// Atualizar links de navegação baseado no status de login
function updateNavigation() {
    checkAuth().then(response => {
        const loginLink = document.getElementById('loginLink');
        const logoutLink = document.getElementById('logoutLink');
        
        if (response.logged) {
            if (loginLink) loginLink.style.display = 'none';
            if (logoutLink) {
                logoutLink.style.display = 'block';
                logoutLink.onclick = logout;
            }
        } else {
            if (loginLink) loginLink.style.display = 'block';
            if (logoutLink) logoutLink.style.display = 'none';
        }
    });
}

// Inicializar verificações quando a página carregar
document.addEventListener('DOMContentLoaded', function() {
    // Se a página atual for uma página protegida, verificar autenticação
    const protectedPages = ['homepage2_com_login.html', 'perfil_com_login.html', 'biblioteca.html'];
    const currentPage = window.location.pathname.split('/').pop();
    
    if (protectedPages.includes(currentPage)) {
        requireAuth();
    }
    
    // Atualizar navegação em todas as páginas
    updateNavigation();
    
    // Exibir informações do usuário se houver elemento específico
    displayUserInfo('userInfo');
});