<?php

use app\core\Application;
use app\core\Migration;

class m00001_initial extends Migration
{
    public function up()
    {
        $db = Application::$app->db;
        $db->pdo->exec('CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(512) NOT NULL,
            status TINYINT NOT NULL DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;');
    }

    public function down()
    {
        $db = Application::$app->db;
        $db->pdo->exec('DROP TABLE users;');
    }
}
