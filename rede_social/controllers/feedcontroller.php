<?php

class FeedController {
    private $pdo;
    private $postModel;
    private $likeModel;
    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->postModel = new Post($pdo);
        $this->likeModel = new Like($pdo);
    }

    public function createPost($user_id, $conteudo) {
        $conteudo = trim($conteudo);
        if ($conteudo === '') return ['error' => 'Campo de post não pode estar vazio.'];
        $this->postModel->create($user_id, $conteudo);
        return ['success' => true];
    }

    public function toggleLike($user_id, $post_id) {
        return $this->likeModel->toggle($user_id, $post_id);
    }

    public function list($user_id) {
        return $this->postModel->getByUserAndFollowing($user_id);
    }
}
