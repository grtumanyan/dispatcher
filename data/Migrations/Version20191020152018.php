<?php declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191020152018 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE company ADD name VARCHAR(255) NOT NULL, ADD token VARCHAR(255) NOT NULL, ADD phone VARCHAR(255) NOT NULL, ADD address VARCHAR(255) NOT NULL, DROP email, DROP full_name, CHANGE id id VARCHAR(255) NOT NULL');
        }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE company ADD email VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, ADD full_name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, DROP name, DROP token, DROP phone, DROP address, CHANGE id id VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
    }
}
