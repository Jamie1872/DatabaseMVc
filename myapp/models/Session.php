<?php
require_once __DIR__ . '/../config/database.php';

class Session
{
    public static function all()
    {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM Sessions");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM Sessions WHERE session_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data)
    {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO Sessions (session_type, session_date, session_time, address, team1_id, team2_id, team1_score, team2_score)
                              VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['session_type'], $data['session_date'], $data['session_time'], $data['address'],
            $data['team1_id'], $data['team2_id'],
            $data['team1_score'] ?: null, $data['team2_score'] ?: null
        ]);
    }

    public static function update($id, $data)
    {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE Sessions SET 
            session_type = ?, session_date = ?, session_time = ?, address = ?, 
            team1_id = ?, team2_id = ?, team1_score = ?, team2_score = ?
            WHERE session_id = ?");
        $stmt->execute([
            $data['session_type'], $data['session_date'], $data['session_time'], $data['address'],
            $data['team1_id'], $data['team2_id'],
            $data['team1_score'] ?: null, $data['team2_score'] ?: null,
            $id
        ]);
    }

    public static function delete($id)
    {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM Sessions WHERE session_id = ?");
        $stmt->execute([$id]);
    }
}
