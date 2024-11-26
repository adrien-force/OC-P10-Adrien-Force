<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241126232709 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "user" ALTER contract_type TYPE VARCHAR(255)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('ALTER TABLE user_project DROP CONSTRAINT FK_77BECEE4A76ED395');
        $this->addSql('ALTER TABLE user_project ADD CONSTRAINT FK_77BECEE4A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql("ALTER TABLE task ALTER COLUMN project_id DROP NOT NULL");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74');
        $this->addSql('ALTER TABLE "user" ALTER contract_type TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE user_project DROP CONSTRAINT fk_77becee4a76ed395');
        $this->addSql('ALTER TABLE user_project ADD CONSTRAINT fk_77becee4a76ed395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE task ALTER project_id SET NOT NULL');

    }
}
