<?php

class authcontroller {
    private $pdo;
    private $userModel;
    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->userModel = new User($pdo);
    }

    public function register($post, $files) {
        $errors = [];

       
        $nome = trim(filter_var($post['nome_completo'] ?? '', FILTER_SANITIZE_STRING));
        $username = trim(filter_var($post['username'] ?? '', FILTER_SANITIZE_STRING));
        $email = trim(filter_var($post['email'] ?? '', FILTER_SANITIZE_EMAIL));
        $senha = $post['senha'] ?? '';
        $senha_conf = $post['senha_conf'] ?? '';
        $data_nasc = $post['data_nascimento'] ?? '';
        $genero = $post['genero'] ?? '';

        
        if (!$nome) $errors[] = 'Nome completo é obrigatório.';
        if (!$username) $errors[] = 'Username é obrigatório.';
        if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Email inválido.';
        if (!$senha || strlen($senha) < 6) $errors[] = 'Senha mínima de 6 caracteres.';
        if (!preg_match('/[A-Z]/', $senha) || !preg_match('/\d/', $senha)) $errors[] = 'Senha deve conter pelo menos 1 letra maiúscula e 1 número.';
        if ($senha !== $senha_conf) $errors[] = 'Senha e confirmação não coincidem.';
       
        if (!strtotime($data_nasc)) $errors[] = 'Data de nascimento inválida.';
        if (!in_array($genero, ['Feminino','Masculino','Outro'])) $errors[] = 'Gênero inválido.';

     
        if ($this->userModel->findByEmail($email)) $errors[] = 'Email já cadastrado.';
        if ($this->userModel->findByUsername($username)) $errors[] = 'Username já existe.';

        $imagemPath = null;
        if (!empty($files['imagem']['name'])) {
            $img = $files['imagem'];
            $allowed = ['image/jpeg','image/png','image/webp'];
            if (!in_array($img['type'], $allowed)) $errors[] = 'Formato de imagem inválido.';
            if ($img['size'] > 2 * 1024 * 1024) $errors[] = 'Imagem deve ter até 2MB.';
            if (empty($errors)) {
                $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
                $novo = uniqid('uimg_') . '.' . $ext;
                if (!is_dir(UPLOADS_PATH)) mkdir(UPLOADS_PATH, 0755, true);
                move_uploaded_file($img['tmp_name'], UPLOADS_PATH . $novo);
                $imagemPath = 'public/uploads/' . $novo;
            }
        }

        if (!empty($errors)) return ['errors' => $errors, 'old' => $post];

        $hash = password_hash($senha, PASSWORD_DEFAULT);
        $data = [
            'nome_completo' => $nome,
            'username' => $username,
            'email' => $email,
            'senha' => $hash,
            'data_nascimento' => $data_nasc,
            'genero' => $genero,
            'imagem_perfil' => $imagemPath
        ];
        $this->userModel->create($data);
        return ['success' => true];
    }

    public function login($post) {
        $email = trim(filter_var($post['email'] ?? '', FILTER_SANITIZE_EMAIL));
        $senha = $post['senha'] ?? '';

        if (!$email || !$senha) return ['error' => 'Email e senha são obrigatórios.'];
        $user = $this->userModel->findByEmail($email);
        if (!$user) return ['error' => 'Email ou senha inválidos.'];
        if (!password_verify($senha, $user['senha'])) return ['error' => 'Email ou senha inválidos.'];

        
        $_SESSION['user_id'] = $user['id'];
        return ['success' => true];
    }

    public function logout() {
        session_unset();
        session_destroy();
    }
}
