<?php

class Follow {
    private $pdo;
    public function __construct($pdo) { $this->pdo = $pdo; }

    public function toggle($follower_id, $following_id) {
        if ($follower_id == $following_id) return false;
        $stmt = $this->pdo->prepare('SELECT id FROM follows WHERE follower_id = ? AND following_id = ?');
        $stmt->execute([$follower_id, $following_id]);
        $exists = $stmt->fetch();
        if ($exists) {
            $del = $this->pdo->prepare('DELETE FROM follows WHERE id = ?');
            return $del->execute([$exists['id']]);
        } else {
            $ins = $this->pdo->prepare('INSERT INTO follows (follower_id, following_id) VALUES (?, ?)');
            return $ins->execute([$follower_id, $following_id]);
        }
    }

    public function isFollowing($follower_id, $following_id) {
        $stmt = $this->pdo->prepare('SELECT 1 FROM follows WHERE follower_id = ? AND following_id = ?');
        $stmt->execute([$follower_id, $following_id]);
        return (bool) $stmt->fetch();
    }
}
