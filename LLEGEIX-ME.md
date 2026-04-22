# Custom Head and Body Content per a l'Omeka S

CustomHeadBodyContent és un mòdul per a l'Omeka S que permet afegir codi HTML, CSS o JS a les seccions `head` i `body` del lloc web.

## Què fa

Afegeix una pantalla de configuració a **Mòduls → Custom Head and Body Content → Configure** amb dos camps:

- **Contingut personalitzat del `<head>`**: s'injecta a les pàgines HTML públiques immediatament abans de `</head>`.
- **Contingut personalitzat del cos**: s'injecta a les pàgines HTML públiques immediatament abans de `</body>`.

Alguns usos habituals són:

- fragments de codi d'analítica o de gestors d'etiquetes
- metaetiquetes de verificació
- fulls d'estil o scripts externs
- CSS o JavaScript en línia personalitzats

## Instal·lació

1. Reanomena i copia la carpeta a `modules/CustomHeadBodyContent` dins de la teua instal·lació d'Omeka S.
2. Assegura't que la carpeta conté `Module.php` i `config/module.ini`.
3. Instal·la el mòdul des de la interfície d'administració d’Omeka S.
4. Obri **Configure**, enganxa-hi el marcatge personalitzat i guarda els canvis.

## Notes

- El mòdul desa la configuració en els ajustos globals d'Omeka.
- El codi només s'injecta en respostes HTML fora de les rutes d'administració i de l'API.
- El marcatge configurat es mostra **sense escapament**, per disseny, així que només l'haurien d'utilitzar administradors de confiança.
