<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201206140758 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE infected_person (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, street VARCHAR(255) NOT NULL, streetnumber VARCHAR(255) NOT NULL, zip VARCHAR(5) NOT NULL, city VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, modified_at DATETIME DEFAULT NULL, quarantine_start DATE NOT NULL, quarantine_end DATE DEFAULT NULL, positive_test TINYINT(1) NOT NULL, in_quarantine TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE infected');
        $this->addSql('ALTER TABLE contact_person ADD infected_person_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contact_person ADD CONSTRAINT FK_A44EE6F741B9F0D FOREIGN KEY (infected_person_id) REFERENCES infected_person (id)');
        $this->addSql('CREATE INDEX IDX_A44EE6F741B9F0D ON contact_person (infected_person_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact_person DROP FOREIGN KEY FK_A44EE6F741B9F0D');
        $this->addSql('CREATE TABLE infected (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, lastname VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, street VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, streetnumber VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, zip VARCHAR(5) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, city VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME DEFAULT NULL, modified_at DATETIME DEFAULT NULL, quarantine_start DATE NOT NULL, quarantine_end DATE DEFAULT NULL, positive_test TINYINT(1) NOT NULL, in_quarantine TINYINT(1) NOT NULL, phone VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE infected_person');
        $this->addSql('DROP INDEX IDX_A44EE6F741B9F0D ON contact_person');
        $this->addSql('ALTER TABLE contact_person DROP infected_person_id');
    }
}
