import {sendHTTPrequest,printHTTPrequest} from "../loginAndRegister.js";

const password_inputValue = document.getElementById("password");
const password2_inputValue = document.getElementById("password2");
var result_passwordds = false;

const passwordToEqual=(pass1,pass2)=>{ //verifica que las contaseñas sean iguales
    
    const message = document.querySelector(".message"); //obtengo el cuadro de dialogos
    
    //verifico que ambas contraseñas coincidan
    if(pass1 != pass2) {
        message.innerHTML = "<h2>las claves no coinciden</h2>";
        result_passwordds = false;
    } 

    else if (pass1 === pass2){
        message.innerHTML = "<h2> clave permitida </h2>"
        result_passwordds = true;
    } 
        
}


password2_inputValue.addEventListener("keypress",(e)=>{ //se llama a esta funcion para validar las contraseñas

    passwordToEqual(password_inputValue.value,password2_inputValue.value) //se pasa el valor de ls inputs
});


const form_register = document.getElementById("form_register");

form_register.addEventListener("submit",async(e)=>{

    e.preventDefault();

    const data_form = new FormData(form_register);

    const CI = data_form.get("CI");
    const email = data_form.get("email");
    const password = data_form.get("password");


    
    // if(pass1 === pass2 && result_passwordds == true) {//si las claves coinciden, entonces hago el fetch
       if(result_passwordds){ 
        
        const data = {
            CI,
            email,
            password
        }


        const options = {
            method: "POST",
            headers:{"Content-type" : "application/json"},
            body : JSON.stringify(data)
        }
       
        //esta funcion recibe 3 parametros: 1) a donde mandar la info para procesar //2) las opciones que tendra el fecth //3) a donde ir si todo sale bien


           const data_info = await sendHTTPrequest("register.php",options); 
           printHTTPrequest(data_info,"../CONTENT/index.php"); //ya tiene un manejo de excepciones ;)

    }

})