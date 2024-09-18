<?php

require_once "../app/Core/DBConnect.php";

class projectModel {
    private $db;

    public function __construct() {
        $this->db = new DBConnect(); // Iegūstam PDO savienojumu
    }

    // Funkcija, lai iegūtu lietotāja monētu skaitu pēc ID
    public function getCoins($userId) {
        // Izmantojam $this->db->dbconn, lai piekļūtu PDO metodēm
        $stmt = $this->db->dbconn->prepare("SELECT coins FROM Users WHERE UserID = :userId");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['coins'] ?? 0; // Ja nav monētu, atgriež 0
    }

    // Funkcija, lai atjauninātu lietotāja monētu skaitu
    public function updateCoins($userId, $coins) {
        // Izmantojam $this->db->dbconn, lai piekļūtu PDO metodēm
        $stmt = $this->db->dbconn->prepare("UPDATE Users SET coins = :coins WHERE UserID = :userId");
        $stmt->bindParam(':coins', $coins, PDO::PARAM_INT);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
    }

    // Funkcija, lai atjauninātu lietotāja skaņas iestatījumu
    public function updateSound($userId, $sound) {
        $stmt = $this->db->dbconn->prepare("UPDATE Users SET sound = :sound WHERE UserID = :userId");
        $stmt->bindParam(':sound', $sound, PDO::PARAM_STR);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
    }

    // Funkcija, lai iegūtu lietotāja skaņas iestatījumu
    public function getSound($userId) {
        $stmt = $this->db->dbconn->prepare("SELECT sound FROM Users WHERE UserID = :userId");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
}

?>