PRAGMA foreign_keys=OFF;
BEGIN TRANSACTION;
INSERT INTO "mm_subject" VALUES(1,1,NULL,NULL,'test',1,0,12);
INSERT INTO "mm_subject" VALUES(2,1,1,NULL,'test child',2,1,7);
INSERT INTO "mm_subject" VALUES(3,3,NULL,NULL,'test 1',1,0,6);
INSERT INTO "mm_subject" VALUES(4,1,2,NULL,'hello',3,2,4);
INSERT INTO "mm_subject" VALUES(5,1,2,NULL,'techs',5,2,6);
INSERT INTO "mm_subject" VALUES(6,3,3,NULL,'new techs',2,1,5);
INSERT INTO "mm_subject" VALUES(7,1,1,NULL,'subtree',8,1,11);
INSERT INTO "mm_subject" VALUES(8,1,7,NULL,'lol',9,2,10);
INSERT INTO "mm_subject" VALUES(9,3,6,NULL,'test',3,2,4);
INSERT INTO "task" VALUES(1,1,'Maquette',NULL,'V1',1,1);
INSERT INTO "task" VALUES(3,1,'Classer mes sujets',NULL,'V2',0,3);
INSERT INTO "task" VALUES(4,1,'Saisir une note','( contenant un titre, et du contenu ) + editer + supprimer','V3',0,4);
INSERT INTO "task" VALUES(5,1,'Formatter le texte d''une note','Wysiwig ? reStructuredText ?','V3',0,5);
INSERT INTO "task" VALUES(6,1,'Ajouter une liste de taches','+ editer titre','V1',1,6);
INSERT INTO "task" VALUES(7,1,'Saisir une liste de taches','( element de la liste ) + editer + supprimer','V1',1,7);
INSERT INTO "task" VALUES(8,1,'Changer l''ordre des elements de ma liste','( Drag n drop ) + marquer en done','V1',1,8);
INSERT INTO "task" VALUES(9,1,'Classer mes notes / liste suivant un sujet','( Drag n drop )','V4',0,10);
INSERT INTO "task" VALUES(10,1,'Selectionner un sujet',NULL,'V5',0,12);
INSERT INTO "task" VALUES(11,1,'Supprimer un sujet','listes et notes inclues','V5',0,13);
INSERT INTO "task" VALUES(12,1,'AI component',NULL,'V6',0,14);
INSERT INTO "task" VALUES(13,1,'Fixtures','Sauvegarde','V1',0,9);
INSERT INTO "task" VALUES(14,1,'Reordonner mes listes','+ supprimer une liste de taches','V4',0,11);
INSERT INTO "task" VALUES(15,2,'Add than reorder or update?',NULL,NULL,0,1);
INSERT INTO "task" VALUES(16,2,'Reorder Bug',NULL,NULL,0,2);
INSERT INTO "task" VALUES(17,3,'Copier une tache',NULL,NULL,0,1);
INSERT INTO "task" VALUES(19,3,'Homepage / Dashboard',NULL,NULL,0,3);
INSERT INTO "task" VALUES(20,3,'Default caneva',NULL,NULL,0,4);
INSERT INTO "task" VALUES(21,3,'Childcounter Extension',NULL,NULL,0,5);
INSERT INTO "task" VALUES(22,3,'Change completed list to green',NULL,NULL,0,6);
INSERT INTO "task" VALUES(23,3,'Change date delayed list to red','display notification ( dashboard )',NULL,0,7);
INSERT INTO "task" VALUES(24,3,'Notification',NULL,NULL,0,8);
INSERT INTO "task" VALUES(25,3,'Move task to another list',NULL,NULL,0,9);
INSERT INTO "task" VALUES(26,3,'Reduce list',NULL,NULL,0,10);
INSERT INTO "task" VALUES(27,3,'Filter by due date',NULL,NULL,0,11);
INSERT INTO "task" VALUES(28,3,'Expand lists bloc',NULL,NULL,0,12);
INSERT INTO "task_list" VALUES(1,NULL,'SPECS',NULL,1);
INSERT INTO "task_list" VALUES(2,NULL,'Bugs',NULL,1);
INSERT INTO "task_list" VALUES(3,NULL,'Les plus',NULL,1);
COMMIT;
