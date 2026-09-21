<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260921172348 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dish (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE dish_menu (dish_id INT NOT NULL, menu_id INT NOT NULL, INDEX IDX_F7078582148EB0CB (dish_id), INDEX IDX_F7078582CCD7E912 (menu_id), PRIMARY KEY (dish_id, menu_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE dish_menu ADD CONSTRAINT FK_F7078582148EB0CB FOREIGN KEY (dish_id) REFERENCES dish (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dish_menu ADD CONSTRAINT FK_F7078582CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dish_menu DROP FOREIGN KEY FK_F7078582148EB0CB');
        $this->addSql('ALTER TABLE dish_menu DROP FOREIGN KEY FK_F7078582CCD7E912');
        $this->addSql('DROP TABLE dish');
        $this->addSql('DROP TABLE dish_menu');
    }
}
