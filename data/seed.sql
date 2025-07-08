-- Utilisateur
INSERT INTO users (pseudo, mail, password, role, status)
VALUES ('LoneHero', 'hero@example.com', '123', 'user', 'active');

-- -------------------------
-- Défi Fantastique (DF)
-- -------------------------
INSERT INTO df_adventure (
    title, chapter, ability_start, ability_current,
    endurance_start, endurance_current, luck_start, luck_current,
    gold, jewels, potion_name, potion_dose, provision
)
VALUES (
    'La Cité des Pièges', 5, 10, 8,
    20, 15, 12, 10,
    50, 3, 'Potion de Chance', 2, 4
);

SET @df_id = LAST_INSERT_ID();
SET @user_id = (SELECT id FROM users WHERE mail = 'hero@example.com');

-- Liaison user <-> df
INSERT INTO df_users (user_id, df_id) VALUES (@user_id, @df_id);

-- Notes DF
INSERT INTO df_notes (note, df_id) VALUES 
('Première note DF', @df_id),
('Deuxième note DF', @df_id),
('Troisième note DF', @df_id);

-- Objet sac DF
INSERT INTO df_bag (object, df_id) VALUES
('Épée courte', @df_id),
('Corde', @df_id),
('Potion de soin', @df_id),
('Carte ancienne', @df_id),
('Clé rouillée', @df_id);

-- -------------------------
-- Quête du Graal (QG)
-- -------------------------
INSERT INTO qg_adventure (
    title, chapter, life_start, life_current, experience, life_permanent
)
VALUES (
    'La Forêt de la Malédiction', 3, 25, 22, 10, 2
);

SET @qg_id = LAST_INSERT_ID();

-- Liaison user <-> qg
INSERT INTO qg_users (user_id, qg_id) VALUES (@user_id, @qg_id);

-- Notes QG
INSERT INTO qg_notes (note, qg_id) VALUES
('Première note QG', @qg_id),
('Deuxième note QG', @qg_id),
('Troisième note QG', @qg_id);

-- Objet sac QG
INSERT INTO qg_bag (object, qg_id) VALUES
('Pain sec', @qg_id),
('Flûte magique', @qg_id),
('Pierre runique', @qg_id),
('Sac de couchage', @qg_id),
('Amulette de protection', @qg_id);

-- -------------------------
-- Loup Solitaire (LW)
-- -------------------------
INSERT INTO lw_adventure (
    title, chapter, ability, endurance,
    weapon1, weapon2,
    discipline_one, discipline_two, discipline_three, discipline_for
)
VALUES (
    'Les Maîtres des Ténèbres', 7, 16, 25,
    'Sabre', 'Dague',
    'Camouflage', 'Sixième Sens', 'Maîtrise des Armes', 'Guérison'
);

SET @lw_id = LAST_INSERT_ID();

-- Liaison user <-> lw
INSERT INTO lw_users (user_id, lw_id) VALUES (@user_id, @lw_id);

-- Notes LW
INSERT INTO lw_notes (note, lw_id) VALUES
('Première note LW', @lw_id),
('Deuxième note LW', @lw_id),
('Troisième note LW', @lw_id);

-- Objet sac LW
INSERT INTO lw_bag (object, status, lw_id) VALUES
('Pierre de feu', 'common', @lw_id),
('Baume de soin', 'common', @lw_id),
('Lanterne', 'common', @lw_id),
('Anneau mystérieux', 'special', @lw_id),
('Carte du royaume', 'special', @lw_id);