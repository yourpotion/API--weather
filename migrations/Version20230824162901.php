<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230824162901 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE airplane (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, number VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE discount (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE flight (id INT AUTO_INCREMENT NOT NULL, departure VARCHAR(255) NOT NULL, arrival VARCHAR(255) NOT NULL, how_many_tickets INT NOT NULL, date_of_departure DATE NOT NULL, date_of_arrival DATE NOT NULL, time_of_departure TIME NOT NULL, time_of_arrival TIME NOT NULL, price VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE option_lunch_and_luggage (id INT AUTO_INCREMENT NOT NULL, passenger_id INT DEFAULT NULL, flight_id INT DEFAULT NULL, luggage TINYINT(1) NOT NULL, lunch TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_2F8469E74502E565 (passenger_id), UNIQUE INDEX UNIQ_2F8469E791F478C5 (flight_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE passenger (id INT AUTO_INCREMENT NOT NULL, seat_type_id INT DEFAULT NULL, roles JSON NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(180) NOT NULL, phone_number VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_3BEFE8DDE7927C74 (email), UNIQUE INDEX UNIQ_3BEFE8DD4ECEE001 (seat_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seat_type (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket (id INT AUTO_INCREMENT NOT NULL, flight_id INT DEFAULT NULL, passenger_id INT DEFAULT NULL, INDEX IDX_97A0ADA391F478C5 (flight_id), INDEX IDX_97A0ADA34502E565 (passenger_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE option_lunch_and_luggage ADD CONSTRAINT FK_2F8469E74502E565 FOREIGN KEY (passenger_id) REFERENCES passenger (id)');
        $this->addSql('ALTER TABLE option_lunch_and_luggage ADD CONSTRAINT FK_2F8469E791F478C5 FOREIGN KEY (flight_id) REFERENCES flight (id)');
        $this->addSql('ALTER TABLE passenger ADD CONSTRAINT FK_3BEFE8DD4ECEE001 FOREIGN KEY (seat_type_id) REFERENCES seat_type (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA391F478C5 FOREIGN KEY (flight_id) REFERENCES flight (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA34502E565 FOREIGN KEY (passenger_id) REFERENCES passenger (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE option_lunch_and_luggage DROP FOREIGN KEY FK_2F8469E74502E565');
        $this->addSql('ALTER TABLE option_lunch_and_luggage DROP FOREIGN KEY FK_2F8469E791F478C5');
        $this->addSql('ALTER TABLE passenger DROP FOREIGN KEY FK_3BEFE8DD4ECEE001');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA391F478C5');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA34502E565');
        $this->addSql('DROP TABLE airplane');
        $this->addSql('DROP TABLE discount');
        $this->addSql('DROP TABLE flight');
        $this->addSql('DROP TABLE option_lunch_and_luggage');
        $this->addSql('DROP TABLE passenger');
        $this->addSql('DROP TABLE seat_type');
        $this->addSql('DROP TABLE ticket');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
