<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180312170528 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE blade (id INT AUTO_INCREMENT NOT NULL, element_id INT DEFAULT NULL, weapon_id INT DEFAULT NULL, driver_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, rareness SMALLINT NOT NULL, class VARCHAR(3) NOT NULL, gender VARCHAR(1) NOT NULL, strength SMALLINT NOT NULL, trust_level SMALLINT NOT NULL, INDEX IDX_217C01E81F1F2A24 (element_id), INDEX IDX_217C01E895B82273 (weapon_id), INDEX IDX_217C01E8C3423909 (driver_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE driver (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE element (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, color VARCHAR(7) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill_level (id INT AUTO_INCREMENT NOT NULL, blade_id INT DEFAULT NULL, skill_id INT DEFAULT NULL, level SMALLINT NOT NULL, INDEX IDX_BFC25F2F8118485F (blade_id), INDEX IDX_BFC25F2F5585C142 (skill_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE weapon (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE weapon_level (id INT AUTO_INCREMENT NOT NULL, driver_id INT DEFAULT NULL, weapon_id INT DEFAULT NULL, y SMALLINT NOT NULL, x SMALLINT NOT NULL, b SMALLINT NOT NULL, chain SMALLINT NOT NULL, INDEX IDX_B7503C76C3423909 (driver_id), INDEX IDX_B7503C7695B82273 (weapon_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE blade ADD CONSTRAINT FK_217C01E81F1F2A24 FOREIGN KEY (element_id) REFERENCES element (id)');
        $this->addSql('ALTER TABLE blade ADD CONSTRAINT FK_217C01E895B82273 FOREIGN KEY (weapon_id) REFERENCES weapon (id)');
        $this->addSql('ALTER TABLE blade ADD CONSTRAINT FK_217C01E8C3423909 FOREIGN KEY (driver_id) REFERENCES driver (id)');
        $this->addSql('ALTER TABLE skill_level ADD CONSTRAINT FK_BFC25F2F8118485F FOREIGN KEY (blade_id) REFERENCES blade (id)');
        $this->addSql('ALTER TABLE skill_level ADD CONSTRAINT FK_BFC25F2F5585C142 FOREIGN KEY (skill_id) REFERENCES skill (id)');
        $this->addSql('ALTER TABLE weapon_level ADD CONSTRAINT FK_B7503C76C3423909 FOREIGN KEY (driver_id) REFERENCES driver (id)');
        $this->addSql('ALTER TABLE weapon_level ADD CONSTRAINT FK_B7503C7695B82273 FOREIGN KEY (weapon_id) REFERENCES weapon (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE skill_level DROP FOREIGN KEY FK_BFC25F2F8118485F');
        $this->addSql('ALTER TABLE blade DROP FOREIGN KEY FK_217C01E8C3423909');
        $this->addSql('ALTER TABLE weapon_level DROP FOREIGN KEY FK_B7503C76C3423909');
        $this->addSql('ALTER TABLE blade DROP FOREIGN KEY FK_217C01E81F1F2A24');
        $this->addSql('ALTER TABLE skill_level DROP FOREIGN KEY FK_BFC25F2F5585C142');
        $this->addSql('ALTER TABLE blade DROP FOREIGN KEY FK_217C01E895B82273');
        $this->addSql('ALTER TABLE weapon_level DROP FOREIGN KEY FK_B7503C7695B82273');
        $this->addSql('DROP TABLE blade');
        $this->addSql('DROP TABLE driver');
        $this->addSql('DROP TABLE element');
        $this->addSql('DROP TABLE skill');
        $this->addSql('DROP TABLE skill_level');
        $this->addSql('DROP TABLE weapon');
        $this->addSql('DROP TABLE weapon_level');
    }
}
