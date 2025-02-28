<!DOCTYPE html >
<html lang="es">
  <head>
    <meta charset="utf-8" >
    <title>Formulario de Productos</title>
    <style>
      .error {
        color: red;
        font-weight: bold;
      }
    </style>
    <script>
            
    function validarFormulario() {
        const mensError = document.getElementById('mensError');
        mensError.innerHTML = '';
        const nombre = document.getElementById('form-name').value;
        const marca = document.getElementById('form-marca').value;
        const modelo = document.getElementById('form-model').value;
        const precio = document.getElementById('form-precio').value;
        const details = document.getElementById('form-details').value;
        const unidades = document.getElementById('form-unidades').value;
        const imagen = document.getElementById('form-img').value;
        /*if (!nombre || !marca || !modelo || !precio || !details || !unidades || !imagen) {
            alert("Todos los campos son obligatorios.");
            return false;
        }

        if (isNaN(precio) || isNaN(unidades)) {
            alert("El precio y las unidades deben ser números.");
            return false;
        }*/

         if(!nombre){
          mensError.innerHTML = "El nombre del producto es necesario. <br>";
          return false;
         } else if (nombre.length > 100){
          mensError.innerHTML = "El nombre del producto debe tener un máximo de 100 caracteres <br>";
          return false;
        }
        
        if(!marca){
          mensError.innerHTML += "La marca es requerida. <br>";
          return false;
        }

        if(!modelo) {
          mensError.innerHTML += "El modelo es necesario. <br>";
          return false;
        } else if (modelo.length > 25){
          mensError.innerHTML += "El modelo debe tener máximo 25 caracteres. <br>";
          return false;
        } else if (!/^[a-zA-Z0-9]+$/.test(modelo)) { 
        mensError.innerHTML += "El modelo debe ser alfanumérico.<br>";
        return false;
        }
        
        if (!precio || isNaN(precio) || precio <= 99.99) {
          mensError.innerHTML += "El precio es requerido y debe ser mayor a 99.99.";
          return false;
        }

        if (details.length > 250) {
          mensError.innerHTML += "Los detalles, si se usan, deben tener un máximo de 250 caracteres.";
          return false;
        }

        if (!unidades || isNaN(unidades) || unidades < 0) {
          mensError.innerHTML += "Las unidades son requeridas y deben ser un número mayor o igual a 0.";
          return false;
        }

        if (imagen && !/\.(jpg|jpeg|png|gif)$/i.test(imagen)) {
          mensError.innerHTML += "La imagen es opcional, pero si se proporciona, la ruta debe ser válida.";
          return false;
        }
        
        return true;
        }
    </script>
  </head>
  <body>
    <h1>Editar Producto</h1>
    <div id="mensError" class="error"></div>
    <form id="formularioProductos" action="update_producto.php" method="post" onsubmit="return validarFormulario();">
    <fieldset>
        <legend>Actualiza la Información del Producto</legend>
        <ul>
            <li><label for="form-name">Nombre:</label> <input type="text" name="name" value="<?= !empty($_POST['nombre'])?$_POST['nombre']:$_GET['nombre'] ?>"></li>
            <li><label for="form-marca">Marca:</label> <input type="text" name="marca" value="<?= !empty($_POST['marca'])?$_POST['marca']:$_GET['marca'] ?>"></li>
            <li><label for="form-model">Modelo:</label> <input type="text" name="modelo" value="<?= !empty($_POST['modelo'])?$_POST['modelo']:$_GET['modelo'] ?>"></li>
            <li><label for="form-precio">Precio:</label> <input type="number" name="precio" value="<?= !empty($_POST['precio'])?$_POST['precio']:$_GET['precio'] ?>"></li>
            <li><label for="form-details">Detalles:</label> <input type="text" name="details" value="<?= !empty($_POST['details'])?$_POST['details']:$_GET['details'] ?>"></li>
            <li><label for="form-unidades">Unidades:</label> <input type="number" name="unidades" value="<?= !empty($_POST['unidades'])?$_POST['unidades']:$_GET['unidades'] ?>"></li>
            <li><label for="form-img">Imagen:</label> <input type="text" name="imagen" value="<?= !empty($_POST['imagen'])?$_POST['imagen']:$_GET['imagen'] ?>"></li>    
         </ul>
    </fieldset>
    <p>
        <input type="submit" value="Actualizar Producto">
        </p>
    </form>
  </body>
</html>