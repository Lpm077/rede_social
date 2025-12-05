<?php

class Like {
    private $pdo;
    public function __construct($pdo) { $this->pdo = $pdo; }

    public function toggle($user_id, $post_id) {
        $stmt = $this->pdo->prepare('SELECT id FROM likes WHERE user_id = ? AND post_id = ?');
        $stmt->execute([$user_id, $post_id]);
        $exists = $stmt->fetch();
        if ($exists) {
            $del = $this->pdo->prepare('DELETE FROM likes WHERE id = ?');
            return $del->execute([$exists['id']]);
        } else {
            $ins = $this->pdo->prepare('INSERT INTO likes (user_id, post_id) VALUES (?, ?)');
            return $ins->execute([$user_id, $post_id]);
        }
    }
}
