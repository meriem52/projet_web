<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240506150733 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chambres (id INT AUTO_INCREMENT NOT NULL, reservations_id INT DEFAULT NULL, numero SMALLINT NOT NULL, type VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, capacite SMALLINT NOT NULL, description VARCHAR(255) NOT NULL, image LONGBLOB NOT NULL, statut TINYINT(1) NOT NULL, INDEX IDX_36C92962D9A7F869 (reservations_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clients (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE factures (id INT AUTO_INCREMENT NOT NULL, reservation_id_id INT DEFAULT NULL, date_facturation DATE NOT NULL, statut_paiement VARCHAR(255) NOT NULL, mode_paiement VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_647590B3C3B4EF0 (reservation_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservations (id INT AUTO_INCREMENT NOT NULL, client_id_id INT NOT NULL, date_arrivee DATE NOT NULL, date_depart DATE NOT NULL, nombre_nuits SMALLINT NOT NULL, prix_total NUMERIC(10, 0) NOT NULL, statut TINYINT(1) NOT NULL, INDEX IDX_4DA239DC2902E0 (client_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservations_services (reservations_id INT NOT NULL, services_id INT NOT NULL, INDEX IDX_12D426C8D9A7F869 (reservations_id), INDEX IDX_12D426C8AEF5A6C1 (services_id), PRIMARY KEY(reservations_id, services_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE services (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, prix DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE services_reservations (services_id INT NOT NULL, reservations_id INT NOT NULL, INDEX IDX_6D3893E7AEF5A6C1 (services_id), INDEX IDX_6D3893E7D9A7F869 (reservations_id), PRIMARY KEY(services_id, reservations_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE chambres ADD CONSTRAINT FK_36C92962D9A7F869 FOREIGN KEY (reservations_id) REFERENCES reservations (id)');
        $this->addSql('ALTER TABLE factures ADD CONSTRAINT FK_647590B3C3B4EF0 FOREIGN KEY (reservation_id_id) REFERENCES reservations (id)');
        $this->addSql('ALTER TABLE reservations ADD CONSTRAINT FK_4DA239DC2902E0 FOREIGN KEY (client_id_id) REFERENCES clients (id)');
        $this->addSql('ALTER TABLE reservations_services ADD CONSTRAINT FK_12D426C8D9A7F869 FOREIGN KEY (reservations_id) REFERENCES reservations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservations_services ADD CONSTRAINT FK_12D426C8AEF5A6C1 FOREIGN KEY (services_id) REFERENCES services (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE services_reservations ADD CONSTRAINT FK_6D3893E7AEF5A6C1 FOREIGN KEY (services_id) REFERENCES services (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE services_reservations ADD CONSTRAINT FK_6D3893E7D9A7F869 FOREIGN KEY (reservations_id) REFERENCES reservations (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chambres DROP FOREIGN KEY FK_36C92962D9A7F869');
        $this->addSql('ALTER TABLE factures DROP FOREIGN KEY FK_647590B3C3B4EF0');
        $this->addSql('ALTER TABLE reservations DROP FOREIGN KEY FK_4DA239DC2902E0');
        $this->addSql('ALTER TABLE reservations_services DROP FOREIGN KEY FK_12D426C8D9A7F869');
        $this->addSql('ALTER TABLE reservations_services DROP FOREIGN KEY FK_12D426C8AEF5A6C1');
        $this->addSql('ALTER TABLE services_reservations DROP FOREIGN KEY FK_6D3893E7AEF5A6C1');
        $this->addSql('ALTER TABLE services_reservations DROP FOREIGN KEY FK_6D3893E7D9A7F869');
        $this->addSql('DROP TABLE chambres');
        $this->addSql('DROP TABLE clients');
        $this->addSql('DROP TABLE factures');
        $this->addSql('DROP TABLE reservations');
        $this->addSql('DROP TABLE reservations_services');
        $this->addSql('DROP TABLE services');
        $this->addSql('DROP TABLE services_reservations');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
