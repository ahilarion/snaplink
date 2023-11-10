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
        $shortUrl = $this->baseUrl . 'r/' . bin2hex($urlHash);
        $this->db->query("INSERT INTO urls (user_id, long_url, short_url) VALUES ({$this->user['id']}, '$longUrl', '$shortUrl')");

        return $shortUrl;
    }

    /**
     * @throws Exception
     */
    public function redirect($shortUrl): void
    {
        $currentUrl = $this->db->query("SELECT * FROM urls WHERE short_url = '$shortUrl'");
        $currentUrl = $currentUrl->fetch_assoc();

        if (!$currentUrl) {
            throw new Exception('URL not found');
        }

        if ($currentUrl['disabled']) {
            throw new Exception('URL disabled');
        }

        if ($currentUrl['link_type'] === 'file') {
            $fileName = $currentUrl['file_name'];
            $filePath = __DIR__ . '/../uploads/' . $fileName;
            $this->click($shortUrl);
            header('Content-Type: application/octet-stream');
            header('Content-Transfer-Encoding: Binary');
            header('Content-disposition: attachment; filename="' . $currentUrl['display_name'] . '"');
            readfile($filePath);
            exit();
        }

        $this->click($shortUrl);

        header('Location: ' . $currentUrl['long_url']);
        exit();
    }

    public function getUrls(): mysqli_result|bool|null
    {
        if (!$this->user) {
            return false;
        }
        return $this->db->query("SELECT * FROM urls WHERE user_id = {$this->user['id']}");
    }

    /**
     * @throws Exception
     */
    public function storeFile($uploadedFile): void
    {
        $displayName = htmlspecialchars($uploadedFile['name']);
        $fileName = md5(uniqid()) . '.' . pathinfo($uploadedFile['name'], PATHINFO_EXTENSION);

        if (!file_exists(__DIR__ . '/../uploads/')) {
            mkdir(__DIR__ . '/../uploads/');
        }

        $uploadPath = __DIR__ . '/../uploads/' . $fileName;

        $urlHash = random_bytes(4);
        $shortUrl = $this->baseUrl . 'r/' . bin2hex($urlHash);

        if (move_uploaded_file($uploadedFile['tmp_name'], $uploadPath)) {
            $this->db->query("INSERT INTO urls (user_id, short_url, link_type, file_name, display_name) VALUES ({$this->user['id']}, '$shortUrl', 'file', '$fileName', '$displayName')");
        }
    }

    public function getFiles(): mysqli_result|bool|null
    {
        if (!$this->user) {
            return false;
        }
        return false;
    }

    private function click($shortUrl): int
    {
        $this->db->query("UPDATE urls SET click_count = click_count + 1 WHERE short_url = '$shortUrl'");
    
        $result = $this->db->query("SELECT click_count FROM urls WHERE short_url = '$shortUrl'");
        $row = $result->fetch_assoc();
    
        return $row ? $row['click_count'] : 0;
    }   

    public function deleteUrl($url_id): void
    {
        $currentUrl = $this->db->query("SELECT * FROM urls WHERE id = '$url_id'");
        $currentUrl = $currentUrl->fetch_assoc();
        if ($currentUrl && $currentUrl['user_id'] === $this->user['id']) {
            if ($currentUrl['link_type'] === 'file') {
                $fileName = $currentUrl['file_name'];
                $filePath = __DIR__ . '/../uploads/' . $fileName;
                unlink($filePath);
            }
            $this->db->query("DELETE FROM urls WHERE id = '$url_id'");
        }
    }

    public function disableUrl($url_id): void
    {
        $author_id = $this->db->query("SELECT user_id FROM urls WHERE id = '$url_id'");
        $author_id = $author_id->fetch_assoc();
        if ($author_id && $author_id['user_id'] === $this->user['id']) {
            $this->db->query("UPDATE urls SET disabled = 1 WHERE id = '$url_id'");
        }
    }

    public function enableUrl($url_id): void
    {
        $author_id = $this->db->query("SELECT user_id FROM urls WHERE id = '$url_id'");
        $author_id = $author_id->fetch_assoc();
        if ($author_id && $author_id['user_id'] === $this->user['id']) {
            $this->db->query("UPDATE urls SET disabled = 0 WHERE id = '$url_id'");
        }
    }
}
