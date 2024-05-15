<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240502131629 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE analyse (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE analyse_patient (analyse_id INT NOT NULL, patient_id INT NOT NULL, INDEX IDX_10381AEE1EFE06BF (analyse_id), INDEX IDX_10381AEE6B899279 (patient_id), PRIMARY KEY(analyse_id, patient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_de_naissance DATE NOT NULL, adresse VARCHAR(255) NOT NULL, num_tel INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE analyse_patient ADD CONSTRAINT FK_10381AEE1EFE06BF FOREIGN KEY (analyse_id) REFERENCES analyse (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE analyse_patient ADD CONSTRAINT FK_10381AEE6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE analyse_patient DROP FOREIGN KEY FK_10381AEE1EFE06BF');
        $this->addSql('ALTER TABLE analyse_patient DROP FOREIGN KEY FK_10381AEE6B899279');
        $this->addSql('DROP TABLE analyse');
        $this->addSql('DROP TABLE analyse_patient');
        $this->addSql('DROP TABLE patient');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
    }
}
