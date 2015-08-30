# Process de développement

Le développement est mené à l'aide des [tickets GitHub](https://github.com/CDJE/Incipio/issues) et de la [board Waffle](https://waffle.io/CDJE/Incipio).

Waffle comprend 5 colonnes :
* Backlog : list de toutes les spécifications, bugs, idées, etc. (tout ticket GitHub qui n'est pas dans le pipe d'un sprint).
* Sprint composé des 4 colonnes suivantes :
  * Ready : tickets à traiter pour le sprint en cours
  * In progress : tickets en cours de traitement
  * Review : tickets où le développement est terminé mais est en attente de validation par une tierce personne
  * Done : ticket prêt à être mergé pour la milestone en cours

Le process est donc le suivant : tous les tickets sont regroupés dans "Backlog". Des sprints de 1 semaine sont organisés. Pour chaque sprint, une liste de tickets à traiter est décidé, ce qui compose la colonne "Ready". Lorsqu'en cours de traitement, les tickets passent de l'état "Ready" à "In progress". Une fois le ticket traité, il passe dans la colonne "Review" où il est doit être revu et validé par un collaborateur. Cette revue peut occasionner plusieurs itérations entre "Review" et "In progress". Une fois revue, le tout peut être placé dans "Done" qui est un état volatile signifiant que le ticket, traité sous forme de PR, est prêt à être mergé. Le merge master s'occcupe alors de merger la PR à la milestone correspondante.

Ces sprints sont des micro itérations composant une milestone. Le planning de release des milestones est défini [ici](https://github.com/CDJE/Incipio/milestones).

### Règles

Afin de garder une certaine rigueur dans le process et d'éviter d'être submergé, les règles suivantes doivent être respectées :

* Tout ticket dans "Ready" doit comprendre les éléments suffisant pour commencer le développement ainsi que les critères d'appréciation et le temps de travail estimé.
* Le total de temps estimé pour un sprint ne doit pas excéder 15h.
* Le nombre maximum de tickets "In progress" doit être de 3.
* Le nombre maximum de tickets "Review" doit être de 2.
* Le nombre maximum de tickets "Done" doit être de 2.