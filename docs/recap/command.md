# Les commandes personnalisées

## Maker Command

On peut créer des commandes personnalisées dans Symfony en faisant `php bin/console make:command`

Cela va créer : 

- un dossier `src/Command` s'il n'existe pas encore
- Et une classe portant le nom de notre commande

Faire une commande permet : 

- De lancer des actions en ligne de commande : on pourra ensuite les automatiser
- de se faire des raccourcis sur des tâches à effectuer

:warning: Pour utiliser une commande avec un constructeur, il faut penser à initialiser le constructeur de la classe parente `Command` avec : 

```php
parent::__construct();
```

Ensuite,on peut directement executer le code à l'intérieur de cette classe avec une commande dans le terminal :

```bash
   php bin/console ma:commande:custom
```

## Options et Arguments

Les arguments et les options sont à configurer dans la méthode `configure`

```php
$this
->addArgument('tvshowId', InputArgument::OPTIONAL, 'Identifiant de la série')
->addOption('titi', null, InputOption::VALUE_NONE, 'Option description');

# Ici l'argument prend la valeur 2 et l'option est titi
$ php bin/console ma:commande:custom 2 --titi
```

## Execute

C'est dans cette méthode que l'on écrira la logique métier de la commande personnalisée. Si besoin, vous pouvez injecter des services (repository, manager, ...) depuis le constructeur.

```php
private $tvShowRepository;
private $omdbApi;
private $entityManager;
public function __construct(TvShowRepository $tvShowRepository, OmdbApi $omdbApi, EntityManagerInterface $entityManager)
{
    // Symfony a besoin de faire des vérification avant execution de la commande
    parent::__construct();
    $this->tvShowRepository = $tvShowRepository;
    $this->omdbApi = $omdbApi;
    $this->entityManager = $entityManager;
}
```
