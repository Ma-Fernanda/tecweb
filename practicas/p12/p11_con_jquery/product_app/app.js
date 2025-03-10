// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
  };

function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;

    // SE LISTAN TODOS LOS PRODUCTOS
    listarProductos();
}

$(function buscarProducto(){
    $('#product-result').hide();
    $('#search').keyup(function(){
        if ($('#search').val()) {
        let search = $('#search').val();
        $.ajax({
           url: './backend/product-search.php',
           type: 'GET',
           data: {search},
           success: function(response) {
            let productos = JSON.parse(response);
            let productsList = '<ul>';
            productos.forEach(producto => {
                productsList += `<li>${producto.nombre}</li>`;            
            });    
            productsList += '</ul>';
            $('#container').html(productos.length > 0 ? productsList : "No hay productos que coincidan con la busqueda.");
            let template = '';
            productos.forEach(producto => {
                let descripcion = '';
                    descripcion += '<li>precio: '+producto.precio+'</li>';
                    descripcion += '<li>unidades: '+producto.unidades+'</li>';
                    descripcion += '<li>modelo: '+producto.modelo+'</li>';
                    descripcion += '<li>marca: '+producto.marca+'</li>';
                    descripcion += '<li>detalles: '+producto.detalles+'</li>';
            template += `
            <tr productId="${producto.id}">
            <td>${producto.id}</td>
            <td>${producto.nombre}</td>
            <td><ul>${descripcion}</ul></td>
            <td>
                <button class="product-delete btn btn-danger" data-id="${producto.id}">
                    Eliminar
                </button>
            </td>
            </tr>`;
            });
        $('#products').empty().html(template);
        $('#product-result').show();
        return;
        } 
        })
    }
    })
});
let editar = false;
$(document).on('click','.product-item', function(){
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr('productId');
    $.post('./backend/product-single.php', {id}, function(response){
        const producto = JSON.parse(response);
        $('#name').val(producto.name);
        $('#description').val(JSON.stringify({
            precio: producto.precio,
            unidades: producto.unidades,
            modelo: producto.modelo,
            marca: producto.marca,
            detalles: producto.detalles,
            imagen: producto.imagen   
        }, null, 2));
        $('#productId').val(producto.id);
        editar = true;
    });
});


$('#product-form').submit(function agregarProducto(e){
    e.preventDefault();
    if(!validarFormulario()){
        return;
    }

    const description = JSON.parse($('#description').val());
    const postData = {
        id: $('#productId').val(),
        nombre: $('#name').val(),
        marca: description.marca,
        modelo: description.modelo,
        precio: description.precio,
        detalles: description.detalles,
        unidades: description.unidades,
        imagen: description.imagen
    };

    let url = editar === false ? './backend/product-add.php' : './backend/product-edit.php';
    console.log(url);
    $.post(url,JSON.stringify(postData), function(response){
        console.log(response);
        alert(response.message);
        listarProductos();
        $('#productId').val(''); 
        $('#name').val(''); 
        $('#description').val(JSON.stringify(baseJSON, null, 2));
        editar = false;
    }, 'json');
    });
    
function validarFormulario() {
    const nombre = $('#name').val().trim();
    const descripcion = $('#description').val().trim();
    
    let errores = []; 

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
            console.error("Error al parsear JSON:", error);
            errores.push("El JSON no es válido.");
        }
    }

    if (errores.length > 0) {
        alert(errores.join("\n"));
        return false;
    }

    return true;
}

function listarProductos(){
$.ajax({
    url: './backend/product-list.php',
    type: 'GET',
    dataType: 'json',
    success: function(response){
        let template = '';
           response.forEach(producto => {
            let descripcion = `
                    <li>precio: ${producto.precio} </li>
                    <li>unidades: ${producto.unidades}</li>
                    <li>modelo: ${producto.modelo}</li>
                    <li>marca: ${producto.marca}</li>
                    <li>detalles: ${producto.detalles} </li>
            `;
            template += `
            <tr productId="${producto.id}">
            <td>${producto.id}</td>
            <td>
                <a href="#" class="product-item">${producto.nombre}</a>
            </td>
            <td><ul>${descripcion}</ul></td>
            <td>
                <button class="product-delete btn btn-danger" data-id="${producto.id}">
                    Eliminar
                </button>
            </td>
            </tr>`;
        });   
        $('#products').html(template);
    }      
});
}

//elimina productos
$(document).on('click','.product-delete', function(){
    if (confirm('¿Esta seguro de querer eliminar este producto?')){
        let element = $(this)[0].parentElement.parentElement;
        let id = $(element).attr('productId');
        $.get('./backend/product-delete.php', {id}, function(response){
            listarProductos();
        });
    } 
});






