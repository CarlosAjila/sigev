function confirmacion(form) //pide confirmación del usuario
{
	op= confirm("¿Esta seguro de guardar los datos?");
		  
	if (op==false)
	{
		form.submit(); //enviar el formulario
		return true;
	}
	return false;
}


//validar numeros
function validar_num(e) { // 1
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
    patron =/^([0-9])*$/; // 4
    te = String.fromCharCode(tecla); // 5	
    return patron.test(te); // 6
}

//validar letras
function validar(e) { // 1
    tecla = (document.all) ? e.keyCode : e.which; // 2 
    if (tecla==8) return true; // 3 
    patron =/[A-Za-z\s]/; // 4
    te = String.fromCharCode(tecla); // 5	
    return patron.test(te); // 6
}


//función para validar la creación de periodo lectivo
function validar_crear_periodo(form1)
{
	var isNotOk;
	//Validar el periodo
	var perio=window.document.form1.periodo_lectivo.value;
	if(perio=="")
	{
		alert("Debe Ingresar Periodo Lectivo")
		document.form1.periodo_lectivo.focus();
		return false;
		isNotOk=true;
	}
	
	if(isNotOk)
	{
		return false;
	}
	else
	{
		//confirmacion(form1)
		alert("Periodo Creado Correctamente!!");
    	document.getElementById('form1').submit(); 
		
	}
}


//función para validar la creación de usuario administrador
function validar_cedula(ced)
{
	
	//Validar cédula
	var isNotOk;
	alert(cedu);
	if(cedu=="")
	{
		alert("Debe Ingresar Cédula")
		document.form_usuario.txtcedula.focus();
		return false;
		isNotOk=true;
		
	}
	
		var numero = window.document.form_usuario.txtcedula.value;
		if(cedu!="")
		{
		var suma = 0;
		var p1=0;
		var residuo = 0;
		var pri = false;
		var pub = false;
		var nat = false;
		var numeroProvincias = 22;
		var modulo = 11;
		
		/* Verifico que el campo no contenga letras */
		var ok=1;
		for (i=0; i; numeroProvincias){
		alert("El c"+'\u00f3'+"digo de la provincia (dos primeros dígitos) es inv"+'\u00e1'+"lido"); 
		document.form_usuario.txtcedula.focus();
		return false;
		}
		
		/* Aqui almacenamos los digitos de la cedula en variables. */
		d1 = numero.substr(0,1);
		d2 = numero.substr(1,1);
		d3 = numero.substr(2,1);
		d4 = numero.substr(3,1);
		d5 = numero.substr(4,1);
		d6 = numero.substr(5,1);
		d7 = numero.substr(6,1);
		d8 = numero.substr(7,1);
		d9 = numero.substr(8,1);
		d10 = numero.substr(9,1); 
		
		/* El tercer digito es: */
		/* 9 para sociedades privadas y extranjeros */
		/* 6 para sociedades publicas */
		/* menor que 6 (0,1,2,3,4,5) para personas naturales */ 
		
		if (d3==7 || d3==8){
		alert("El tercer d"+'\u00ed'+"gito ingresado es inv"+'\u00e1'+"lido");
		document.form_usuario.txtcedula.focus();
		return false;
		} 
		
		/* Solo para personas naturales (modulo 10) */
		if (d3 < 6){
		nat = true;
		p1 = d1 * 2; if (p1 >= 10) p1 -= 9;
		p2 = d2 * 1; if (p2 >= 10) p2 -= 9;
		p3 = d3 * 2; if (p3 >= 10) p3 -= 9;
		p4 = d4 * 1; if (p4 >= 10) p4 -= 9;
		p5 = d5 * 2; if (p5 >= 10) p5 -= 9;
		p6 = d6 * 1; if (p6 >= 10) p6 -= 9;
		p7 = d7 * 2; if (p7 >= 10) p7 -= 9;
		p8 = d8 * 1; if (p8 >= 10) p8 -= 9;
		p9 = d9 * 2; if (p9 >= 10) p9 -= 9;
		modulo = 10;
		} 
		
		/* Solo para sociedades publicas (modulo 11) */
		/* Aqui el digito verficador esta en la posicion 9, en las otras 2 en la pos. 10 */
		else if(d3 == 6){
		pub = true;
		p1 = d1 * 3;
		p2 = d2 * 2;
		p3 = d3 * 7;
		p4 = d4 * 6;
		p5 = d5 * 5;
		p6 = d6 * 4;
		p7 = d7 * 3;
		p8 = d8 * 2;
		p9 = 0;
		} 
		
		/* Solo para entidades privadas (modulo 11) */
		else if(d3 == 9) {
		pri = true;
		p1 = d1 * 4;
		p2 = d2 * 3;
		p3 = d3 * 2;
		p4 = d4 * 7;
		p5 = d5 * 6;
		p6 = d6 * 5;
		p7 = d7 * 4;
		p8 = d8 * 3;
		p9 = d9 * 2;
		}
		
		suma = p1 + p2 + p3 + p4 + p5 + p6 + p7 + p8 + p9;
		residuo = suma % modulo; 
		
		/* Si residuo=0, dig.ver.=0, caso contrario 10 - residuo*/
		digitoVerificador = residuo==0 ? 0: modulo - residuo; 
		
		/* ahora comparamos el elemento de la posicion 10 con el dig. ver.*/
		if (pub==true){
		if (digitoVerificador != d9){
		alert("El ruc de la empresa del sector p"+'\u00fa'+"blico es incorrecto.");
		document.form_usuario.txtcedula.focus();
		return false;
		}
		/* El ruc de las empresas del sector publico terminan con 0001*/
		if ( numero.substr(9,4) != '0001' ){
		alert("El ruc de la empresa del sector p"+'\u00fa'+"blico debe terminar con 0001");
		document.form_usuario.txtcedula.focus();
		return false;
		}
		}
		else if(pri == true){
		if (digitoVerificador != d10){
		alert('El ruc de la empresa del sector privado es incorrecto.');
		document.form_usuario.txtcedula.focus();
		return false;
		}
		if ( numero.substr(10,3) != '001' ){
		alert('El ruc de la empresa del sector privado debe terminar con 001');
		document.form_usuario.txtcedula.focus();
		return false;
		}
		} 
		
		else if(nat == true){
		if (digitoVerificador != d10){
		alert("El n"+'\u00fa'+"mero de c"+'\u00e9'+"dula de la persona natural es incorrecto.");
		document.form_usuario.txtcedula.focus();
		document.form_usuario.txtcedula = "";
		return false;
		isNotOk=true;
		}
		
		if (numero.length >10 && numero.substr(10,3) != '001' ){
		alert('El ruc de la persona natural debe terminar con 001');
		document.form_usuario.txtcedula.focus();
		return false;
		}
		}
		}
	
	if(isNotOk)
	{
		return false;
	}
}















