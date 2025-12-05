<?php

class SearchController {
    private $pdo;
    private $userModel;
    private $followModel;
    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->userModel = new User($pdo);
        $this->followModel = new Follow($pdo);
    }

    public function search($term) {
        $term = trim($term);
        if ($term === '') return [];
        return $this->userModel->search($term);
    }

    public function toggleFollow($follower_id, $following_id) {
        $f = new Follow($this->pdo);
        return $f->toggle($follower_id, $following_id);
    }

    public function isFollowing($follower_id, $following_id) {
        return $this->followModel->isFollowing($follower_id, $following_id);
    }
}
