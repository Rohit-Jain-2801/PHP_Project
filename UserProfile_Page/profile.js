function slct_all_frm(frame){
	var a = ['mo', 'pi', 'ma', 'p', 'mp'];
	for(i=0; i<a.length; i++){
		if(a[i]==frame){
			document.getElementById(a[i]).style.display = 'block';
		} else{
			document.getElementById(a[i]).style.display = 'none';
		}	
	}
}

function slct_all_clr(opt, frm){
	var a = ['pib', 'mab', 'pb'];
	for(i=0; i<a.length; i++){
		if(a[i]==opt){
			console.log(opt);
			console.log(a[i]);
			document.getElementById(a[i]).style.color = 'blue';
		} else{
			document.getElementById(a[i]).style.color = 'black';
		}
	}
	slct_all_frm(frm);
}