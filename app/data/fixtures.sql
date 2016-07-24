-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 24 Juillet 2016 à 14:45
-- Version du serveur: 5.5.43
-- Version de PHP: 5.4.45-0+deb7u4

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `mind_marker`
--

--
-- Contenu de la table `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`) VALUES
(1, 'admin', 'admin', 'admin@domain.com', 'admin@domain.com', 1, '6v31mjt4hf0ow0o00440wwookwscckk', '$2y$13$6v31mjt4hf0ow0o00440wuOFpi8F8wA1ntX97m8o72/rvWoLKG1hS', '2016-07-24 14:17:38', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL);

--
-- Contenu de la table `mm_content`
--

INSERT INTO `mm_content` (`id`, `subject_id`, `created_by_id`, `title`, `value`, `collapsed`, `block`, `content_order`, `content_class`, `deleted_at`) VALUES
(3, 9, 1, 'position 1', NULL, 0, 1, 1, NULL, '2016-06-30 17:06:44'),
(4, 9, 1, 'blocks', NULL, 0, 2, 2, NULL, '2016-06-30 17:06:47'),
(5, 9, 1, 'Colors', NULL, 0, 2, 3, NULL, '2016-06-30 17:06:48'),
(6, 9, 1, 'order', NULL, 0, 2, 1, NULL, '2016-06-30 17:06:46'),
(7, 9, 1, 'new elements', NULL, 0, 3, 1, NULL, '2016-06-30 17:06:45'),
(8, 9, 1, 'test', NULL, 0, 1, NULL, NULL, '2016-06-30 17:06:44'),
(9, 9, 1, 'test', NULL, 0, 1, NULL, NULL, '2016-06-30 17:10:26'),
(10, 9, 1, 'test 1', NULL, 0, 1, NULL, NULL, '2016-06-30 17:10:27'),
(11, 9, 1, 'test 2', NULL, 0, 1, NULL, NULL, '2016-06-30 17:10:28'),
(12, 9, NULL, 'test 1', NULL, 0, 1, NULL, NULL, '2016-06-30 17:12:56'),
(13, 9, 1, 'test 1', NULL, 0, 1, NULL, NULL, '2016-06-30 17:12:55'),
(14, 9, NULL, 'test 1', NULL, 0, 1, 1, NULL, '2016-06-30 17:35:13'),
(15, 9, 1, 'test 2', NULL, 0, 1, 2, NULL, '2016-06-30 17:35:13'),
(16, 9, 1, 'test block', NULL, 0, 2, 1, NULL, '2016-06-30 17:35:15'),
(17, 9, 1, 'test other', NULL, 1, 3, 1, NULL, '2016-06-30 17:35:14'),
(18, 9, 1, 'unpin', NULL, 0, 1, NULL, NULL, '2016-06-30 17:14:16'),
(19, 9, 1, 'dete', NULL, 0, 1, NULL, NULL, '2016-06-30 17:14:23'),
(20, 9, 1, 'test', NULL, 0, 1, 1, NULL, '2016-07-01 18:09:55'),
(21, 9, 1, 'hello', NULL, 0, 2, 1, NULL, '2016-06-30 17:36:22'),
(22, 9, 1, '...', NULL, 0, 1, NULL, NULL, '2016-07-01 14:43:59'),
(23, 9, 1, 'tset', NULL, 0, 1, NULL, NULL, '2016-07-01 12:04:40'),
(24, 9, 1, 'test', NULL, 0, 1, NULL, NULL, '2016-07-01 14:45:02'),
(25, 9, NULL, 'no title ?', NULL, 1, 1, 2, NULL, '2016-07-04 12:42:23'),
(26, 9, 1, 'test 2', NULL, 0, 1, NULL, NULL, '2016-07-01 17:47:21'),
(27, 9, 1, 'Cool test', '> hello test', 0, 2, 1, 'panel-danger', '2016-07-07 13:59:52'),
(28, 9, 1, 'test 3 yeah', '[Markdown sheet cheat](https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet)', 0, 3, 1, 'panel-primary', '2016-07-07 13:59:49'),
(29, 9, 1, 'test 2', NULL, 0, 1, NULL, NULL, '2016-07-01 18:09:36'),
(30, 9, 1, 'test 5555', NULL, 0, 1, NULL, NULL, '2016-07-01 18:09:33'),
(31, 9, NULL, 'test 1', '```\r\n$(''body'').on(''click'', ''.save-content'', function(ev){\r\n        ev.preventDefault();\r\n        ev.stopPropagation();\r\n\r\n        var form = $(this).parent();\r\n        var id = form.parent().parent().attr(''id'');\r\n        $.ajax({\r\n            url: Routing.generate(''content_edit'', {''id'': id}),\r\n            method: "POST",\r\n            data: form.serialize(),\r\n        }).done(function(data) {\r\n            console.log(data);\r\n        });\r\n\r\n        return false;\r\n    })\r\n```', 0, 1, 1, 'panel-default', '2016-07-07 13:59:48'),
(32, 9, 1, 'test new', 'hello content\r\n----------------', 1, 3, 2, 'panel-primary', '2016-07-07 13:59:50'),
(33, 9, 1, 'Conditions', '* Conditional GET requests are the most efficient mechanism for HTTP cache updates \r\n* Conditionals can also be applied to state-changing methods, such as PUT and DELETE to prevent the "lost update" problem: one client accidentally overwriting the work of another client that has been acting in parallel \r\n> Exemple ?\r\n\r\n* strict revision control ( unique node name and revision identifier ) collision-resistant hash function applied to the representation data is also sufficient if the data is available prior t', 0, 1, 1, 'panel-default', NULL),
(34, 9, 1, 'Definitions', '*  a "weak validator" is representation metadata that might not change for every change to the representation data\r\n* a weak entity-tag ought to change whenever the origin server wants caches to invalidate old responses ETAG', 0, 3, 1, 'panel-info', NULL),
(35, 9, 1, 'Questions', 'Do conditions:\r\n\r\n* check Last-Modified ?\r\n* from where generated ?\r\n* use updatedAt ?\r\n\r\n#### <strong class="pull-right">Try</strong>\r\n\r\n\r\n* When client send cache control tags ? if Last-Modified value has been provided by the origin server ?\r\n\r\n* How does Varnish works ?', 0, 2, 1, 'panel-danger', NULL),
(36, 6, 1, 'Final thoughs', '<^_^>\r\n\r\nExtensible through **html**', 1, 1, 1, 'panel-primary', NULL),
(37, 6, 1, 'new content', '#### test with subject', 0, 1, NULL, 'panel-primary', '2016-07-19 10:37:59'),
(38, 11, 1, 'test 1', 'test 1', 0, 1, NULL, 'panel-default', '2016-07-19 17:18:59'),
(39, 11, 1, 'not empty', NULL, 0, 1, NULL, 'panel-default', '2016-07-20 11:37:51'),
(40, 12, 1, 'fake content', NULL, 0, 1, NULL, 'panel-default', '2016-07-20 11:12:50'),
(41, 13, 1, 'must be deleted', NULL, 0, 1, NULL, 'panel-default', '2016-07-20 11:12:50'),
(42, 6, 1, 'Release check', '#### Release:\r\n\r\n* Server\r\n* Clean DB and Fixtures\r\n* Github Readme ( install, usage )\r\n\r\n#### Markdow sheet cheet', 0, 1, 2, 'panel-warning', NULL),
(43, 6, 1, 'Qualification check', '* Qualication server\r\n* HTTP chapters', 0, 2, 1, 'panel-info', NULL),
(44, 6, 1, 'On line version', '* User accounts\r\n* V8\r\n* google ads\r\n* user manual\r\n\r\n> Trouver un + ( valeur ajoutés )', 1, 3, 1, 'panel-success', NULL),
(45, 3, 1, 'Readme', NULL, 0, 1, NULL, 'panel-default', NULL),
(46, 10, 1, 'Headers', '```\r\n# H1\r\n## H2\r\n### H3\r\n#### H4\r\n##### H5\r\n###### H6\r\n\r\nAlternatively, for H1 and H2, an underline-ish style:\r\n\r\nAlt-H1\r\n======\r\n\r\nAlt-H2\r\n------\r\n```', 0, 2, 1, 'panel-default', NULL),
(47, 10, 1, 'Emphasis', '```\r\nEmphasis, aka italics, with *asterisks* or _underscores_.\r\n\r\nStrong emphasis, aka bold, with **asterisks** or __underscores__.\r\n\r\nCombined emphasis with **asterisks and _underscores_**.\r\n\r\nStrikethrough uses two tildes. ~~Scratch this.~~\r\n```', 0, 3, 1, 'panel-default', NULL),
(48, 10, 1, 'Headers', '# H1\r\n## H2\r\n### H3\r\n#### H4\r\n##### H5\r\n###### H6\r\n\r\nAlternatively, for H1 and H2, an underline-ish style:\r\n\r\nAlt-H1\r\n======\r\n\r\nAlt-H2\r\n------', 0, 3, 1, 'panel-primary', '2016-07-20 12:23:19'),
(49, 10, 1, 'Emphasis', 'Emphasis, aka italics, with *asterisks* or _underscores_.\r\n\r\nStrong emphasis, aka bold, with **asterisks** or __underscores__.\r\n\r\nCombined emphasis with **asterisks and _underscores_**.\r\n\r\nStrikethrough uses two tildes. ~~Scratch this.~~', 0, 3, 2, 'panel-primary', '2016-07-20 12:23:21'),
(50, 10, 1, 'Lists', '````\r\n1. First ordered list item\r\n2. Another item\r\n··* Unordered sub-list. \r\n1. Actual numbers don''t matter, just that it''s a number\r\n··1. Ordered sub-list\r\n4. And another item.\r\n\r\n···You can have properly indented paragraphs within list items. Notice the blank line above, and the leading spaces (at least one, but we''ll use three here to also align the raw Markdown).\r\n\r\n···To have a line break without a paragraph, you will need to use two trailing spaces.··\r\n···Note that this line is separate, but within th', 0, 2, 2, 'panel-default', NULL),
(51, 10, 1, 'Links', '```\r\n[I''m an inline-style link](https://www.google.com)\r\n\r\n[I''m an inline-style link with title](https://www.google.com "Google''s Homepage")\r\n\r\n[I''m a reference-style link][Arbitrary case-insensitive reference text]\r\n\r\n[I''m a relative reference to a repository file](../blob/master/LICENSE)\r\n\r\n[You can use numbers for reference-style link definitions][1]\r\n\r\nOr leave it empty and use the [link text itself].\r\n\r\nURLs and URLs in angle brackets will automatically get turned into links. \r\nhttp://www.example.com o', 0, 3, 2, 'panel-default', NULL),
(52, 10, 1, 'test', '**asterisks**', 0, 1, NULL, 'panel-default', '2016-07-20 12:25:02'),
(53, 10, 1, 'Images', '````\r\nHere''s our logo (hover to see the title text):\r\n\r\nInline-style: \r\n![alt text](https://github.com/adam-p/markdown-here/raw/master/src/common/images/icon48.png "Logo Title Text 1")\r\n\r\nReference-style: \r\n![alt text][logo]\r\n\r\n[logo]: https://github.com/adam-p/markdown-here/raw/master/src/common/images/icon48.png "Logo Title Text 2"\r\n````', 0, 2, 3, 'panel-default', NULL),
(54, 10, 1, 'Tables', '```\r\nColons can be used to align columns.\r\n\r\n| Tables        | Are           | Cool  |\r\n| ------------- |:-------------:| -----:|\r\n| col 3 is      | right-aligned | $1600 |\r\n| col 2 is      | centered      |   $12 |\r\n| zebra stripes | are neat      |    $1 |\r\n\r\nThere must be at least 3 dashes separating each header cell.\r\nThe outer pipes (|) are optional, and you don''t need to make the \r\nraw Markdown line up prettily. You can also use inline Markdown.\r\n\r\nMarkdown | Less | Pretty\r\n--- | --- | ---\r\n*Still* | ', 0, 3, 3, 'panel-default', NULL),
(55, 10, 1, 'Blockquotes', '```\r\n> Blockquotes are very handy in email to emulate reply text.\r\n> This line is part of the same quote.\r\n\r\nQuote break.\r\n\r\n> This is a very long line that will still be quoted properly when it wraps. Oh boy let''s keep writing to make sure this is long enough to actually wrap for everyone. Oh, you can *put* **Markdown** into a blockquote. \r\n```', 0, 2, 4, 'panel-default', NULL),
(56, 10, 1, 'Horizontal rule', '```\r\nThree or more...\r\n\r\n---\r\n\r\nHyphens\r\n\r\n***\r\n\r\nAsterisks\r\n\r\n___\r\n\r\nUnderscores\r\n```', 0, 3, 4, 'panel-default', NULL),
(57, 14, 1, 'Certif', '* Mettre en place MindMarker\r\n* Fiches du chapitre HTTP\r\n* Commencer la pratique', 0, 1, 1, 'panel-primary', NULL),
(58, 12, 1, 'Art du discours', NULL, 1, 1, 1, 'panel-primary', NULL),
(59, 12, 1, 'La théorie de la musique', '+ cours de pratique', 1, 1, 4, 'panel-default', NULL),
(60, 12, 1, 'Mathématiques', NULL, 1, 1, 3, 'panel-default', NULL),
(61, 12, 1, 'Le dessin', NULL, 1, 1, 2, 'panel-default', NULL),
(62, 16, 1, 'Mission', '+ Argent\r\n+ Certif', 0, 1, 1, 'panel-primary', NULL),
(63, 16, 1, 'Soirée', '1. Taches quotidiennes\r\n2. CERTIF', 0, 2, 1, 'panel-primary', NULL),
(64, 16, 1, 'WE', '> Divers\r\n\r\n* Discours', 0, 1, 3, 'panel-primary', NULL),
(65, 16, 1, 'Coachs', '* nn-coaching', 1, 3, 1, 'panel-default', NULL),
(66, 17, 1, 'Taches menagères quotidiennes', NULL, 1, 1, 2, 'panel-default', NULL),
(67, 17, 1, 'Matin poubelle', NULL, 1, 1, 3, 'panel-default', NULL),
(68, 15, 1, 'Objectifs', '* Faire preuve de flexibilité\r\n * Laisser du temps pour m''amuser\r\n * Garder en tête un objectif principal\r\n * Essayer de faire le reste sans contraintes\r\n\r\n> Echeance: Etape 1 discours ( Livre )\r\n\r\n> Fil rouge: Reprendre la preparation', 0, 1, 2, 'panel-default', NULL),
(69, 17, 1, 'Sport - douche', NULL, 1, 1, 1, 'panel-default', NULL),
(70, 13, 1, 'Mind maker', '* Mettre en ligne\r\n* Evaluer', 0, 1, 1, 'panel-primary', NULL),
(71, 17, 1, 'Support de vie', '* Menage\r\n* Deco', 1, 3, 1, 'panel-info', NULL),
(72, 13, 1, 'Deco', NULL, 1, 1, 3, 'panel-default', NULL),
(73, 12, 1, 'Rotary', 'https://www.rotary.org', 1, 1, 5, 'panel-default', NULL),
(74, 13, 1, 'Quotes codex', NULL, 1, 1, 2, 'panel-default', NULL),
(75, 15, 1, 'Besoins', '* Avancer: \r\n * **Reprendre la preparation**\r\n * Mettre en place un rythme ascendant*\r\n * Commencer une formation en discours', 0, 2, 1, 'panel-primary', NULL),
(76, 15, 1, 'Avantages', '* Facilités en developpement > web > symfony\r\n* Polyvalant\r\n* Perseverant', 0, 3, 1, 'panel-info', NULL),
(77, 15, 1, 'Opportunités', '* Les soldes', 0, 2, 2, 'panel-warning', NULL),
(78, 15, 1, 'Dangés', '* Echance de la rentrée (Discour, tenue)', 0, 3, 2, 'panel-danger', NULL),
(79, 13, 1, 'Garde robe', NULL, 1, 1, 4, 'panel-default', NULL),
(80, 15, 1, 'Acquis', '* Première seance coaching \r\n * Moyennement concluante > en attente prochiane seance (16/08/2016)\r\n * Reprendre la preparation de la certif\r\n * MindMarker opérationel', 0, 1, 1, 'panel-success', NULL),
(81, 13, 1, 'Sport', '* Courir \r\n* Coach - boxe\r\n* Musculation\r\n\r\n> Surveiller le poid', 0, 1, 5, 'panel-default', NULL),
(82, 16, 1, 'Midi', '* Taches quotidiennes', 1, 1, 2, 'panel-default', NULL),
(83, 14, 1, 'Arreter de fumer', NULL, 1, 1, 2, 'panel-default', NULL),
(84, 14, 1, 'Hitech', '* Tablette - lecture\r\n* Guitare éléctrique\r\n* Alienware\r\n* Oculus rift', 1, 1, 3, 'panel-default', NULL),
(85, 12, 1, 'Boxe', NULL, 1, 1, 6, 'panel-default', NULL);

