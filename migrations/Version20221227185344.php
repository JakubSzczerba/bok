<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221227185344 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE information (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, application_id INT DEFAULT NULL, content VARCHAR(255) NOT NULL, INDEX IDX_29791883A76ED395 (user_id), UNIQUE INDEX UNIQ_297918833E030ACD (application_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE information ADD CONSTRAINT FK_29791883A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE information ADD CONSTRAINT FK_297918833E030ACD FOREIGN KEY (application_id) REFERENCES application (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE information DROP FOREIGN KEY FK_29791883A76ED395');
        $this->addSql('ALTER TABLE information DROP FOREIGN KEY FK_297918833E030ACD');
        $this->addSql('DROP TABLE information');
    }
}
