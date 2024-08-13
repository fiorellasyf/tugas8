//ambil elemen ysng dibutuhkan

var	keyword = document.getElementById('keyword');
// var	search = document.getElementById('search');
var	table = document.getElementById('table');

//tambah event saat keyword ditulis

keyword.addEventListener('keyup', function(){

	//buat objek ajax

	var ajax = new XMLHttpRequest();

	//cek kesiapan ajax

	ajax.onreadystatechange = function(){
		if(ajax.readyState == 4 && ajax.status == 200){
			table.innerHTML = ajax.responseText;
		}
	}

	//eksekusi ajax

	ajax.open('GET', 'cari.php?keyword=' + keyword.value, true);
	ajax.send();


});