<?php

class Post {
    private $pdo;
    public function __construct($pdo) { $this->pdo = $pdo; }

    public function create($user_id, $conteudo) {
        $stmt = $this->pdo->prepare('INSERT INTO posts (user_id, conteudo) VALUES (?, ?)');
        return $stmt->execute([$user_id, $conteudo]);
    }

    public function getByUserAndFollowing($user_id) {
       
        $stmt = $this->pdo->prepare(
            'SELECT p.*, u.nome_completo, u.username, u.imagem_perfil,
             (SELECT COUNT(*) FROM likes l WHERE l.post_id = p.id) as likes_count,
             (SELECT COUNT(*) FROM likes l WHERE l.post_id = p.id AND l.user_id = ?) as liked_by_me
             FROM posts p
             JOIN users u ON p.user_id = u.id
             WHERE p.user_id = ? 
             OR p.user_id IN (SELECT following_id FROM follows WHERE follower_id = ?)
             ORDER BY p.criado_em DESC'
        );
        $stmt->execute([$user_id, $user_id, $user_id]);
        return $stmt->fetchAll();
    }

    public function findById($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM posts WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