--
-- Contenu de la table `mm_subject`
--

INSERT INTO `mm_subject` (`id`, `root_id`, `parent_id`, `created_by_id`, `label`, `lft`, `lvl`, `rgt`) VALUES
(1, 1, NULL, 1, 'Root', -5, 0, 20),
(2, 1, 6, 1, 'Usage', -1, 2, 2),
(3, 1, 6, 1, 'Developpement', -3, 2, -2),
(4, 4, NULL, 1, 'test root', -1, 0, 0),
(5, 5, NULL, 1, 'test root 1', -1, 0, 0),
(6, 1, 1, 1, 'Mind Marker', -4, 1, -1),
(8, 1, 1, 1, 'HTTP', 2, 1, 5),
(9, 1, 8, 1, 'Validators', 3, 2, 4),
(10, 1, 1, 1, 'Markdow', 0, 1, 1),
(12, 1, 15, 1, 'Sciences', 9, 2, 10),
(13, 1, 15, 1, 'Projets', 13, 2, 16),
(14, 1, 13, 1, 'Merveilles', 14, 3, 15),
(15, 1, 1, 1, 'Plan', 8, 1, 19),
(16, 1, 15, 1, 'Cités', 11, 2, 12),
(17, 1, 15, 1, 'Doctrines', 17, 2, 18);

