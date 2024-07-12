CREATE DATABASE IF NOT EXISTS mglsi_news;
USE mglsi_news;

DROP TABLE IF EXISTS Article, Categorie;

CREATE TABLE Article(
	id int primary key auto_increment,
	titre varchar(255),
	contenu text,
	dateCreation datetime DEFAULT NOW(),
	dateModification datetime DEFAULT NOW(),
	categorie int
);

CREATE TABLE Categorie(
	id int primary key auto_increment,
	libelle varchar(20)
);

INSERT INTO Categorie(libelle) VALUES ('Sport'), ('Santé'), ('Education'), ('Politique');

INSERT INTO Article (titre, contenu, categorie) VALUES 
    ('Première victoire du Sénégal', 
     'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 
     1),
    ('Election en Mauritanie', 
     'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 
     4),
    ('Début de la CAN', 
     'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 
     1),
    ('Pétrole au Sénégal', 
     'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 
     4),
    ("Inauguration d'un ENO à l'UVS", 
     'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 
     3),
    ('Nouvelles avancées en médecine', 
     'Les chercheurs ont fait des progrès significatifs dans le traitement du cancer, avec de nouvelles thérapies ciblées qui montrent des résultats prometteurs.', 
     2),
    ('Prévention des maladies cardiovasculaires', 
     'Une alimentation équilibrée, l’exercice régulier et la gestion du stress sont essentiels pour prévenir les maladies cardiovasculaires.', 
     2),
    ('Impact du sommeil sur la santé mentale', 
     'Le sommeil joue un rôle crucial dans la régulation de l’humeur et de la santé mentale. Un manque de sommeil peut entraîner des troubles de l’humeur et de l’anxiété.', 
     2),
    ('Vaccination contre la grippe', 
     'La vaccination annuelle contre la grippe est recommandée pour réduire le risque de complications graves, notamment chez les personnes âgées et les enfants.', 
     2),
    ('Santé et bien-être au travail', 
     'Les entreprises mettent de plus en plus l’accent sur la santé et le bien-être au travail, avec des programmes de soutien psychologique et des initiatives de promotion de la santé.', 
     2);

ALTER TABLE Article ADD CONSTRAINT fk_categorie_article FOREIGN KEY(categorie) REFERENCES Categorie(id);

GRANT ALL PRIVILEGES ON mglsi_news.* TO mglsi_user IDENTIFIED BY 'passer';
