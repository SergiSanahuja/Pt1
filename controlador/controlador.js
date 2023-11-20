	
/*********************************Funcio rellotge*************************** */


/**
 * 
 * @param Date ara 
 * @returns string html
 */

function rellotge(ara) {
	//ara = new Date("2004-01-01T08:00:00")

    let dies = ["Diumenge", "Dilluns", "Dimarts", "Dimecres", "Dijous", "Divendres", "Dissabte"]
	
    let hora = ara.getHours();
	let minut = ara.getMinutes();
	let segon = ara.getSeconds();

	let dia = ara.getDate();
	let mes = ara.getMonth() + 1;
	let any = ara.getFullYear();

	let HTML = "";
	if (hora >=12) {
		HTML = hora + ":" + minut + ":" + segon + " PM"+ "<br>" + dia + "/" + mes + "/" + any;
	}else{
		HTML = hora + ":" + minut + ":" + segon + " AM"+ "<br>" + dia + "/" + mes + "/" + any;
	}

    HTML = HTML + "<br>" + dies[ara.getDay()];

    return HTML;
}

/**
 * funcio que et posa la data minima de arribada i fi.
 */
function dataMinima() {
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth() + 1; //January is 0!
	var yyyy = today.getFullYear();

	if (dd < 10) {
   	dd = '0' + dd;
	}

	if (mm < 10) {
   	mm = '0' + mm;
	} 
    
	today = yyyy + '-' + mm + '-' + dd;
	document.getElementById("dataArribada").setAttribute("min", today);
	document.getElementById("dataFi").setAttribute("min", today);
}

function clock() {
	document.getElementById('data').innerHTML = rellotge(new Date());
}

//Calcular preu totatldepenent dels dies, pais, numPersones i dataArribada.
function calcularPreu(){
	let dataArribada=Date.parse(document.getElementById('dataArribada').value);
	let dataFi=Date.parse(document.getElementById('dataFi').value);
	let pais=document.getElementById('pais').value;
	let descompte=document.getElementById('descompte').checked;
	let numPersones=document.getElementById('numPersones').value;

	if(!dataArribada||!dataFi||!pais||!numPersones){return};
	
	let difDies= (dataFi-dataArribada)/1000/60/60/24;
	let tPais = document.getElementsByTagName('tr');
	let id = document.getElementById('continent').value;
	let arrayPais = tPais[id-1].innerHTML.replaceAll("</td>","").split('<td>');

	for (let index = 0; index < arrayPais.length; index++) {
		const element = arrayPais[index];
		if(element==pais){
			let preuNit=arrayPais[index+1];
			let preuVol=arrayPais[index+2];
			let preuFinal=0;
			if(descompte){preuFinal = ((preuVol*numPersones)+(difDies*preuNit*numPersones))*0.80;}
			else{preuFinal = (preuVol*numPersones)+(difDies*preuNit*numPersones);}
			let estil = { style: "currency", currency: "EUR" };
    		let f = new Intl.NumberFormat('es-ES', estil);
			document.getElementById("preuFinal").setAttribute("value", preuFinal.toFixed(2));
		}
		
	}

	//preuFinal=preuVol+difDies*preuNit*persones
	//alert(dataArribada+"+"+dataFi+"+"+pais);
	
}

function init() {
	dataMinima();
	clock();
	setInterval(clock, 1000);

	
	document.getElementById('pais').addEventListener('change', function() {
		let paisIMG=document.getElementById('pais').value;
		let ruta="../img/"+paisIMG+".jpg";
	 	document.getElementById("imagenes").innerHTML="<img src='"+ruta+"'</img>";
		calcularPreu();
	});
	
	//afegir les opcions dels paisos depenent del continent.
	document.getElementById('continent').addEventListener('change', function() {
		
		//agafem el llistat dels paisos.
		
		let tPais = document.getElementsByTagName('tr');
		let id = document.getElementById('continent').value;	
		document.getElementById('pais').innerHTML = "";

		//alert(typeof(tPais.innerHTML));
		//afegir els paisos del continent seleccionat.
		let arrayPais = tPais[id-1].innerHTML.replaceAll("</td>","").split('<td>');
				
		arrayPais.forEach(x => { 
			if( isNaN(x) ){
				document.getElementById('pais').innerHTML += "<option value='"+x+"'>"+x+"</option>";
			}
			
		});
		//Cambiar la imagen.
		let paisIMG=document.getElementById('pais').value;
		let ruta="../img/"+paisIMG+".jpg";
	 	document.getElementById("imagenes").innerHTML="<img src='"+ruta+"'</img>";
		calcularPreu();


	});



	document.getElementById('dataArribada').addEventListener('change', calcularPreu);
	document.getElementById('dataFi').addEventListener('change', calcularPreu);
	document.getElementById('numPersones').addEventListener('change', calcularPreu);
	document.getElementById('descompte').addEventListener('click', calcularPreu);

}


window.onload = init();  