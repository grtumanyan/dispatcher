<?php declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191020180300 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE company CHANGE id id VARCHAR(255) NOT NULL, CHANGE address address VARCHAR(255) DEFAULT NULL, CHANGE name name VARCHAR(255) DEFAULT NULL, CHANGE phone phone VARCHAR(255) DEFAULT NULL, CHANGE token token VARCHAR(255) DEFAULT NULL');
        }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE company CHANGE id id VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE name name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE token token VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE phone phone VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE address address VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        }
}
