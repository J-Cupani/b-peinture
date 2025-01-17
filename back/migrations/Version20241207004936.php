<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241207004936 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cxtv_project (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, tag VARCHAR(255) DEFAULT NULL, image_name VARCHAR(255) DEFAULT NULL, token VARCHAR(15) NOT NULL, active TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cxtv_user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, date_creation DATETIME NOT NULL, reset_password_token VARCHAR(25) DEFAULT NULL, date_request_reset_password DATETIME DEFAULT NULL, need_to_reset_password TINYINT(1) NOT NULL, image_name VARCHAR(255) DEFAULT NULL, anonymous TINYINT(1) DEFAULT NULL, token VARCHAR(15) NOT NULL, active TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_2F9A6841E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE cxtv_project');
        $this->addSql('DROP TABLE cxtv_user');
    }
}
