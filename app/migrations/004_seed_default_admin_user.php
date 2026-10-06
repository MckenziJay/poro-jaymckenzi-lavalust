<?php

class Seed_default_admin_user {

    private $_lava;

    public function __construct()
    {
        $this->_lava = lava_instance();
    }

    public function up()
    {
        $this->_lava->call->database();

        $host = getenv('DB_HOST') ?: 'localhost';
        $port = getenv('DB_PORT') ?: '3306';
        $user = getenv('DB_USERNAME') ?: getenv('DB_USER') ?: 'root';
        $pass = getenv('DB_PASSWORD') ?: '';
        $dbname = getenv('DB_NAME') ?: getenv('DB_DATABASE') ?: 'lavalust';

        $pdo = new PDO("mysql:host={$host};dbname={$dbname};port={$port};charset=utf8mb4", $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);

        $columns = $pdo->query('SHOW COLUMNS FROM users')->fetchAll(PDO::FETCH_COLUMN);

        if (!in_array('password', $columns, true)) {
            $pdo->exec('ALTER TABLE users ADD COLUMN password VARCHAR(255) NULL AFTER username');
        }
        if (!in_array('role', $columns, true)) {
            $pdo->exec('ALTER TABLE users ADD COLUMN role ENUM("admin","user") NOT NULL DEFAULT "user" AFTER password');
        }
        if (!in_array('is_active', $columns, true)) {
            $pdo->exec('ALTER TABLE users ADD COLUMN is_active TINYINT(1) NOT NULL DEFAULT 1 AFTER role');
        }
        if (!in_array('created_at', $columns, true)) {
            $pdo->exec('ALTER TABLE users ADD COLUMN created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER is_active');
        }
        if (!in_array('updated_at', $columns, true)) {
            $pdo->exec('ALTER TABLE users ADD COLUMN updated_at DATETIME NULL DEFAULT NULL AFTER created_at');
        }

        $existing = $pdo->prepare('SELECT id FROM users WHERE username = :username LIMIT 1');
        $existing->execute([':username' => 'admin']);
        if ($existing->fetch()) {
            return;
        }

        $password = password_hash('admin123', PASSWORD_DEFAULT);
        $pdo->prepare('INSERT INTO users (username, email, password, role, is_active, created_at) VALUES (:username, :email, :password, :role, :is_active, NOW())')
            ->execute([
                ':username' => 'admin',
                ':email'    => 'admin@local.test',
                ':password' => $password,
                ':role'     => 'admin',
                ':is_active' => 1,
            ]);
    }

    public function down()
    {
        $host = getenv('DB_HOST') ?: 'localhost';
        $port = getenv('DB_PORT') ?: '3306';
        $user = getenv('DB_USERNAME') ?: getenv('DB_USER') ?: 'root';
        $pass = getenv('DB_PASSWORD') ?: '';
        $dbname = getenv('DB_NAME') ?: getenv('DB_DATABASE') ?: 'lavalust';
        $pdo = new PDO("mysql:host={$host};dbname={$dbname};port={$port};charset=utf8mb4", $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
        $pdo->prepare('DELETE FROM users WHERE username = :username')->execute([':username' => 'admin']);
    }
}
