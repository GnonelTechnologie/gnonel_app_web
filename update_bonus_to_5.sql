-- Script pour mettre à jour le bonus de réduction à 5%
-- Exécuter ce script directement dans votre base de données

-- Mettre à jour le bonus de réduction dans la table configurations
UPDATE configurations SET bonus = 5 WHERE bonus > 5;

-- Vérifier la mise à jour
SELECT * FROM configurations; 