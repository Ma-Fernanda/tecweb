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


