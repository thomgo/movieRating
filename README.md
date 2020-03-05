# Débogage d'une application Symfony d'évaluation de films

Il s'agit d'une application développée dans le cadre de mon poste de formateur en développement web. L'objectif est que les apprenants améliorent leur compréhension du framework Symfony en reprenant le code d'une application déjà existante mais non fonctionnelle car buguée. Ils apprennent également à travailler avec des tests unitaires existants et à s'y conformer. leur objectif est de rendre l'application utilisable par le client et de la valider par les batteries de tests.

Deux versions de l'application sont présentes sur ce repository, la fonctionnelle et celle à corriger.

Au travers de cet exercice, ils apprennent à :
- Gérer des données avec l’orm Doctrine
- Gérer des entités avec l’orm Doctrine
- Gérer les relations entre entités
- Créer des formulaires et gérer leur soumission
- Gérer la sécurité
- Utiliser la validator
- Utiliser les fixtures pour peupler la BDD
- Utiliser le moteur de template twig
- Comprendre les test unitaires et fonctionnels
- Développer du code pour qu'il réponde à des tests
- Reprendre un code déjà existant

## Consignes

Vous venez d’intégrer une start-up du web pour votre premier contrat de travail. Cette start-up
souhaite proposer une application web afin de permettre aux internautes d’évaluer les films sortis au cinéma. L’objectif pour elle est de se rémunérer via de la publicité sur le site et aux personnes s’étant inscrites.

Les financeurs ont été séduits par le concept et votre entreprise a levé des fonds pour engager le développement de cette application. Vous n’êtes pas le premier développeur qui y travaille. Jeffrey Uneconnerie avait été embauché avant vous pour mener cette application à son terme. Malheureusement les choses ne se sont pas très bien passées et ce dernier a dû être renvoyé.

Il a produit une partie de l’application mais en l’état quasiment rien n’est fonctionnel et personne n’arrive à reprendre son code car il l’a développé seul dans son coin sans échanger avec ses collègues. Il ne travaillait pas professionnellement, à tel point qu’il n’a même pas versionné son code, vous n’avez donc aucun moyen de suivre son évolution ! La seule chose qu’il a laissé c’est un dossier zip sur une clef USB suspendue à un crochet au secrétariat.

Aujourd'hui le temps presse, vous n’avez pas le temps de repartir de zéro, vous devez reprendre son application, supprimer les divers bugs, réagencer le code si nécessaire et poursuivre le
développement en intégrant toutes les fonctionnalités qui vous semblent manquantes. Heureusement dans votre malheur vous êtes chanceux car le lead développeur de l'entreprise avait écrit une série de tests que l'application doit valider avant toute mise en production. Ces tests pourront vous servir de feuille de route. Voici le cahier des charges tel qu’il lui avait été fourni.

L’application doit permettre de :
- Voir tous les films du catalogue sur la page d’accueil
- Voir un film avec ses caractéristiques (date, auteur, résumé...), ses 5 dernières évaluations et la moyenne des notes qui lui ont été attribuées
- Evaluer un film : une évaluation est composée d’une note de 0 à 10 et éventuellement d’un commentaire laissé par l’utilisateur
- Laisser une évaluation uniquement si l’utilisateur est connecté
- Déconnecter l'utilisateur

Spécifications techniques :
- Le contenu en base de données pour les films, les utilisateurs et les évaluations est généré via les fixtures
- L'application valide tous les tests du dossier test. **vous n'êtes pas autorisés à modifier les tests**.

## Pour aller plus loin

- Permettre à l’utilisateur de se créer un compte
- Sur la page d’un film, afficher les trois meilleures notes avec leur éventuel commentaire et les trois pires notes en les mettant visuellement en avant
- Créer une page profil pour l’utilisateur où il pourra voir ses informations personnelles mais surtout l’ensemble des évaluations qu’il a laissées et éventuellement les modifier.
- Empêcher un utilisateur d'évaluer deux fois un film
