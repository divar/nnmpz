//fungsi agar hanya angka yang bisa diinputkan
function angka2(objek) {
    objek = typeof(objek) != 'undefined' ? objek : 0;
    a = objek.value;
    b = a.replace(/[^\d]/g,"");
    c = "";
    panjang = b.length;
    j = 0;
    for (i = panjang; i > 0; i--) {
        j = j + 1;
        if (((j % 3) == 1) && (j != 1)) {
        c = b.substr(i-1,1)  + c;
        } else {
                c = b.substr(i-1,1) + c;
        }
    }
    objek.value = c;
}

//fungsi agar hanya angka yang bisa diinputkan dan ditambahkan koma
function angka(objek) {
    objek = typeof(objek) != 'undefined' ? objek : 0;
    a = objek.value;
    b = a.replace(/[^\d]/g,"");
    c = "";
    panjang = b.length;
    j = 0;
    for (i = panjang; i > 0; i--) {
        j = j + 1;
        if (((j % 3) == 1) && (j != 1)) {
        c = b.substr(i-1,1) + "." + c;
        } else {
                c = b.substr(i-1,1) + c;
        }
    }
    objek.value = c;
}

//fungsi untuk menambahkan koma ke angka
function addCommas(nStr)
{
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? ',' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + '.' + '$2');
	}
	return x1 + x2;
}

function floatToCurrency(a){
    if(a!=''&&a!=null){
       a=a.toFixed(2).toString();
       var b = a.replace(/[^\d\.]/g,'');
       var temp=a.split('.');
       if(temp.length>1){
           return numberToCurrency2(temp[0])+','+temp[1];
       }else{
           return numberToCurrency2(b);
       }

    }else{
        return '';
    }
}

function numberToCurrency2(a){
        if(a!=null&&!isNaN(a)){
        //var b=Math.ceil(parseFloat(a));
        var b=parseInt(a);
        var angka=b.toString();
        var c = '';
        var lengthchar = angka.length;
        var j = 0;
        for (var i = lengthchar; i > 0; i--) {
                j = j + 1;
                if (((j % 3) == 1) && (j != 1)) {
                        c = angka.substr(i-1,1) + '.' + c;
                } else {
                        c = angka.substr(i-1,1) + c;
                }
        }
        return c;
    }else{
        return '';
    }
}

function currencyToNumber(a){
    if(a!=null||a!=''){
      var b=a.toString();
      var pecah_koma = b.split(',');
      pecah_koma[0]=pecah_koma[0].replace(/\.+/g, '');
      c=pecah_koma.join('.');
      return parseFloat(c);
    }else{
      return '';
    }
}

function titikKeKoma(obj){
    var a=obj.toString();
    var b='';
    if(a!=null){
        b=a.replace(/\./g,',');
    }
    return b;
}

function komaKeTitik(obj){
    var a=obj.toString();
    var b='';
    if(a!=null){
        b=a.replace(/\,/g,'.');
    }
    return b;
}

function numberToCurrency(a){
       if(a!=''&&a!=null){
       a=a.toString();
        var b = a.replace(/[^\d\,]/g,'');
		var dump = b.split(',');
        var c = '';
        var lengthchar = dump[0].length;
        var j = 0;
        for (var i = lengthchar; i > 0; i--) {
                j = j + 1;
                if (((j % 3) == 1) && (j != 1)) {
                        c = dump[0].substr(i-1,1) + '.' + c;
                } else {
                        c = dump[0].substr(i-1,1) + c;
                }
        }

		// if(dump.length>1){
		// 	if(dump[1].length>0){
		// 		c += ','+dump[1];
		// 	}else{
		// 		c += ',';
		// 	}
		// }
    return c;}
    else{
        return '';
    }
}

//fungsi agar hanya angka yang bisa diinputkan dan ditambahkan koma
function angka(objek) {
    objek = typeof(objek) != 'undefined' ? objek : 0;
    a = objek.value;
    b = a.replace(/[^\d]/g,"");
    c = "";
    panjang = b.length;
    j = 0;
    for (i = panjang; i > 0; i--) {
        j = j + 1;
        if (((j % 3) == 1) && (j != 1)) {
        c = b.substr(i-1,1) + "." + c;
        } else {
                c = b.substr(i-1,1) + c;
        }
    }
    objek.value = c;
}

function toUpper(obj) {
    var mystring = obj.value;
    obj.value = mystring.toUpperCase();

    // var sp = mystring.split(' ');
    // var wl = 0;
    // var f, r;
    // var word = new Array();
    // for (i = 0; i < sp.length; i++) {
    //     f = sp[i].substring(0, 1).toUpperCase();
    //     r = sp[i].substring(1).toLowerCase();
    //     word[i] = f + r;
    // }
    // newstring = word.join(' ');
    // obj.value = newstring;
    return obj.value;
}

function desimal(obj){
    a=obj.value;
    var reg=new RegExp(/[0-9]+(?:\.[0-9]{0,2})?/g)
    b=a.match(reg,'');
    if(b==null){
        obj.value='';
    }else{
        obj.value=b[0];
    }

}
function desimalKoma(obj){
    a=obj.value;
    var reg=new RegExp(/[0-9]+(?:\,[0-9]{0,2})?/g)
    b=a.match(reg,'');
    if(b==null){
        obj.value='';
    }else{
        obj.value=b[0];
    }

}
