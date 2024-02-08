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

##### Next

[Cap 11](https://symfonycasts.com/es/screencast/phpunit/mocking-stubs#play)