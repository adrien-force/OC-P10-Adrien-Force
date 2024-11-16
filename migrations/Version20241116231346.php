<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241116231346 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project DROP CONSTRAINT fk_2fb3d0ee6bf700bd');
        $this->addSql('DROP INDEX idx_2fb3d0ee6bf700bd');
        $this->addSql('ALTER TABLE project DROP status_id');
        $this->addSql('ALTER TABLE "user" ALTER contract_type TYPE VARCHAR(255)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "user" ALTER contract_type TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE project ADD status_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT fk_2fb3d0ee6bf700bd FOREIGN KEY (status_id) REFERENCES status (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_2fb3d0ee6bf700bd ON project (status_id)');
    }
}
