<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260921204648 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE customer_order (id INT AUTO_INCREMENT NOT NULL, people INT NOT NULL, delivery_date DATE NOT NULL, delivery_time TIME NOT NULL, delivery_address VARCHAR(255) NOT NULL, delivery_postal_code VARCHAR(20) NOT NULL, delivery_city VARCHAR(100) NOT NULL, distance_km DOUBLE PRECISION NOT NULL, menu_price DOUBLE PRECISION NOT NULL, discount DOUBLE PRECISION NOT NULL, delivery_fee DOUBLE PRECISION NOT NULL, total_price DOUBLE PRECISION NOT NULL, status VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL, user_id INT NOT NULL, menu_id INT NOT NULL, INDEX IDX_3B1CE6A3A76ED395 (user_id), INDEX IDX_3B1CE6A3CCD7E912 (menu_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE customer_order ADD CONSTRAINT FK_3B1CE6A3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE customer_order ADD CONSTRAINT FK_3B1CE6A3CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer_order DROP FOREIGN KEY FK_3B1CE6A3A76ED395');
        $this->addSql('ALTER TABLE customer_order DROP FOREIGN KEY FK_3B1CE6A3CCD7E912');
        $this->addSql('DROP TABLE customer_order');
    }
}
