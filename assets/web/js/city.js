/**
* Philippine Provinces & Cities/Municipalities on HTML Dropdown
*
* @ version 1.0.0
* @ author Marvic R. Macalintal
*/
 var cities = {
 	'Metro Manila' : [
		'Caloocan','Las Piñas','Makati','Malabon','Mandaluyong','Manila',
		'Marikina','Muntinlupa','Navotas','Parañaque','Pasay','Pasig',
		'Pateros','Quezon City','San Juan','Taguig','Valenzuela'
		],
	'Bulacan' : [
		'Angat','Balagtas','Baliuag','Bocaue','Bulakan','Bustos',
		'Calumpit','Doña Remedios Trinidad','Guiguinto','Hagonoy','Malolos','Marilao',
		'Meycauayan','Norzagaray','Obando','Pandi', 'Paombong','Plaridel',
		'Pulilan','San Ildefonso','San Jose del Monte','San Miguel','San Rafael','Santa Maria'
		],
	'Cavite' : [
		'Alfonso','Amadeo','Bacoor','Carmona','Cavite City','Dasmariñas',
		'General Emilio Aguinaldo','General Mariano Alvarez','General Trias','Imus','Indang','Kawit',
		'Magallanes','Maragondon','Mendez','Naic','Noveleta','Rosario',
		'Silang','Tagaytay','Tanza','Ternate','Trece Martires'
		],
	'Laguna' : [
		'Alaminos','Bay','Biñan','Cabuyao','Calamba','Calauan',
		'Cavinti','Famy','Kalayaan','Liliw','Los Baños','Luisiana',
		'Lumban','Mabitac','Magdalena','Majayjay','Nagcarlan','Paete',
		'Pagsanjan','Pakil','Pangil','Pila','Rizal','San Pablo','San Pedro',
		'Santa Cruz','Santa Maria','Santa Rosa','Siniloan','Victoria'
		],
	'Pampanga' : [
		'Angeles','Apalit','Arayat','Bacolor','Candaba','Floridablanca',
		'Guagua','Lubao','Mabalacat','Macabebe','Magalang','Masantol',
		'Mexico','Minalin','Porac','San Fernando','San Luis','San Simon',		
		'Santa Ana','Santa Rita','Santo Tomas','Sasmuan'
		],
 }

 var City = function() {

	this.p = [],this.c = [],this.a = [],this.e = {};
	window.onerror = function() { return true; }
	
	this.getProvinces = function() {
		for(let province in cities) {
			this.p.push(province);
		}
		return this.p;
	}
	this.getCities = function(province) {
		if(province.length==0) {
			console.error('Please input province name');
			return;
		}
		for(let i=0;i<=cities[province].length-1;i++) {
			this.c.push(cities[province][i]);
		}
		return this.c;
	}
	this.getAllCities = function() {
		for(let i in cities) {
			for(let j=0;j<=cities[i].length-1;j++) {
				this.a.push(cities[i][j]);
			}
		}
		this.a.sort();
		return this.a;
	}
	this.showProvinces = function(element) {
		var str = '<option selected disabled>Select Province</option>';
		for(let i in this.getProvinces()) {
			str+='<option>'+this.p[i]+'</option>';
		}
		this.p = [];		
		document.querySelector(element).innerHTML = '';
		document.querySelector(element).innerHTML = str;
		this.e = element;
		return this;
	}
	this.showCities = function(province,element) {
		var str = '<option selected disabled>Select City / Municipality</option>';
		var elem = '';
		if((province.indexOf(".")!==-1 || province.indexOf("#")!==-1)) {
			elem = province;
		}
		else {
			for(let i in this.getCities(province)) {
				str+='<option>'+this.c[i]+'</option>';
			}
			elem = element;
		}
		this.c = [];
		document.querySelector(elem).innerHTML = '';
		document.querySelector(elem).innerHTML = str;
		document.querySelector(this.e).onchange = function() {		
			var Obj = new City();
			Obj.showCities(this.value,elem);
		}
		return this;
	}
}