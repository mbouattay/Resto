<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221126164721 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE clinet (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(30) NOT NULL, nom VARCHAR(30) NOT NULL, prenom VARCHAR(30) NOT NULL, password VARCHAR(50) NOT NULL, tel VARCHAR(8) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commenter (id INT AUTO_INCREMENT NOT NULL, resto_id INT NOT NULL, description VARCHAR(200) NOT NULL, INDEX IDX_AB751D0A2978E8D1 (resto_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, resto_id INT NOT NULL, name VARCHAR(20) NOT NULL, prix DOUBLE PRECISION NOT NULL, INDEX IDX_7D053A932978E8D1 (resto_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, clinet_id INT NOT NULL, resto_id INT NOT NULL, date DATE NOT NULL, etat VARCHAR(10) NOT NULL, INDEX IDX_42C849554FCA8F3 (clinet_id), INDEX IDX_42C849552978E8D1 (resto_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE resto (id INT AUTO_INCREMENT NOT NULL, reservation_id INT NOT NULL, restorateur_id INT NOT NULL, nom VARCHAR(30) NOT NULL, adresse VARCHAR(35) NOT NULL, tel VARCHAR(8) NOT NULL, fax VARCHAR(8) NOT NULL, ville VARCHAR(20) NOT NULL, INDEX IDX_892155B1B83297E7 (reservation_id), INDEX IDX_892155B11FAB70C7 (restorateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restorateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(30) NOT NULL, prenom VARCHAR(30) NOT NULL, username VARCHAR(30) NOT NULL, password VARCHAR(50) NOT NULL, code_tva INT NOT NULL, cin INT NOT NULL, adresse VARCHAR(50) NOT NULL, tel INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commenter ADD CONSTRAINT FK_AB751D0A2978E8D1 FOREIGN KEY (resto_id) REFERENCES resto (id)');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A932978E8D1 FOREIGN KEY (resto_id) REFERENCES resto (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849554FCA8F3 FOREIGN KEY (clinet_id) REFERENCES clinet (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849552978E8D1 FOREIGN KEY (resto_id) REFERENCES resto (id)');
        $this->addSql('ALTER TABLE resto ADD CONSTRAINT FK_892155B1B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('ALTER TABLE resto ADD CONSTRAINT FK_892155B11FAB70C7 FOREIGN KEY (restorateur_id) REFERENCES restorateur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commenter DROP FOREIGN KEY FK_AB751D0A2978E8D1');
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A932978E8D1');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849554FCA8F3');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849552978E8D1');
        $this->addSql('ALTER TABLE resto DROP FOREIGN KEY FK_892155B1B83297E7');
        $this->addSql('ALTER TABLE resto DROP FOREIGN KEY FK_892155B11FAB70C7');
        $this->addSql('DROP TABLE clinet');
        $this->addSql('DROP TABLE commenter');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE resto');
        $this->addSql('DROP TABLE restorateur');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
