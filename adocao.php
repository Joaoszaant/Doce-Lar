<?php
require_once '../CORE/conexao.php';

class AdocaoDAO {
    private $conn;

    
    public function __construct() {
        $this->conn = Conexao::getConexao();
    }

    /**
     * Registra  solicitação de adoção.
     * 
     * @param int $id_adotante id do adotante
     * @param int $id_animal id do animal que vai ser adotado
     * @param string $observacoes
     * @return bool 
     */
    public function solicitarAdocao(int $id_adotante, int $id_animal, string $observacoes = null): bool {
       
        $stmt = $this->conn->prepare("
            INSERT INTO ADOCAO 
                (id_adotante, id_animal, observacoes)
            VALUES 
                (?, ?, ?)
        ");

        
        $stmt->bind_param("iis", $id_adotante, $id_animal, $observacoes);
        
        return $stmt->execute();
    }

    /**
     * Atualiza o status de adoção.
     * 
     * @param int $id_adocao 
     * @param string $novo_status
     * @param string $observacoes
     * @return bool 
     */
    public function atualizarStatusAdocao(int $id_adocao, string $novo_status, string $observacoes = null): bool {
        $stmt = $this->conn->prepare("
            UPDATE ADOCAO 
            SET status_transacao = ?, observacoes = ? 
            WHERE id_adocao = ?
        ");
      
        $stmt->bind_param("ssi", $novo_status, $observacoes, $id_adocao);
        return $stmt->execute();
    }

    /**
     * Lista os pedidos  de adoção.
     * 
     * @param string $status Opcional. 
     * @return array 
     */
    public function listarAdocoes(string $status = 'todos'): array {
        $sql = "SELECT * FROM ADOCAO";
        $params = [];
        $types = "";

        if ($status !== 'todos') {
            $sql .= " WHERE status_transacao = ?";
            $params[] = $status;
            $types = "s";
        }

        $stmt = $this->conn->prepare($sql);
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }
        
        $stmt->execute();
        $resultado = $stmt->get_result();
        $adocoes = [];

        while ($linha = $resultado->fetch_assoc()) {
            $adocoes[] = $linha;
        }

        return $adocoes;
    }
}
?>
