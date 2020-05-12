# agence_4h
agence imo

cloner le projet 
  -> cd agence_4h
  -> composer install (composer doit etre installer)
  # avant de créer la BDD modifier le fichier .env "port de de connexion à localhost"
  -> php bin/console doctrine:database:create #créer la BBD
  -> php bin/console doctrine:migration:migrate #créer les tables
  -> php bin/console doctrine:fixtures:load #créer des fausses informations
