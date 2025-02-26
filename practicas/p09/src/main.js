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



