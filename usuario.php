<?php
require_once '../CORE/conexao.php';
require_once '../MODEL/usuario.php';


class Usuario {
    private $conn;

    public function __construct() {
      
        $this->conn = Conexao::getConexao();   // Pega a conexão com o banco
    }

    // Cadastrar novo usuário
    public function cadastrar($usuario, $nome, $estado, $cidade, $telefone, $senha) {
        $stmt = $this->conn->prepare("
            INSERT INTO usuarios (usuario, nome, estado, cidade, telefone, senha)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param("ssssss", $usuario, $nome, $estado, $cidade, $telefone, $senha);
        return $stmt->execute();
    }

    // Fazer login (verificar se existe usuário e senha)
    public function login($usuario, $senha) {
        $stmt = $this->conn->prepare("
            SELECT * FROM usuarios WHERE usuario = ? AND senha = ?
        ");
        $stmt->bind_param("ss", $usuario, $senha);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc(); // retorna os dados se achar, ou null se não
    }

    // Listar todos os usuários (pra teste)
    public function listarUsuarios() {
        $resultado = $this->conn->query("SELECT * FROM usuarios");
        $usuarios = [];

        while ($linha = $resultado->fetch_assoc()) {
            $usuarios[] = $linha;
        }

        return $usuarios;
    }
}
?>
