// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
  };

// FUNCIÓN CALLBACK DE BOTÓN "Buscar"
function buscarProducto(e) {
    /**
     * Revisar la siguiente información para entender porqué usar event.preventDefault();
     * http://qbit.com.mx/blog/2013/01/07/la-diferencia-entre-return-false-preventdefault-y-stoppropagation-en-jquery/#:~:text=PreventDefault()%20se%20utiliza%20para,escuche%20a%20trav%C3%A9s%20del%20DOM
     * https://www.geeksforgeeks.org/when-to-use-preventdefault-vs-return-false-in-javascript/
     */
    e.preventDefault();

    // SE OBTIENE EL TERMINO A BUSCAR
    var busqueda = document.getElementById('busqueda').value;

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('POST', './backend/read.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            console.log('[CLIENTE]\n'+client.responseText);
            
            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            let productos = JSON.parse(client.responseText);    // similar a eval('('+client.responseText+')');
            
            // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
            if(Array.isArray(productos) && productos.length > 0) {
                // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                let template ='';
                productos.forEach(producto => {
                let descripcion = '';
                    descripcion += '<li>precio: '+producto.precio+'</li>';
                    descripcion += '<li>unidades: '+producto.unidades+'</li>';
                    descripcion += '<li>modelo: '+producto.modelo+'</li>';
                    descripcion += '<li>marca: '+producto.marca+'</li>';
                    descripcion += '<li>detalles: '+producto.detalles+'</li>';
                
                // SE CREA UNA PLANTILLA PARA CREAR LA(S) FILA(S) A INSERTAR EN EL DOCUMENTO HTML
                let template = '';
                    template += `
                        <tr>
                            <td>${producto.id}</td>
                            <td>${producto.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                        </tr>
                    `;
                })

                // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                document.getElementById("productos").innerHTML = template;
            } else {
                document.getElementById("productos").innerHTML = '<tr><td>No se encontraron productos.</td></tr>'
            }
        }
    };
    client.send("busqueda="+ busqueda);
}

// FUNCIÓN CALLBACK DE BOTÓN "Agregar Producto"
function agregarProducto(e) {
    e.preventDefault();

    //se valida el formulario antes de enviarse
    if (!validarFormulario()) {
        return;        
    }
    // SE OBTIENE DESDE EL FORMULARIO EL JSON A ENVIAR
    var productoJsonString = document.getElementById('description').value;
    // SE CONVIERTE EL JSON DE STRING A OBJETO
    var finalJSON = JSON.parse(productoJsonString);
    // SE AGREGA AL JSON EL NOMBRE DEL PRODUCTO
    finalJSON['nombre'] = document.getElementById('name').value;
    // SE OBTIENE EL STRING DEL JSON FINAL
    productoJsonString = JSON.stringify(finalJSON,null,2);

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('POST', './backend/create.php', true);
    client.setRequestHeader('Content-Type', "application/json;charset=UTF-8");
    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            console.log(client.responseText);
        }
    };
    client.send(productoJsonString);
}

//FUNCION PARA VALIDAR LOS CAMPOS DE LOS DETALLES DEL PRODUCTO
function validarFormulario() {
    const mensError = document.getElementById('mensError');
    mensError.innerHTML = '';

    const nombre = document.getElementById('name').value.trim();
    const descripcion = document.getElementById('description').value.trim();

    let errores = []; // Almacena los errores

    // Validar nombre del producto
    if (!nombre) {
        errores.push("El nombre del producto es necesario.");
    } else if (nombre.length > 100) {
        errores.push("El nombre del producto debe tener un máximo de 100 caracteres.");
    }

    // Validar que la descripción tenga contenido JSON válido
    if (descripcion === "") {
        errores.push("La descripción no puede estar vacía.");
    } else {
        try {
            // Convertimos el JSON de texto a objeto
            const datos = JSON.parse(descripcion);

            // Validamos que el JSON tenga las claves requeridas
            if (!("precio" in datos) || !("unidades" in datos) ||
                !("modelo" in datos) || !("marca" in datos) ||
                !("detalles" in datos) || !("imagen" in datos)) {
                errores.push("Faltan datos en el JSON.");
            }

            // Validaciones de los datos en el JSON
            if (!datos.marca) {
                errores.push("La marca es requerida.");
            }

            if (!datos.modelo) {
                errores.push("El modelo es necesario.");
            } else if (datos.modelo.length > 25) {
                errores.push("El modelo debe tener máximo 25 caracteres.");
            } else if (!/^[a-zA-Z0-9]+$/.test(datos.modelo)) {
                errores.push("El modelo debe ser alfanumérico.");
            }

            if (!datos.precio || isNaN(datos.precio) || datos.precio <= 99.99) {
                errores.push("El precio es requerido y debe ser mayor a 99.99.");
            }

            if (datos.detalles.length > 250) {
                errores.push("Los detalles, si se usan, deben tener un máximo de 250 caracteres.");
            }

            if (!datos.unidades || isNaN(datos.unidades) || datos.unidades < 0) {
                errores.push("Las unidades son requeridas y deben ser un número mayor o igual a 0.");
            }

            if (!datos.imagen) {
                errores.push("La imagen es opcional, pero si se proporciona, la ruta debe ser válida.");
            }
        } catch (error) {
            errores.push("El JSON no es válido.");
        }
    }

    if (errores.length > 0) {
        mensError.innerHTML = errores.join("<br>");
        return false;
    }

    return true;
}


// SE CREA EL OBJETO DE CONEXIÓN COMPATIBLE CON EL NAVEGADOR
function getXMLHttpRequest() {
    var objetoAjax;

    try{
        objetoAjax = new XMLHttpRequest();
    }catch(err1){
        /**
         * NOTA: Las siguientes formas de crear el objeto ya son obsoletas
         *       pero se comparten por motivos historico-académicos.
         */
        try{
            // IE7 y IE8
            objetoAjax = new ActiveXObject("Msxml2.XMLHTTP");
        }catch(err2){
            try{
                // IE5 y IE6
                objetoAjax = new ActiveXObject("Microsoft.XMLHTTP");
            }catch(err3){
                objetoAjax = false;
            }
        }
    }
    return objetoAjax;
}

function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;
}