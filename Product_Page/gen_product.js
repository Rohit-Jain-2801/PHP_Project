// considering error label
lbl = document.getElementById('err');

// flipping over to back-side
function flip_over() {			    	
    $('.flip-card').addClass('flipped');
}

// flipping over to front-side
function flip_back(){
    // error label
    lbl.innerHTML = "";
    // flipping to front-side
    $('.flip-card').removeClass('flipped');

    // setting min value for return date
    date2.setAttribute("min", date1.value);

    // for checking both ticks and enabling/disabling btn
    var v1 = window.getComputedStyle(document.querySelector('span'), '::after').getPropertyValue('content').replace(/['"]+/g, '');
    var v2 = window.getComputedStyle(document.querySelector('var'), '::after').getPropertyValue('content').replace(/['"]+/g, '');
    
    console.log(v1)
    console.log(String.fromCharCode(10003))
    // console.log(v1.charCodeAt(0))    //10003
    if(v1.charCodeAt(0)==10003 && v2.charCodeAt(0)==10003){
        btn.removeAttribute('disabled');
        btn.style.cursor =  'pointer';
    } else{
        btn.setAttribute('disabled',true);
        btn.style.cursor =  'not-allowed';
    }
}

// Add an event listener to date field
date1.addEventListener("change", flip_back);
date2.addEventListener("change", flip_back);

// changing the main big image
function img_chg(e){
    document.getElementById('big_img').setAttribute('src', e.getAttribute('src'));
}

// checking for availability
function chkdt(){
    d1 = new Date(date1.value);
    d2 = new Date(date2.value);
    d3 = new Date(date2.getAttribute("max"));
    for(i=0; i<a.length; i++){
        if(a[i][1].getTime() < d1.getTime()){
            if(i+1 < a.length){
                if(a[i+1][0].getTime() > d2.getTime()){
                    flip_over();
                    return 0;
                }
            } else{
                if(d3.getTime() > d2.getTime()){
                    flip_over();
                    return 0;
                }
            }
        }
    }
    if(a.length!=0){
        lbl.innerHTML = "Product is already booked within specified dates!";
    } else{
        flip_over();
        return 0;
    }
}