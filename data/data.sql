-- EFFACEMENT DES TABLES
-- table defi fantastique => df
DROP TABLE IF EXISTS df_users;
DROP TABLE IF EXISTS df_notes;
DROP TABLE IF EXISTS df_bag;
DROP TABLE IF EXISTS df_adventure;
-- table quete du lone Wolf => lw
DROP TABLE IF EXISTS lw_users;
DROP TABLE IF EXISTS lw_notes;
DROP TABLE IF EXISTS lw_bag;
DROP TABLE IF EXISTS lw_adventure;
-- table quete du graal => qg
DROP TABLE IF EXISTS qg_users;
DROP TABLE IF EXISTS qg_notes;
DROP TABLE IF EXISTS qg_bag;
DROP TABLE IF EXISTS qg_adventure;
-- table user 
DROP TABLE IF EXISTS users;

-- CREATION DES TABLES 

-- table USERS
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pseudo VARCHAR(255),
    mail VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    role VARCHAR(100),
    status VARCHAR(100)
)ENGINE=InnoDB;

-- table LONE WOLF
CREATE TABLE lw_adventure(
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    chapter INT,
    ability INT,
    endurance INT,
    weapon1 VARCHAR(255),
    weapon2 VARCHAR(255),
    discipline_one VARCHAR(255),
    discipline_two VARCHAR(255),
    discipline_three VARCHAR(255),
    discipline_for VARCHAR(255),
    discipline_five VARCHAR(255),
    discipline_six VARCHAR(255),
    discipline_more_one VARCHAR(255),
    discipline_more_two VARCHAR(255),
    discipline_more_three VARCHAR(255),
    discipline_more_for VARCHAR(255),
    discipline_more_five VARCHAR(255),
    discipline_more_six VARCHAR(255)
)ENGINE=InnoDB;

CREATE TABLE lw_notes(
    id INT AUTO_INCREMENT PRIMARY KEY,
    note VARCHAR(255),
    lw_id INT,
    FOREIGN KEY (lw_id) REFERENCES lw_adventure(id)
)ENGINE=InnoDB;

CREATE TABLE lw_bag(
    id INT AUTO_INCREMENT PRIMARY KEY,
    object VARCHAR(255),
    status VARCHAR(100),
    lw_id INT,
    FOREIGN KEY (lw_id) REFERENCES lw_adventure(id)
)ENGINE=InnoDB;

CREATE TABLE lw_users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    lw_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (lw_id) REFERENCES lw_adventure(id)
)ENGINE=InnoDB;

-- table Quete du Graal
CREATE TABLE qg_adventure(
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    chapter INT,
    life_start INT,
    life_current INT,
    experience INT,
    life_permanent INT
)ENGINE=InnoDB;

CREATE TABLE qg_bag(
    id INT AUTO_INCREMENT PRIMARY KEY,
    object VARCHAR(255),
    qg_id INT,
    FOREIGN KEY (qg_id) REFERENCES qg_adventure(id)
)ENGINE=InnoDB;

CREATE TABLE qg_notes(
    id INT AUTO_INCREMENT PRIMARY KEY,
    note VARCHAR(255),
    qg_id INT,
    FOREIGN KEY (qg_id) REFERENCES qg_adventure(id)
)ENGINE=InnoDB;

CREATE TABLE qg_users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    qg_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (qg_id) REFERENCES qg_adventure(id)
)ENGINE=InnoDB;

-- table Defi Fantastique
CREATE TABLE df_adventure(
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    chapter INT,
    ability_start INT,
    ability_current INT,
    endurance_start INT,
    endurance_current INT,
    luck_start INT,
    luck_current INT,
    gold INT,
    jewels INT,
    potion_name VARCHAR(255),
    potion_dose INT,
    provision INT
)ENGINE=InnoDB;

CREATE TABLE df_notes(
    id INT AUTO_INCREMENT PRIMARY KEY,
    note VARCHAR(255),
    df_id INT,
    FOREIGN KEY (df_id) REFERENCES df_adventure(id)
)ENGINE=InnoDB;

CREATE TABLE df_bag(
    id INT AUTO_INCREMENT PRIMARY KEY,
    object VARCHAR(255),
    df_id INT,
    FOREIGN KEY (df_id) REFERENCES df_adventure(id)
)ENGINE=InnoDB;

CREATE TABLE df_users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    df_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (df_id) REFERENCES df_adventure(id)
)ENGINE=InnoDB;