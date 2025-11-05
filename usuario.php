<?php
require_once '../CORE/conexao.php';

class UsuarioDAO {
    private $conn;


     //conexão com o banco de dados.
    
    public function __construct() {

        $this->conn = Conexao::getConexao();
    }

    /**
     * Cadastra um novo usuário
     * 
     * @param string $nome 
     * @param string $email 
     * @param string $senha_pura Senha em texto
     * @param string $telefone Telefone do usuário.
     * @param string $cidade Cidade do usuário.
     * @param string $estado Estado do usuário 
     * @param string $tipo_usuario ('Adotante', 'ONG', 'Admin').
     * @return bool Retorna true em caso de sucesso, false caso contrário.
     */
    public function cadastrar(string $nome, string $email, string $senha_pura, string $telefone, string $cidade, string $estado, string $tipo_usuario): bool {

        $senha_hash = password_hash($senha_pura, PASSWORD_DEFAULT);

        $stmt = $this->conn->prepare("
            INSERT INTO USUARIO 
                (nome, email, senha_hash, telefone, cidade, estado, tipo_usuario)
            VALUES 
                (?, ?, ?, ?, ?, ?, ?)
        ");

        

        $stmt->bind_param("sssssss", $nome, $email, $senha_hash, $telefone, $cidade, $estado, $tipo_usuario);
        
        return $stmt->execute();
    }

    /**
     *  login verificando o email e a senha.
     * 
     * @param string $email 
     * @param string $senha_pura 
     * @return array|null 
     */
    public function login(string $email, string $senha_pura): ?array {
        
        $stmt = $this->conn->prepare("
            SELECT id_usuario, nome, email, senha_hash, tipo_usuario 
            FROM USUARIO 
            WHERE email = ?
        ");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $usuario = $resultado->fetch_assoc();

        if (!$usuario) {
            return null;
        }

        // Verifica a Senha
        
        if (password_verify($senha_pura, $usuario['senha_hash'])) {
            
            unset($usuario['senha_hash']);
            return $usuario;
        } else {
          
            return null;
        }
    }

    /**
     * Lista todos os usuários
     * 
     * @return array 
     */
    public function listarUsuarios(): array {
       
        $resultado = $this->conn->query("SELECT * FROM USUARIO");
        $usuarios = [];

        while ($linha = $resultado->fetch_assoc()) {
           
            unset($linha['senha_hash']);
            $usuarios[] = $linha;
        }

        return $usuarios;
    }
}
?>
