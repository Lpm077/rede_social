<?php

class ProfileController {
    private $pdo;
    private $userModel;
    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->userModel = new User($pdo);
    }

    public function getProfile($id) {
        return $this->userModel->findById($id);
    }

    public function update($id, $post, $files) {
        $fields = [];
        if (!empty($post['nome_completo'])) $fields['nome_completo'] = trim(filter_var($post['nome_completo'], FILTER_SANITIZE_STRING));
        if (!empty($post['username'])) $fields['username'] = trim(filter_var($post['username'], FILTER_SANITIZE_STRING));
        if (!empty($post['data_nascimento'])) $fields['data_nascimento'] = $post['data_nascimento'];
        if (!empty($post['genero'])) $fields['genero'] = $post['genero'];

        if (!empty($files['imagem']['name'])) {
            $img = $files['imagem'];
            $allowed = ['image/jpeg','image/png','image/webp'];
            if (!in_array($img['type'], $allowed)) return ['error' => 'Formato de imagem inválido.'];
            $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
            $novo = uniqid('uimg_') . '.' . $ext;
            if (!is_dir(UPLOADS_PATH)) mkdir(UPLOADS_PATH, 0755, true);
            move_uploaded_file($img['tmp_name'], UPLOADS_PATH . $novo);
            $fields['imagem_perfil'] = 'public/uploads/' . $novo;
        }

        if (!empty($fields)) {
            $this->userModel->update($id, $fields);
        }
        return ['success' => true];
    }
}
