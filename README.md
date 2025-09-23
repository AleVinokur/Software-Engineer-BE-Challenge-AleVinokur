# Challenge Técnico Backend - COR

¡Hola! Gracias por tu interés en formar parte de nuestro equipo.

Este challenge está diseñado para darnos una idea de tus habilidades para resolver problemas, tu estilo de codificación y tu enfoque arquitectónico. No buscamos una única "respuesta correcta", sino entender tu proceso de pensamiento.

¡Mucha suerte!

---

## El Desafío: La Cadena de Palabras Circular

Tu tarea es implementar una función o método que, dada una lista de palabras, encuentre un ordenamiento que permita formar un círculo y lo devuelva como resultado.

Una lista de palabras forma un círculo si la última letra de cada palabra es igual a la primera letra de la siguiente, y la última letra de la última palabra es igual a la primera letra de la primera palabra. Cada palabra debe usarse exactamente una vez.

**Input:** Un archivo `.txt` que contenga una lista de palabras (una palabra por línea).

**Output:** Un archivo `.txt` que contenga la secuencia de palabras que forman el círculo, con **una palabra por línea**. Si no es posible formar un círculo, el archivo de salida debe estar vacío.

### Ejemplo:

**Archivo de entrada (`input.txt`):**
```
chair
height
racket
touch
tunic
```

**Archivo de salida (`output.txt`):**
```
chair
racket
touch
height
tunic
```
*(Nota: Cualquier orden circular válido es una respuesta correcta)*

**Archivo de entrada (`input.txt`):**
```
apple
banana
```

**Archivo de salida (`output.txt`):** *(archivo vacío)*

---

## Requerimientos

### Funcionales
- La solución debe leer las palabras desde un archivo `.txt` de entrada.
- La solución debe escribir el resultado en un archivo `.txt` de salida.
- Si no existe una solución, el archivo de salida debe estar vacío.

### No Funcionales

- **Lenguaje:** Puedes resolver el challenge en **Node.js (JavaScript/TypeScript), PHP o Python**.

---


## Entregables

1.  El código fuente de tu solución.
2.  Un archivo `README.md` (puedes modificar este mismo) con:
    -   Una breve explicación de tu enfoque y las decisiones que tomaste.
    -   Instrucciones claras sobre cómo instalar dependencias y ejecutar la solución y las pruebas.

Por favor, comparte tu solución subiéndola a un repositorio de Git y envíanos el enlace.

---

## Aclaraciones
-   Si existe más de un círculo posible, devolver cualquiera de ellos es correcto.
-   Asume que todas las palabras vendrán en minúsculas y no habrá strings vacíos en la lista.

Si tienes alguna pregunta, no dudes en contactarnos.

**¡Estamos ansiosos por ver tu solución!**