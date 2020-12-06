<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201206195141 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE infected_person_contact_person (infected_person_id INT NOT NULL, contact_person_id INT NOT NULL, INDEX IDX_B403B69141B9F0D (infected_person_id), INDEX IDX_B403B6914F8A983C (contact_person_id), PRIMARY KEY(infected_person_id, contact_person_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE infected_person_contact_person ADD CONSTRAINT FK_B403B69141B9F0D FOREIGN KEY (infected_person_id) REFERENCES infected_person (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE infected_person_contact_person ADD CONSTRAINT FK_B403B6914F8A983C FOREIGN KEY (contact_person_id) REFERENCES contact_person (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contact_person DROP FOREIGN KEY FK_A44EE6F741B9F0D');
        $this->addSql('DROP INDEX IDX_A44EE6F741B9F0D ON contact_person');
        $this->addSql('ALTER TABLE contact_person DROP infected_person_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE infected_person_contact_person');
        $this->addSql('ALTER TABLE contact_person ADD infected_person_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contact_person ADD CONSTRAINT FK_A44EE6F741B9F0D FOREIGN KEY (infected_person_id) REFERENCES infected_person (id)');
        $this->addSql('CREATE INDEX IDX_A44EE6F741B9F0D ON contact_person (infected_person_id)');
    }
}
