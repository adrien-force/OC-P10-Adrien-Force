<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241112210045 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE employe_id_seq CASCADE');
        $this->addSql('ALTER TABLE employe_project DROP CONSTRAINT fk_ebbcbc4d1b65292');
        $this->addSql('ALTER TABLE employe_project DROP CONSTRAINT fk_ebbcbc4d166d1f9c');
        $this->addSql('DROP TABLE employe_project');
        $this->addSql('DROP TABLE employe');
        $this->addSql('ALTER TABLE "user" ALTER role TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE "user" ALTER contract_type TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE "user" ALTER contract_type DROP NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER arrival_at DROP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE employe_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE employe_project (employe_id INT NOT NULL, project_id INT NOT NULL, PRIMARY KEY(employe_id, project_id))');
        $this->addSql('CREATE INDEX idx_ebbcbc4d166d1f9c ON employe_project (project_id)');
        $this->addSql('CREATE INDEX idx_ebbcbc4d1b65292 ON employe_project (employe_id)');
        $this->addSql('CREATE TABLE employe (id INT NOT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, role INT NOT NULL, contract VARCHAR(255) NOT NULL, arrival_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, active INT NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN employe.arrival_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE employe_project ADD CONSTRAINT fk_ebbcbc4d1b65292 FOREIGN KEY (employe_id) REFERENCES employe (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE employe_project ADD CONSTRAINT fk_ebbcbc4d166d1f9c FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ALTER role TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE "user" ALTER contract_type TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE "user" ALTER contract_type SET NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER arrival_at SET NOT NULL');
    }
}
