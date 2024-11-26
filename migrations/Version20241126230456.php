<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241126230456 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE timeslot_id_seq CASCADE');
        $this->addSql('ALTER TABLE timeslot DROP CONSTRAINT fk_3be452f78db60186');
        $this->addSql('DROP TABLE timeslot');
        $this->addSql('ALTER TABLE task ALTER project_id SET NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER contract_type TYPE VARCHAR(255)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE timeslot_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE timeslot (id INT NOT NULL, task_id INT NOT NULL, start TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, stop_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_3be452f78db60186 ON timeslot (task_id)');
        $this->addSql('ALTER TABLE timeslot ADD CONSTRAINT fk_3be452f78db60186 FOREIGN KEY (task_id) REFERENCES task (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ALTER contract_type TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE task ALTER project_id DROP NOT NULL');
    }
}
