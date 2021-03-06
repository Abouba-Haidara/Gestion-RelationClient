<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200514015700 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE department DROP FOREIGN KEY FK_CD1DE18A8520A30B');
        $this->addSql('DROP INDEX IDX_CD1DE18A8520A30B ON department');
        $this->addSql('ALTER TABLE department DROP employees_id');
        $this->addSql('ALTER TABLE employee ADD department_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE employee ADD CONSTRAINT FK_5D9F75A1AE80F5DF FOREIGN KEY (department_id) REFERENCES department (id)');
        $this->addSql('CREATE INDEX IDX_5D9F75A1AE80F5DF ON employee (department_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE department ADD employees_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE department ADD CONSTRAINT FK_CD1DE18A8520A30B FOREIGN KEY (employees_id) REFERENCES employee (id)');
        $this->addSql('CREATE INDEX IDX_CD1DE18A8520A30B ON department (employees_id)');
        $this->addSql('ALTER TABLE employee DROP FOREIGN KEY FK_5D9F75A1AE80F5DF');
        $this->addSql('DROP INDEX IDX_5D9F75A1AE80F5DF ON employee');
        $this->addSql('ALTER TABLE employee DROP department_id');
    }
}
