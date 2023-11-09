<?php

require_once __DIR__ . '/db.php';
class Shorter {
    private string $baseUrl = BASE_URL;
    private mixed $user;
    private DB $db;

    public function __construct($user = null) {
        $this->user = $user;
        $this->db = new DB();
    }

    /**
     * @throws Exception
     */
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
    /** 
     * public function disableUrl($shortUrl) {
     *  $this->db->query("UPDATE urls SET disabled = 1 WHERE short_url = '$shortUrl'");
     * }

     * public function deleteUrl($shortUrl) {
     *  $this->db->query("DELETE FROM urls WHERE short_url = '$shortUrl'");
     * }

     * public function getClicCount($shortUrl) {
         * $result = $this->db->query("SELECT clic_count FROM urls WHERE short_url = '$shortUrl'");
         * $row = $result->fetch_assoc();
         * return $row ? $row['clic_count'] : 0;
     * }
    
     * public function storeFile($uploadedFile, $longUrl) {
         * $fileName = md5(uniqid()) . '_' . basename($uploadedFile['name']);
         * $uploadPath = __DIR__ . '/../uploads/' . $fileName;

         * if (move_uploaded_file($uploadedFile['tmp_name'], $uploadPath)) {
             * $this->db->query("INSERT INTO files (user_id, file_name, long_url) VALUES ({$this->user['id']}, '$fileName', '$longUrl')");
         * }

         * return $fileName;
     * }
    
    */
}
