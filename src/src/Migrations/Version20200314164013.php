<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200314164013 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ip_case (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', ip_number VARCHAR(255) NOT NULL, territory_code VARCHAR(2) NOT NULL, case_reference VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subject (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', ip_case_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', data JSON DEFAULT NULL, INDEX IDX_FBCE3E7AE0A16EF8 (ip_case_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE subject ADD CONSTRAINT FK_FBCE3E7AE0A16EF8 FOREIGN KEY (ip_case_id) REFERENCES ip_case (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE subject DROP FOREIGN KEY FK_FBCE3E7AE0A16EF8');
        $this->addSql('DROP TABLE ip_case');
        $this->addSql('DROP TABLE subject');
    }
}
