<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210506104426 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE garbage_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE geo_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE report_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE wish_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE garbage (id INT NOT NULL, geo_id INT DEFAULT NULL, code VARCHAR(255) NOT NULL, is_active BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5C99346DFA49D0B ON garbage (geo_id)');
        $this->addSql('CREATE TABLE geo (id INT NOT NULL, localisation VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE report (id INT NOT NULL, garbage_id INT DEFAULT NULL, is_full BOOLEAN DEFAULT NULL, is_damaged BOOLEAN DEFAULT NULL, is_here BOOLEAN DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C42F778414B74508 ON report (garbage_id)');
        $this->addSql('CREATE TABLE wish (id INT NOT NULL, geo_id INT NOT NULL, code VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D7D174C9FA49D0B ON wish (geo_id)');
        $this->addSql('ALTER TABLE garbage ADD CONSTRAINT FK_5C99346DFA49D0B FOREIGN KEY (geo_id) REFERENCES geo (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F778414B74508 FOREIGN KEY (garbage_id) REFERENCES garbage (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE wish ADD CONSTRAINT FK_D7D174C9FA49D0B FOREIGN KEY (geo_id) REFERENCES geo (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE report DROP CONSTRAINT FK_C42F778414B74508');
        $this->addSql('ALTER TABLE garbage DROP CONSTRAINT FK_5C99346DFA49D0B');
        $this->addSql('ALTER TABLE wish DROP CONSTRAINT FK_D7D174C9FA49D0B');
        $this->addSql('DROP SEQUENCE garbage_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE geo_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE report_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE wish_id_seq CASCADE');
        $this->addSql('DROP TABLE garbage');
        $this->addSql('DROP TABLE geo');
        $this->addSql('DROP TABLE report');
        $this->addSql('DROP TABLE wish');
    }
}
