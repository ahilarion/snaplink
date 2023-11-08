<?php

require_once __DIR__ . '/db.php';
class Shorter {
    private string $baseUrl = BASE_URL;
    private mixed $user;
    private $db;

    public function __construct($user = null) {
        $this->user = $user;
        $this->db = new DB();
    }
    public function shortenUrl($longUrl): string
    {
        if (!$this->user) {
            return 'Not logged in';
        }
        $urlHash = random_bytes(4);
        $shortUrl = $this->baseUrl . bin2hex($urlHash);
        $this->db->query("INSERT INTO urls (user_id, long_url, short_url) VALUES ({$this->user['id']}, '$longUrl', '$shortUrl')");

        return $shortUrl;
    }

    public function redirect($shortUrl): void
    {
        $urlHash = str_replace($this->baseUrl, '', $shortUrl);

        $longUrl = $this->db->query("SELECT long_url FROM urls WHERE short_url = '$shortUrl'");
        $longUrlRow = $longUrl->fetch_assoc();

        if ($longUrlRow && isset($longUrlRow['long_url'])) {
            $longUrl = $longUrlRow['long_url'];
            header("Location: $longUrl");
            exit();
        }
    }


    public function getUrls(): mysqli_result|bool|null
    {
        if (!$this->user) {
            return false;
        }
        return $this->db->query("SELECT * FROM urls WHERE user_id = {$this->user['id']}");
    }
}
