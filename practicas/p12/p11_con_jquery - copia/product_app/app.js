function init() {
   // Función para verificar si el nombre ya existe en la base de datos
   $('#name').keyup(function() {
    const nombreProducto = $(this).val().trim();
    if (nombreProducto.length > 0) {
        $.ajax({
            url: './backend/product-validate-name.php',  
            type: 'GET',
            data: { nombre : nombreProducto }, 
            dataType: 'json', 
            success: function(response) {
                console.log(response);
                if (response.exists) {
                    $('#name-error').show().text(`El producto "${response.productName}" ya existe en la base de datos.`);
                    window.status = `El producto "${response.productName}" ya existe en la base de datos.`;
                } else {
                    $('#name-error').hide();
                    $('#name-error').show().text(`El producto aun no existe en la base de datos.`);
                    window.status =`El producto aun no existe en la base de datos.`;
                }
            },
            error: function() {
                console.error("Error en AJAX", error);
                $('#name-error').hide();
            }
        });
    } else {
        $('#name-error').hide(); 
    }
});



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
    $('button.btn-primary').text("Modificar Producto");
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr('productId');
    $.post('./backend/product-single.php', {id}, function(response){
        const producto = JSON.parse(response);
        $('#name').val(producto.name);
        $('#marca').val(producto.marca);
        $('#modelo').val(producto.modelo);
        $('#precio').val(producto.precio);
        $('#descripcion').val(producto.descripcion);
        $('#unidades').val(producto.unidades);
        $('#img').val(producto.imagen);
        $('#productId').val(producto.id);
        editar = true;
    });
});


$('#product-form').submit(function agregarProducto(e){
    e.preventDefault();
    let valido = true;
        let errores = [];
        $('#product-form input, #product-form textarea').each(function() {
        if (!validarCampo($(this))) {
            valido = false;
            errores.push("Hay campos sin rellenar.");
        }
    });

    if (!valido){
        let barraEstado = $('#product-result');
        barraEstado.show().html(`<ul>${errores.map(e => `<li>${e}</li>`).join('')}</ul>`);
        return;
    }


    let url = editar === false ? './backend/product-add.php' : './backend/product-edit.php';
    console.log(url);
    $.post(url,JSON.stringify(postData), function(response){
        console.log(response);
        alert(response.message);
        listarProductos();
        $('#productId').val(''); 
        $('#name').val(''); 
        editar = false;
        $('button.btn-primary').text("Agregar Producto");
    }, 'json');
    });
    
    $('input, textarea').on('blur', function() {
        validarCampo($(this));
    });

    function validarCampo(input){

        let errores = [];
        let id = input.attr('id'); 
        let valor = input.val().trim(); 

        if (id === "name") {
            if (!valor) errores.push("El nombre del producto es necesario.");
            else if (valor.length > 100) errores.push("El nombre debe tener un máximo de 100 caracteres.");
        }

        if (id === "marca") {
            if (!valor) errores.push("La marca es requerida.");
        }

        if (id === "modelo") {
            if (!valor) errores.push("El modelo es necesario.");
            else if (valor.length > 25) errores.push("El modelo debe tener un máximo de 25 caracteres.");
            else if (!/^[a-zA-Z0-9]+$/.test(valor)) errores.push("El modelo debe ser alfanumérico.");
        }

        if (id === "precio") {
            if (!valor || isNaN(valor) || parseFloat(valor) <= 99.99) {
                errores.push("El precio es requerido y debe ser mayor a 99.99.");
            }
        }

        if (id === "unidades") {
            if (!valor || isNaN(valor) || parseInt(valor) < 0) {
                errores.push("Las unidades son requeridas y deben ser un número mayor o igual a 0.");
            }
        }

        if (id === "descripcion") {
            if (valor.length > 250) errores.push("La descripción debe tener un máximo de 250 caracteres.");
        }

        let barraEstado = $('#product-result');
        if (errores.length > 0) {
            barraEstado.show().html(`<ul>${errores.map(e => `<li>${e}</li>`).join('')}</ul>`);
            return false;
        } else {
            barraEstado.hide();
            return true;
        }
    };


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






