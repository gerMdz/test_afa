Comando interesantes
--------------------

* Ejecutar test con descripción y resultado de los métodos

```bash
./vendor/bin/phpunit --testdox
```

* Ejecutar help para ver las opciones

```bash
./vendor/bin/phpunit --help
```

### Paso 1

* Escribe la prueba

### Paso 2

* Ejecuta la prueba

### Paso 3

* Escribir el código

### Paso 4

* Ejecuta nuevamente la prueba

### Paso 5

* Aclarar y repetir

> TDD le permite pensar en lo que necesita construir, antes de comenzar a codificarlo.
> Construimos hasta que las pruebas pasen (Den OK)
> Una vez terminadas las pruebas se puede refactorizar tranquilo, las pruebas nos dirán si sigue funcionando todo bien

######   

Finalmente, como mencioné, los métodos del simulacro están todos vacíos. Sin embargo, para evitar errores de PHP,
PHPUnit necesita "respetar" el tipo de retorno de los métodos. Debido a que getProgressTowardsHatching() devuelve un
int, la clase simulada de PHPUnit devolverá 0, no nulo. Devolver nulo provocaría un error de tipo. Si el tipo de retorno
fuera una matriz, PHPUnit devolvería un [] vacío. Y si el tipo de retorno fuera otra clase o interfaz, PHPUnit
devolvería automáticamente una simulación de esa clase/interfaz. En realidad, eso es lo que está sucediendo en nuestro
código: PHPUnit devuelve un objeto simulado ResponseInterface cuando llamamos a $httpClient->request(). ¡Muy
inteligente!

A) Tanto los mocks como los stubs son tipos de pruebas dobles. Pruebas dobles es sólo una palabra para
describir clases que "sustituyen" a las versiones reales.

B) Los mocks son pruebas dobles en las que afirmamos cómo se utiliza el objeto. En PHPUnit, cuando usa ->
expects() (para afirmar el número de veces que se llama a un método) o ->with() (para afirmar los argumentos utilizados
al llamar al método), su prueba doble es un "mock".

C) Los stubs son pruebas dobles donde controlamos el valor de retorno de los métodos.

Algunos frameworks de testing hacen una mayor distinción entre stubs y mocks. Pero en PHPUnit, en realidad describen la
misma idea.

##### Next

[Cap 3](https://symfonycasts.com/es/screencast/phpunit/real-test)

Está completo, pero no tomó la clase 3