--
-- Contenu de la table `mm_task`
--

INSERT INTO `mm_task` (`id`, `task_list_id`, `title`, `description`, `dueDate`, `done`, `number`) VALUES
(1, 4, 'Maquette', NULL, 'V1', 1, 1),
(3, 5, 'Classer mes sujets', 'set elements order + reorder after dnd', 'V2', 1, 2),
(4, 6, 'Saisir une note', '( contenant un titre, et du contenu ) + editer + supprimer', 'V3', 1, 1),
(5, 6, 'Formatter le texte d''une note', 'ckEditor + panel colors', 'V3', 1, 3),
(6, 4, 'Ajouter une liste de taches', '+ editer titre', 'V1', 1, 2),
(7, 4, 'Saisir une liste de taches', '( element de la liste ) + editer + supprimer', 'V1', 1, 3),
(8, 4, 'Changer l''ordre des elements de ma liste', '( Drag n drop ) + marquer en done', 'V1', 1, 4),
(9, 8, 'Classer mes notes / liste suivant un sujet', 'on create + on edit', 'V5', 1, 2),
(10, 8, 'Selectionner un sujet', NULL, 'V5', 1, 1),
(11, 8, 'Supprimer un sujet', 'listes et notes inclues', 'V5', 1, 3),
(12, 1, 'AI component', '+ user accounts', 'V7', 0, 2),
(13, 4, 'Fixtures', 'Sauvegarde', 'V1', 1, 5),
(14, 7, 'Reordonner mes listes', '+ supprimer une liste de taches', 'V4', 1, 2),
(17, 3, 'Copier une tache', NULL, NULL, 0, 1),
(19, 3, 'Homepage / Dashboard', NULL, NULL, 0, 3),
(20, 3, 'Default caneva', NULL, NULL, 0, 4),
(21, 3, 'Childcounter Extension', NULL, NULL, 0, 5),
(22, 3, 'Change completed list to green', NULL, NULL, 0, 6),
(23, 3, 'Change date delayed list to red', 'display notification ( dashboard )', NULL, 0, 7),
(24, 3, 'Notification', NULL, NULL, 0, 8),
(25, 3, 'Move task to another list', NULL, NULL, 1, 9),
(26, 3, 'Reduce list', NULL, NULL, 0, 10),
(27, 3, 'Filter by due date', NULL, NULL, 0, 11),
(28, 3, 'Expand lists bloc', NULL, NULL, 1, 12),
(29, 5, 'Créer un sujet', '+ editer', 'V2', 1, 1),
(30, 2, 'move before subject', NULL, NULL, 0, 3),
(31, 6, 'Notes', 'position', 'V3', 1, 2),
(33, 1, 'Archives', 'soft delete todo-lists ?', 'V6', 0, 1),
(34, 3, 'unpop in sidebar', NULL, NULL, 1, 13),
(35, 3, 'Links and pages', NULL, NULL, 0, 14),
(36, 3, 'Textarea height', 'Could be same as panel-boduy height', NULL, 0, 15),
(37, 1, 'Mobile', NULL, 'V8', 0, 3),
(38, 7, 'Pre-version list fixes', 'order, new list postpend, move to other list', 'V4', 1, 1),
(45, 3, 'html shortcuts (content/todos)', '#### <strong class="pull-right">Try</strong>', NULL, 0, 16),
(46, 11, 'test task', NULL, NULL, 1, 1),
(48, 3, 'counters', 'number of content blocs and todos', NULL, 0, 17),
(49, 2, 'content empty title', NULL, NULL, 0, 4),
(50, 3, 'Manage reorder by grid', 'use bootstap grid to represent tree', NULL, 0, 18),
(51, 3, 'Page crawl', NULL, NULL, 0, 19),
(52, 3, 'Auto focus on add / edit', 'content / list / task', NULL, 0, 20),
(54, 10, 'Chercher une formation ( discours )', NULL, NULL, 1, 3),
(56, 10, 'Mettre en place Markdown', NULL, NULL, 0, 1),
(57, 10, 'Taches quotidiennes', 'permis', NULL, 0, 2),
(58, 10, 'Faire du shopping', NULL, 'Samedi', 0, 6),
(59, 10, 'Faire une seance de prep en milieu de semaine', NULL, NULL, 0, 4),
(60, 10, 'Ajouter une nouvelle doctrine', NULL, NULL, 0, 5),
(61, 10, 'Livre discours', NULL, 'Dimanche', 0, 7);

--
-- Contenu de la table `mm_task_list`
--

INSERT INTO `mm_task_list` (`id`, `subject_id`, `title`, `color`, `number`) VALUES
(1, 6, 'Next versions', NULL, 6),
(2, 6, 'Bugs', NULL, 7),
(3, 2, 'Les plus', NULL, 8),
(4, 3, 'V1', NULL, 2),
(5, 3, 'V2', NULL, 3),
(6, 3, 'V3', NULL, 4),
(7, 3, 'V4', NULL, 5),
(8, 3, 'V5', NULL, 1),
(10, 15, 'Taches', NULL, 1);
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
