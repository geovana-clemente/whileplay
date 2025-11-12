const BASE_URL = 'http://localhost/GitHub/whileplay/whileplay/while-play/back-end/public';

const api = {
    login: async (email, senha) => {
        const resposta = await fetch(`${BASE_URL}/auth_router.php`, {
            method: 'POST', 
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email, senha })
        });
        return resposta.json();
    },
    listarPersonagens: async () => {
        const resposta = await fetch(`${BASE_URL}/index.php?controller=personagem&action=list`);
        return resposta.json();
    },
    listarRoteiros: async () => {
        const resposta = await fetch(`${BASE_URL}/index.php?controller=roteiro&action=list`);
        return resposta.json();
    },
    listarPublicacoes: async () => {
        const resposta = await fetch(`${BASE_URL}/index.php?controller=publicar&action=list`);
        return resposta.json();
    },
    atualizarPerfil: async (dados) => {
        const resposta = await fetch(`${BASE_URL}/index.php?controller=perfil&action=update`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(dados)
        });
        return resposta.json();
    },
    verificarAssinatura: async (userId) => {
        const resposta = await fetch(`${BASE_URL}/index.php?controller=assinatura&action=verify&userId=${userId}`);
        return resposta.json();
    }
};