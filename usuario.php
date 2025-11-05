<?php
require_once '../CORE/conexao.php';

class UsuarioDAO {
    private $conn;


     //Construtor: Inicializa a conexão com o banco de dados.
    
    public function __construct() {

        $this->conn = Conexao::getConexao();
    }

    /**
     * Cadastra um novo usuário no banco de dados.
     * 
     * @param string $nome 
     * @param string $email 
     * @param string $senha_pura Senha em texto puro (será hasheada antes de salvar).
     * @param string $telefone Telefone do usuário.
     * @param string $cidade Cidade do usuário.
     * @param string $estado Estado do usuário (UF).
     * @param string $tipo_usuario Tipo de usuário ('Adotante', 'ONG', 'Admin').
     * @return bool Retorna true em caso de sucesso, false caso contrário.
     */
    public function cadastrar(string $nome, string $email, string $senha_pura, string $telefone, string $cidade, string $estado, string $tipo_usuario): bool {
        // CORREÇÃO CRÍTICA DE SEGURANÇA: Hashing da Senha
        // É crucial usar password_hash() para armazenar a senha de forma segura.
        $senha_hash = password_hash($senha_pura, PASSWORD_DEFAULT);

        // CORREÇÃO: Tabela e colunas ajustadas para o seu esquema SQL (USUARIO, email, senha_hash, tipo_usuario)
        $stmt = $this->conn->prepare("
            INSERT INTO USUARIO 
                (nome, email, senha_hash, telefone, cidade, estado, tipo_usuario)
            VALUES 
                (?, ?, ?, ?, ?, ?, ?)
        ");

        // Bind dos Parâmetros: Ajustado para 7 parâmetros (nome, email, hash, telefone, cidade, estado, tipo_usuario)
        $stmt->bind_param("sssssss", $nome, $email, $senha_hash, $telefone, $cidade, $estado, $tipo_usuario);
        
        return $stmt->execute();
    }

    /**
     * Realiza o processo de login verificando o email e a senha.
     * 
     * @param string $email Email do usuário.
     * @param string $senha_pura Senha em texto puro fornecida pelo usuário.
     * @return array|null Retorna um array associativo com os dados do usuário em caso de sucesso, ou null caso contrário.
     */
    public function login(string $email, string $senha_pura): ?array {
        // CORREÇÃO: Busca o usuário pelo campo 'email' (login) e seleciona 'senha_hash'
        $stmt = $this->conn->prepare("
            SELECT id_usuario, nome, email, senha_hash, tipo_usuario 
            FROM USUARIO 
            WHERE email = ?
        ");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $usuario = $resultado->fetch_assoc();

        // 1. Verifica se o usuário foi encontrado
        if (!$usuario) {
            return null; // Usuário não encontrado
        }

        // 2. CORREÇÃO CRÍTICA DE SEGURANÇA: Verifica a Senha
        // Usa password_verify() para comparar a senha pura com o hash armazenado.
        if (password_verify($senha_pura, $usuario['senha_hash'])) {
            // Senha correta. Remove o hash da senha antes de retornar por segurança.
            unset($usuario['senha_hash']);
            return $usuario;
        } else {
            // Senha incorreta
            return null;
        }
    }

    /**
     * Lista todos os usuários (método de teste/administração).
     * 
     * @return array Retorna um array de arrays associativos com todos os usuários.
     */
    public function listarUsuarios(): array {
        // CORREÇÃO: Tabela ajustada para USUARIO
        $resultado = $this->conn->query("SELECT * FROM USUARIO");
        $usuarios = [];

        while ($linha = $resultado->fetch_assoc()) {
            // Por segurança, não retornar o hash da senha
            unset($linha['senha_hash']);
            $usuarios[] = $linha;
        }

        return $usuarios;
    }
}
?>
