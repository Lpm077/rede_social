<?php

class user {
    private $pdo;
    public function __construct($pdo) { $this->pdo = $pdo; }

    public function findByEmail($email) {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function findByUsername($username) {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    public function findById($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $stmt = $this->pdo->prepare('INSERT INTO users (nome_completo, username, email, senha, data_nascimento, genero, imagem_perfil) VALUES (?, ?, ?, ?, ?, ?, ?)');
        return $stmt->execute([
            $data['nome_completo'],
            $data['username'],
            $data['email'],
            $data['senha'],
            $data['data_nascimento'],
            $data['genero'],
            $data['imagem_perfil'] ?? null
        ]);
    }

    public function update($id, $fields) {
        $sets = [];
        $values = [];
        foreach ($fields as $k => $v) {
            $sets[] = "$k = ?";
            $values[] = $v;
        }
        $values[] = $id;
        $sql = 'UPDATE users SET ' . implode(',', $sets) . ' WHERE id = ?';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($values);
    }

    public function search($term) {
        $like = '%' . $term . '%';
        $stmt = $this->pdo->prepare('SELECT id, nome_completo, username, imagem_perfil FROM users WHERE nome_completo LIKE ? OR username LIKE ? LIMIT 50');
        $stmt->execute([$like, $like]);
        return $stmt->fetchAll();
    }
}
