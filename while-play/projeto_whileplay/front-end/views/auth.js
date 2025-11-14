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

    // Aplicar foto do usuário no ícone do perfil, se houver
    applyProfilePhotoToNavbar();
});

// Substitui o ícone do perfil na navbar pela foto do usuário (se existir)
function applyProfilePhotoToNavbar() {
    checkAuth().then(response => {
        if (!response.logged) return;

        const foto = response.user && response.user.foto_url ? response.user.foto_url : null;
        const icon = document.querySelector('.profile-icon');
        if (!icon) return;

        if (foto) {
            // Limpar conteúdo atual e inserir imagem
            icon.innerHTML = '';
            const img = document.createElement('img');
            img.alt = 'Foto do perfil';
            img.style.width = '100%';
            img.style.height = '100%';
            img.style.objectFit = 'cover';
            img.style.borderRadius = '50%';
            // Prefixo para acessar o backend a partir do front
            img.src = '../../back-end/' + foto + '?t=' + Date.now(); // cache-busting
            icon.appendChild(img);
        }
    }).catch(() => {});
}