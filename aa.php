<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <script>
        function generarArraysAleatorios(numeroFinal, oportunidades) {
            const numeroF = numeroFinal + 1;
            const maximo = numeroF * oportunidades;
            const final = maximo - 1;
            const todosLosNumeros = Array.from({
                length: maximo
            }, (_, i) => i);

            const todosLosNumerosPrimeros = Array.from({
                length: maximo
            }, (_, i) => i).slice(numeroF);


            const resultados = [];
            for (let i = 0; i <= numeroFinal; i++) {
                function convertirA2Digitos(numero, final) {
                    const longitudFinal = final.toString().length;
                    const longitud = numero.toString().length;
                    const ceros = '0'.repeat(longitudFinal - longitud);
                    return ceros + numero.toString();
                }

                let cs = convertirA2Digitos(numeroF, final);
                console.log(cs);
                const arrayTemporal = [];
                arrayTemporal.push(convertirA2Digitos(i, final)); // Aplicamos la función al índice actual

                for (let j = 0; j < oportunidades - 1; j++) {
                    const indiceAleatorio = Math.floor(Math.random() * todosLosNumerosPrimeros.length);
                    const numeroAleatorioFormateado = convertirA2Digitos(todosLosNumerosPrimeros[indiceAleatorio], final);
                    arrayTemporal.push(numeroAleatorioFormateado);
                    todosLosNumerosPrimeros.splice(indiceAleatorio, 1);
                }

                resultados.push(arrayTemporal);
            }
            return resultados;
        }

        const numeroFinal = parseInt(19999);
        const oportunidades = parseInt(5);
        const resultado = generarArraysAleatorios(numeroFinal, oportunidades);
        console.log(resultado);

        function tieneNumerosRepetidos(array) {
            const conjuntoNumeros = new Set(array);
            return array.length !== conjuntoNumeros.size;
        }

        // Validacion de numeros dentro del array
        const hayRepeticiones = resultado.some(array => tieneNumerosRepetidos(array));
        if (hayRepeticiones) {
            console.log("Hay números repetidos en los arrays.");

        } else {
            console.log("No hay números repetidos en los arrays.");
            /* 
                Codigo para subir los datos a la base de datos cada 9,999 Registros
                1. Avisar cada que se suban los registros
                2. Alerta final de que se subio todo
            */
        }

    </script>
</body>

</html>