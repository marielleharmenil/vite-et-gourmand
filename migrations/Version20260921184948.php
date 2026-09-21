<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260921184948 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE allergen (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_25BF08CE5E237E06 (name), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE allergen_dish (allergen_id INT NOT NULL, dish_id INT NOT NULL, INDEX IDX_7D38EB3C6E775A4A (allergen_id), INDEX IDX_7D38EB3C148EB0CB (dish_id), PRIMARY KEY (allergen_id, dish_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE allergen_dish ADD CONSTRAINT FK_7D38EB3C6E775A4A FOREIGN KEY (allergen_id) REFERENCES allergen (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE allergen_dish ADD CONSTRAINT FK_7D38EB3C148EB0CB FOREIGN KEY (dish_id) REFERENCES dish (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE allergen_dish DROP FOREIGN KEY FK_7D38EB3C6E775A4A');
        $this->addSql('ALTER TABLE allergen_dish DROP FOREIGN KEY FK_7D38EB3C148EB0CB');
        $this->addSql('DROP TABLE allergen');
        $this->addSql('DROP TABLE allergen_dish');
    }
}
