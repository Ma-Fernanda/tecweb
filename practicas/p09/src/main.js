/*
function getDatos(){
    var nombre = prompt("Nombre: ", "");

    var edad = prompt("Edad: ", 0);

    var div1 = document.getElementById('nombre');
    div1.innerHTML = '<h3> Nombre: '+nombre+'</h3>';

    var div2 = document.getElementById('edad');
    div2.innerHTML = '<h3> Edad: '+edad+'</h3>';
}
*/
//Ejemplo 1
function holamundo(){
    document.getElementById('ejemplo1').innerText = 'Hola Mundo';
}

//Ejemplo 2
function datos() {
    var nombre = 'Juan';
    var edad = 10;
    var altura = 1.92;
    var casado = false;
    var div1 = document.getElementById('nombre1');
    div1.innerText = 'Nombre: '+ nombre ;
    var div2 = document.getElementById('edad1');
    div2.innerText = 'Edad: ' +  edad;
    var div3 = document.getElementById('altura');
    div3.innerText = 'Altura: ' +  altura;
    var div4 = document.getElementById('casado');
    div4.innerText = 'Casado: ' +  casado;
}

//Ejemplo 3
function entradaDatos(){
    var nombre = prompt("Ingresa tu nombre: ","");
    var edad = prompt("Ingresa tu edad: ","");

    var div1 = document.getElementById('edad2');
    div1.innerHTML = '<h3>Hola ' + nombre + ' asi que tienes ' + edad + ' años </h3>';
}

//Ejemplo 4
function entradaNum(){
    var valor1 = prompt("Introducir el primer número: ", "");
    var valor2 = prompt("Introducir el segundo número: ", "");
    var suma = parseInt(valor1) + parseInt(valor2);
    var producto = parseInt(valor1) * parseInt(valor2);

    var div1 = document.getElementById('suma');
    var div2 = document.getElementById('producto');
    div1.innerHTML = '<h3>La suma es ' + suma + '</h3>';
    div2.innerHTML = '<h3>El producto es ' + producto + '</h3>';
}

//Ejemplo 5
function califAlumno(){
    var nombre = prompt("Ingresa tu nombre: ", "");
    var nota = prompt("Ingresa tu nota: ", "");

    if(nota >= 4){
        var div1 = document.getElementById('nota');
        div1.innerHTML = '<h3>' + nombre + ' esta aprobado con un ' + nota + '</h3>';
    }
}

//Ejemplo 6
function numMayor(){
    var num1 = prompt("Ingresa el primer número: ", "");
    var num2 = prompt("Ingresa el segundo número: ", "");
    num1 = parseInt(num1);
    num2 = parseInt(num2);

    if(num1>num2){
        var div1 = document.getElementById('mayor');
        div1.innerHTML = '<h3>El mayor es ' + num1 + '</h3>';
    } else {
        var div2 = document.getElementById('menor');
        div2.innerHTML = '<h3>El mayor es ' + num2 + '</h3>';
    }
}

//Ejemplo 7
function promAlumno(){
    var nota1 = prompt("Ingresa 1ra. nota: ", "");
    var nota2 = prompt("Ingresa 2da. nota: ", "");
    var nota3 = prompt("Ingresa 3ra. nota: ", "");
    var promedio = (parseInt(nota1) + parseInt(nota2) + parseInt(nota3))/3;

    if(promedio >=7) {
        var div1 = document.getElementById('aprobado');
        div1.innerHTML = '<h3> Aprobado </h3>';
    } else {
        if (promedio >= 4) {
        var div2 = document.getElementById('regular');
        div2.innerHTML = '<h3> Regular </h3>';
        } else {
        var div3 = document.getElementById('reprobado');
        div3.innerHTML = '<h3> Reprobado </h3>';
        }
    }
}

//Ejemplo 8
function valNum(){
    var valor = prompt("Ingresar un valor comprendido entre 1 y 5:", "");
    valor = parseInt(valor);
    switch (valor) {
        case 1: 
            var div1= document.getElementById('uno');
            div1.innerHTML = '<h3> uno </h3>';
            break;
        case 2: 
            var div2= document.getElementById('dos');
            div2.innerHTML = '<h3> dos </h3>';
            break;
        case 3: 
            var div3= document.getElementById('tres');
            div3.innerHTML = '<h3> tres </h3>';
            break;
        case 4: 
            var div4= document.getElementById('cuatro');
            div4.innerHTML = '<h3> cuatro </h3>';
            break;
        case 5: 
            var div5= document.getElementById('cinco');
            div5.innerHTML = '<h3> cinco </h3>';
            break;
        default: 
            var div6= document.getElementById('error');
            div6.innerText = 'Debe ingresar un valor comprendido entre 1 y 5 porfavor intente de nuevo.';
    }
}

//Ejemplo 9
function colores() {
    var col = prompt("Ingresa el color con el que quieras pintar el dondo de la ventana (rojo, verde, azul)", "");

    switch(col) {
        case 'rojo':
            document.body.style.backgroundColor = '#ff0000'; 
            break;
        case 'verde':
            document.body.style.backgroundColor = '#00ff00'; 
            break;
        case 'azul':
            document.body.style.backgroundColor = '#0000ff'; 
            break;
    }
}

//Ejemplo 10
function cadenaNum(){
    var x = 1;
    var resultado;
    resultado +=x + '<br>';

    while (x <= 100) {
        resultado +=x + '<br>';
        x = x + 1;
        document.getElementById('ejemplo10').innerHTML = resultado;
    }
}
