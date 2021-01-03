<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210103221931 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gift (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', code VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, price VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_A47C990DD17F50A6 (uuid), INDEX gift_code_idx (code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE receiver (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, country_code VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_3DB88C96D17F50A6 (uuid), INDEX receiver_uuid_idx (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE receiver_gift (receiver_id INT NOT NULL, gift_id INT NOT NULL, INDEX IDX_A135D533CD53EDB6 (receiver_id), INDEX IDX_A135D53397A95A83 (gift_id), PRIMARY KEY(receiver_id, gift_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE receiver_gift ADD CONSTRAINT FK_A135D533CD53EDB6 FOREIGN KEY (receiver_id) REFERENCES receiver (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE receiver_gift ADD CONSTRAINT FK_A135D53397A95A83 FOREIGN KEY (gift_id) REFERENCES gift (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE receiver_gift DROP FOREIGN KEY FK_A135D53397A95A83');
        $this->addSql('ALTER TABLE receiver_gift DROP FOREIGN KEY FK_A135D533CD53EDB6');
        $this->addSql('DROP TABLE gift');
        $this->addSql('DROP TABLE receiver');
        $this->addSql('DROP TABLE receiver_gift');
    }
}
