# Bienvenue sur mon projet
## Présentation du projet

Ce projet à été réalisé entièrement en autonomie. Je m'y suis consacré durant mon temps libre
en parallèle de ma formation de développeur web.

Ce projet à été réalisé en php avec notamment le framework Symfony. Il adopte une structure MVC et
il utilise une base de données MySQL.

Il a été construit dans le but de mettre en application ce que j'ai appris durant ma formation.

## Sur un plan technique
voici donc ce que j'ai utilisé pour ce projet:

+ php
+ Symfony
+ Twig
+ MySQL
+ Bootstrap

## En plus de ces technologies je me suis appliqué à mettre en place

+ La création d'un jeu de données grace aux fixtures.
+ Une gestion des droits avec une hierarchie entre ceux-ci.
+ Une partie backoffice avec notamment une gestion du parc, une gestion des marques et une gestion, des utilisateurs.
+ Une structure MVC avec une factorisation des vues.
+ Une sécurité à la validation des formulaires.
+ Un rendu API pour les modèles ainsi que la possibilité d'en ajouter
         
## Un projet qui évolue
Etant fait en parallèle de ma formation il y à certaines choses que je n'ai pas pu mettre en place faute de temps.
Voici ce qui est prévu que je mette en œuvre

+ La mise en place d'un token JWT pour sécuriser l'api.
+ Un hébergement des images via la database avec un hebergeur d'images.
+ La mise en place d'un service de slug pour les modèles et les marques. Réalisé le 10/07.
+ Mettre en place une commande pour faire un slug de toutes les données le necessitant en bdd: commande ```app:car:slug-update``` réalisé le 10/07.
+ Mettre en place un voter pour gérer certaines routes.
+ Mettre en place les test unitaires.

-----------------------------------------------------------------------------------------------------


# Wellcome to my project
## Summary

Whole this project are made alone during my web developer job's learning, precisely, during  my spare time. 

Whole the project were made in php, with Symfony's framework. It was made with a MVC structure and use
MySQL as database

It was made put in practice during my formation's learning

## On a technical plan
I use for this project:

+ php
+ Symfony
+ Twig
+ MySQL
+ Bootstrap

## To going further I've apply to

+ Using fixtures to create data
+ An access control depending Roles
+ A backoffice structure to rule the car, brand and users
+ MVC structure with factorisation between vues
+ A security on form's validation
+ a json render like API for car and brand

## A living Project

Like I said, this project take place during school sessions so there are such thing I have'nt implement yet.
But they are scheduled and in progress

+ JWT Token to secure API
+ Store picture in a database
+ Set up slug for car and brand. Done the 07-10
+ Set up command to sluggify car's name in database. Done the 07-10 command: ```app:car:slug-update```
+ Set up voter to control route accessibility
+ Set up unit test