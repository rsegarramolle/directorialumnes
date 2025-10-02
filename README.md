# Directori d'Alumnes de l'INS Mollerussa

Aplicació web PHP per gestionar un directori d'alumnes de l'INS Mollerussa. L'aplicació permet visualitzar els alumnes amb les seves dades acadèmiques i inclou funcionalitat de cerca avançada.

## Característiques

- **Disseny modern i responsive**: Interfície atractiva i optimitzada per a dispositius mòbils
- **Cerca en temps real**: Filtra alumnes per nom, cognoms, email, estudi o curs
- **Colors corporatius**: Disseny amb els colors de l'INS Mollerussa (verd, negre, blanc)
- **Sense base de dades**: Utilitza fitxers JSON per emmagatzemar les dades
- **PHP pur**: No utilitza frameworks externs
- **Informació acadèmica**: Mostra estudi i curs de cada alumne

## Estructura del projecte

```
directorialumnes/
├── src/               # Codi font de l'aplicació
│   ├── index.php      # Pàgina principal
│   ├── styles.css     # Estils CSS
│   └── alumnes/        # Directori amb fitxers JSON dels alumnes
│       ├── anna_garcia.json
│       ├── carles_rodriguez.json
│       ├── maria_fernandez.json
│       ├── jordi_martinez.json
│       ├── laura_jimenez.json
│       └── albert_vidal.json
├── docker/            # Configuració Docker
│   └── Dockerfile     # Imatge personalitzada
├── docker-compose.yml # Configuració del contenidor
├── .dockerignore     # Fitxers ignorats per Docker
└── README.md
```

## Estructura dels fitxers JSON

Cada fitxer JSON d'alumne ha de tenir la següent estructura:

```json
{
    "nom": "Nom de l'alumne",
    "cognoms": "Cognoms de l'alumne",
    "email": "email@insmollerussa.cat",
    "estudi": "Tipus d'estudi",
    "curs": "Curs acadèmic"
}
```

### Camps obligatoris:
- `nom`: Nom de l'alumne
- `cognoms`: Cognoms de l'alumne  
- `email`: Adreça de correu electrònic (domini @insmollerussa.cat)
- `estudi`: Tipus d'estudi (Batxillerat, Cicles Formatius, etc.)
- `curs`: Curs acadèmic (1r BAT, 2n CFGS, etc.)

## Instal·lació i ús

### Opció 1: Amb Docker (Recomanat)

1. **Requisits**: Docker i Docker Compose instal·lats

2. **Executar l'aplicació**:
   ```bash
   # Construir i executar el contenidor
   docker-compose up --build
   
   # O en segon pla
   docker-compose up -d --build
   ```

3. **Accedir a l'aplicació**:
   - Obre el navegador a `http://localhost:5050`
   - L'aplicació estarà disponible al port 5050

4. **Aturar l'aplicació**:
   ```bash
   docker-compose down
   ```

### Opció 2: Instal·lació tradicional

1. **Requisits**: Servidor web amb PHP (Apache, Nginx, etc.)

2. **Configuració**:
   - Copia el contingut del directori `src/` al servidor web
   - Assegura't que el directori `alumnes/` tingui permisos de lectura

3. **Afegir alumnes**:
   - Crea un nou fitxer JSON al directori `alumnes/`
   - Segueix l'estructura indicada més amunt
   - L'alumne apareixerà automàticament a la llista

4. **Utilització**:
   - Obre `index.php` al navegador
   - Utilitza el cercador per filtrar alumnes
   - La cerca funciona per nom, cognoms, email, estudi o curs

## Funcionalitats

### Cerca avançada
- Cerca en temps real mentre escrius
- Filtra per nom, cognoms, email, estudi o curs
- No distingeix majúscules i minúscules
- Mostra missatge quan no hi ha resultats

### Disseny corporatiu
- **Mobile First**: Optimitzat per a dispositius mòbils
- **Responsive**: S'adapta a qualsevol mida de pantalla
- **Colors corporatius**: Verd, negre i blanc de l'INS Mollerussa
- **Modern**: Interfície atractiva amb animacions
- **Accessible**: Fàcil d'utilitzar i navegar

### Informació acadèmica
- Mostra estudi i curs de cada alumne
- Etiquetes colorides per diferenciar tipus d'estudi
- Informació clara i organitzada

## Exemple d'ús

Per afegir un nou alumne, crea un fitxer com `nou_alumne.json`:

```json
{
    "nom": "Pere",
    "cognoms": "Garcia Lopez",
    "email": "pere.garcia@insmollerussa.cat",
    "estudi": "Batxillerat Científic",
    "curs": "1r BAT"
}
```

L'alumne apareixerà automàticament a la llista principal.

## Personalització

Pots modificar els estils editant `styles.css` per adaptar l'aparença a les teves necessitats:

- **Colors corporatius**: Modifica els colors verd, negre i blanc
- **Tipografia**: Canvia les fonts i mides
- **Layout**: Ajusta el grid i les mides de les targetes
- **Animacions**: Personalitza les transicions i efectes
- **Etiquetes**: Modifica l'aparença dels camps estudi i curs

## Desenvolupament

### Comandos Docker útils

```bash
# Veure logs del contenidor
docker-compose logs -f

# Entrar al contenidor
docker-compose exec directorialumnes bash

# Reconstruir la imatge
docker-compose build --no-cache

# Netejar contenidors i imatges
docker-compose down --rmi all
```

### Estructura del contenidor

- **Imatge base**: PHP 8.2 amb Apache
- **Port**: 5050 (mapejat al port 80 del contenidor)
- **Volum**: `./src` mapejat a `/var/www/html`
- **Extensions PHP**: PDO, PDO_MySQL
- **Mòduls Apache**: mod_rewrite habilitat

## Compatibilitat

- **Navegadors**: Chrome, Firefox, Safari, Edge (versions modernes)
- **Dispositius**: Mòbils, tauletes, escriptori
- **PHP**: Versió 8.2 (al contenidor)
- **Docker**: Versió 20.10 o superior
- **Docker Compose**: Versió 2.0 o superior

