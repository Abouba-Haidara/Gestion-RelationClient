# Gestion-RelationClient
La gestion de la relation client est un ensemble complet de règles et de processus visant à améliorer la relation client dans une organisation à fin de fidéliser les clients.


Dans ce travail, nous allons mettre en place une application web pour gérer la relation client d’une entreprise  fictive appelé XYZ.
Cette application permet d’améliorer le service client de l’entreprise XYZ de manière systématique. C’est-à-dire gérer toutes les interactions entre l’entreprise XYZ et le Client.


l’entreprise XYZ fournissent des services et tante de développer une relation à long terme avec le client. 
L’application sera améliorée de manière progressive.


Travail à faire :

	Gérer les comptes utilisateurs (Admin, Employé, chef département, DG)

	Gérer le client (Créer, Supprimer, modifier, rechercher le client)

	Gérer le service (Créer, modifier, supprimer, rechercher le service)

	Gérer l’employé (Créer, supprimer, modifier, rechercher, affecter l’employé)

	Gérer département (Créer, supprimer, modifier, rechercher le département)

Chaque client reçoit un code client unique. Le détail de chaque nouveau client est enregistré dans la base de données. 
Après l'enregistrement du client, une nouvelle fiche de travail est ouverte avec les détails du service et l'identifiant du client. Le détail de chaque nouvel employé est enregistré dans la base de données.

Toutes les informations sont stockées  dans une base de données MYSQL.

L’employé peut seulement afficher les informations sur le service.

L’admin peut tout faire dans l’application. Le Chef de département peut ajouter un nouvel employé et un nouveau client, peut consulter la liste de service, la liste d’employé et la liste de client. 
Le DG peut consulter la liste de service, la liste de client et les employés.

Les tables de la base de données sont : 

; Client (nom, prénom, adresse, code client,) 
; Employé (nom, prénom, adresse, fonction, ID) ; 
; FicheService (ID, Numéro Fiche, date création, codeClient) ; 
; FicheServiceEmploye (ID, IDService, IDEmploye) ;
; Département (ID, nom, nombreEmployé)
