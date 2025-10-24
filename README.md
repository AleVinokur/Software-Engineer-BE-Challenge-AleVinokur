# Cadena de Palabras Circular

Resolver el problema como si fuese un dominó de palabras: cada palabra debe “encastrar” con la siguiente (última letra = primera letra), y la última debe volver a la primera para **cerrar el círculo**. Si no hay forma, el resultado es un archivo vacío.

---

## Enfoque y decisiones

- **Mapeo rápido de letras.**  
  Primero leo/limpio las palabras del archivo y, por cada una, guardo su **primera** y **última** letra (usando funciones multibyte para UTF-8). Así sé enseguida qué palabra puede seguir a otra.

- **Barrido greedy con dos punteros (`i`, `k`).**  
  `i` marca la palabra actual; `k` busca hacia adelante una que **empiece** con la letra que necesito (la última de `i`). Cuando la encuentro, la acerco **in-place** (por ejemplo con `array_splice`) para evitar estructuras intermedias y mantener el resto del orden estable. Sigo avanzando.

- **Rotaciones para evitar sesgo del orden inicial.**  
  Si ese punto de partida no funciona, **roto** la lista (muevo la primera al final) y repito. Pruebo diferentes comienzos hasta que se arma el círculo o se descartan todas las rotaciones.

- **Verificación de cierre.**  
  Antes de devolver el resultado confirmo que la **última** palabra también conecte con la **primera**; si no, paso a la siguiente rotación disponible.

### Complejidad
- **Tiempo:** O(n²) en el peor caso (barrido + reubicaciones).  
- **Memoria:** O(n) (arreglos paralelos; sin estructuras adicionales pesadas).

> **Nota:** Entiendo que es enfoque prioriza simplicidad y costo. Para casos con un gran número de palabras entiendo que podría usarse un modelo de grafo para garantizar solución cuando existe. Se que existen algoritmos más eficientes para resolver este problema.

---

## Requisitos
- Docker
- Docker Compose

## Puesta en marcha
1. Construí y levantá el servicio:
   ```bash
   docker-compose up --build -d
   ```
2. Ingresá al contenedor:
   ```bash
   docker exec -it circular-word-chain sh
   ```
3. Ejecutá la aplicación desde el contenedor:
   ```bash
   php run.php
   ```
   - Sin argumentos usa `/app/input.txt` y escribe en `/app/output.txt`.

   Opcionalmente puedes especificar la ruta del archivo de entrada y salida: 
   ```bash
   php run.php [ruta_input] [ruta_output]
   ```
4. Editá `input.txt` para probar nuevas combinaciones; el volumen está montado y podés relanzar `php run.php` desde el contenedor cuando quieras.

## Notas adicionales
- La lógica del círculo está en `src/CircularWordChain.php`; `src/FileHandler.php` gestiona lectura y escritura de archivos.
