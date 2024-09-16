//Selectores
const body = document.querySelector('body');
let dar = 'no';
//Eventos
document.addEventListener('DOMContentLoaded', ()=>{
    const alerta = document.querySelector('.exito');
    if(alerta){
        setTimeout(() => {
            alerta.remove();
        }, 5000);
    }
    if(localStorage.getItem('dark-mode') === 'si'){
        body.classList.add('dark-mode');
    }

    eventListeners();
});

function eventListeners(){
    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click', mostrarMenu);

    const dark = document.querySelector('.dark');
    dark.addEventListener('click', darkMode);

    const metodosContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    metodosContacto.forEach(inputContacto => inputContacto.addEventListener('click', mostrarCampos));

    const nombreInput = document.querySelector("#nombre");
    const mensajeInput = document.querySelector("#mensaje");
    const precioInput = document.querySelector("#precio");
    const seleccionarInput = document.querySelector("#opciones");

    if(nombreInput && mensajeInput && precioInput && seleccionarInput){
        nombreInput.addEventListener("blur", validarFormulario);
        mensajeInput.addEventListener("blur", validarFormulario);
        precioInput.addEventListener("blur", validarFormulario);
        seleccionarInput.addEventListener("input", validarFormulario);
    }

    
}
const contacto = {
    nombre: "",
    mensaje: "",
    precio: "",
    tipo: ""
}
const btnEnviar = document.querySelector("#enviar");


//Funciones
function mostrarMenu(){
    const nav = document.querySelector('.navegacion');
    if(nav.classList.contains('nav-aparecer')){
        nav.classList.remove('nav-aparecer');
    }else{
        nav.classList.add('nav-aparecer');
    }
}
function darkMode(e){
    e.preventDefault();
    if(body.classList.contains('dark-mode')){
        body.classList.remove('dark-mode');
        dar = 'no';
    }else{
        body.classList.add('dark-mode');
        dar = 'si';
    }
    localStorage.setItem('dark-mode', dar);
    
}
function confirmDelete(id) {
    Swal.fire({
        title: "¿Seguro que Deseas Eliminarlo?",
        text: "No se podrá recuperar lo eliminado",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#023e8a",
        cancelButtonColor: "#ef233c",
        confirmButtonText: "Si"
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Eliminado!",
                text: "Eliminado Correctamente",
                icon: "success"
              });
              setTimeout(() => {
                    document.getElementById('deleteForm-' + id).submit();
              }, 1200);
        }
    });
}

function mostrarCampos(e){
    const valor = e.target.value;
    const divContacto = document.querySelector('#contacto');

    if(valor === "telefono"){
        divContacto.innerHTML = `
            <div class="campo_padre">
                <label for="telefono">Ingresa Tu Teléfono</label>
                <input type="tel" placeholder="Ej. 987654321" id="telefono" name="contacto[telefono]">
            </div>

            <div class="campo_padre">
                <label for="fecha">Fecha</label>
                <input type="date" id="fecha" name="contacto[fecha]">
            </div>
            <div class="campo_padre">
                <label for="hora">Hora</label>
                <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">
            </div>
        `;
        const telefonoInput = document.querySelector("#telefono");
        const fechaInput = document.querySelector("#fecha");
        const horaInput = document.querySelector("#hora");

        telefonoInput.focus();

        telefonoInput.addEventListener('blur', validarFormulario);
        fechaInput.addEventListener('blur', validarFormulario);
        horaInput.addEventListener('blur', validarFormulario);

        contacto.telefono = "";
        contacto.fecha = "";
        contacto.hora = "";

        if("email" in contacto){
            delete contacto.email;
        }

    }else{
        divContacto.innerHTML = `
            <div class="campo_padre">
                <label for="email">E-mail</label>
                <input type="email" placeholder="Tu Email" id="email" name="contacto[email]">
            </div>
        `;

        const emailInput = document.querySelector("#email");
        emailInput.focus();
        emailInput.addEventListener('blur', validarFormulario);

        contacto.email = "";

        if("fecha" in contacto && "hora" in contacto && "telefono" in contacto){
            delete contacto.fecha;
            delete contacto.hora;
            delete contacto.telefono;
        }
    }
}

function validarFormulario(e){
    let campoName = e.target.name.split("[")[1].split("]")[0];

    if(e.target.value.trim() === ""){
        let mensaje = `El campo ${campoName} es obligatorio`;
        mostrarAlerta(mensaje, "error", e.target);
        contacto[campoName] = "";
        habilitarBtnEnviar(contacto);
        return;
    }
    if(!validarEmail(e.target.value) && e.target.id === "email"){
        let mensaje = `El formato del Email no es valido`;
        mostrarAlerta(mensaje, "error", e.target);
        contacto[campoName] = "";
        habilitarBtnEnviar(contacto);
        return;
    }
    if(!validarTelefono(e.target.value) && e.target.id === "telefono"){
        let mensaje = `El formato del Telefono no es valido`;
        mostrarAlerta(mensaje, "error", e.target);
        contacto[campoName] = "";
        habilitarBtnEnviar(contacto);
        return;
    }
    if(!validarPrecio(e.target.value) && e.target.id === "precio"){
        let mensaje = `El formato del Precio no es valido`;
        mostrarAlerta(mensaje, "error", e.target);
        contacto[campoName] = "";
        habilitarBtnEnviar(contacto);
        return;
    }
    eliminarAlerta(e.target.parentElement);
    contacto[campoName] = e.target.value.trim();
    habilitarBtnEnviar(contacto);
}
function mostrarAlerta(mensaje, tipo, campo){
    eliminarAlerta(campo.parentElement);

    const divAlerta = document.createElement("DIV");

    if(tipo === "error"){
        divAlerta.classList.add('alerta', 'error');
    }else{
        divAlerta.classList.add('alerta', 'exito');
    }
    divAlerta.textContent = mensaje;

    campo.parentElement.appendChild(divAlerta);
}
function eliminarAlerta(campo){
    const alerta = campo.querySelector('.alerta');
    if(alerta){
        alerta.remove();
    }
}
function habilitarBtnEnviar(contacto){
    if(Object.values(contacto).includes("")){
        btnEnviar.classList.add('btn-verde-deshabilitado');
        btnEnviar.classList.remove('btn-verde');
        btnEnviar.disabled = true;
    }else{
        btnEnviar.classList.add('btn-verde');
        btnEnviar.classList.remove('btn-verde-deshabilitado');
        btnEnviar.disabled = false;
    }
}
function validarEmail(email){
    const regex =  /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/ 
    const resultado = regex.test(email);
    return resultado;
}
function validarTelefono(telefono){
    const regex =  /^\d{5,15}$/ 
    const resultado = regex.test(telefono);
    return resultado;
}
function validarPrecio(precio){
    const regex =  /^\d{4,9}$/ 
    const resultado = regex.test(precio);
    return resultado;
}








