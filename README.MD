# README

~~esta funcional pero faltan mas tipos de varajas~~

## rutas
- /login
- /singup

funciona con JWT para la sesion
### generar cartas
- [x] /varaja/gen/pokemon
- [x] /varaja/gen/pato
- [x] /varaja/gen/perro
- [x] /varajas/gen/RYM
- [x] /varajas/gen/anime

### consultar cartas de usuario
- [x] /varaja/user
- [x] varaja/user/{tipo} (pokemon, anime, RYM, pato y perro)

> el response de las varajas sera igual en todas

```json
{
"id":1,
"nombre":  "dito",
"imagen"  :  "url de la imagen",
"tipo":  "pokemon"
}
```
