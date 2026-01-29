Insurance Calculator - Interview Task

Gyorsindítás (Docker)

A projekt teljes körűen konténerizált, tartalmazza a PHP 8.3-at és a Composert.
Konténerek indítása:
```bash
    docker-compose up -d
```

Alkalmazás futtatása:
```bash
  docker-compose exec app php run.php
```

Makefile szerepe

A projekt gyökerében található egy Makefile, amely egyszerűsíti a fejlesztési munkafolyamatokat. 
Nem kell megjegyezni a hosszú vendor elérési utakat, elég egy-egy rövid parancs.

    make fix: Lefuttatja a PHP-CS-Fixer-t, ami automatikusan javítja a kódformázási hibákat és kényszeríti a strict_types használatát.

    make stan: Lefuttatja a PHPStan elemzőt a legszigorúbb (9) szinten.

    make test: Elindítja a PHPUnit teszteket.

    make: (Alapértelmezett parancs) Lefuttatja az összes fenti ellenőrzést egymás után.

Tesztelés

A tesztek a tests/ mappában találhatóak. A kalkulátor logikáját elszigetelten, interfészek mockolásával teszteltem, így a tesztek nem függenek a konkrét implementációktól.

A tesztek futtatása a konténerből:
```bash
    docker-compose exec app make test
```
