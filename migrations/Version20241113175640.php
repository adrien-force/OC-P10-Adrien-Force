<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241113175640 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "user" ADD user_type VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" DROP role');
        $this->addSql('ALTER TABLE "user" ALTER contract_type TYPE VARCHAR(255)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "user" ADD role VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE "user" DROP user_type');
        $this->addSql('ALTER TABLE "user" ALTER contract_type TYPE VARCHAR(255)');
    }
}
