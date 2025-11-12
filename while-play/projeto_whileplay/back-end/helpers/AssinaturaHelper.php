<?php
require_once '../models/Assinatura.php';

class AssinaturaHelper {
    public static function usuarioTemAssinaturaAtiva($usuario_id) {
        try {
            $assinaturaModel = new Assinatura();
            $pdo = $assinaturaModel->getPdo();
            // Tabela correta segundo script SQL: 'assinaturas'
            $stmt = $pdo->prepare("SELECT * FROM assinaturas WHERE usuario_id = :usuario_id AND status = 'ativa' LIMIT 1");
            $stmt->execute([':usuario_id' => $usuario_id]);
            $assinatura = $stmt->fetch(PDO::FETCH_ASSOC);
            return $assinatura !== false;
        } catch (\Throwable $e) {
            // Se a tabela não existir, considerar sem assinatura
            return false;
        }
    }
}
?>
