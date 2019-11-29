function chk(x){
    if(x<10){
        x = '0'+x;
    }
    return x;
}

preview = document.getElementById('start');
postview = document.getElementById('till');

// Checking for 'from' date
window.onload = function(){
    var d = new Date();
    var today = d.getFullYear()+"-"+chk(d.getMonth()+1)+"-"+chk(d.getDate());
    
    console.log(today);
    console.log(typeof preview.getAttribute("value"));

    if(preview.getAttribute("value")!='' && preview.getAttribute("value")<today){
        preview.readOnly = true;
        preview.style.background = 'white';
    } else{
        preview.setAttribute("min", today);
    }
    postview.setAttribute("min", today);
}

// Checking for 'till' date
preview.addEventListener("blur", function(){
    if(!preview.readOnly){
        postview.setAttribute("min", preview.value);
    }
})

// for keeping a count on no. of images
const realFileBtn = document.getElementById("customFile");
const customTxt = document.getElementById("txt");
const img_sec = document.getElementById('imgs');
console.log(img_sec.childElementCount);
var count = img_sec.childElementCount;              // count no. of child elements
var count_label = document.getElementById("count_img");
count_label.value = count;
console.log(count_label.value);

function img_val() {
    if(realFileBtn.value) {
        var temp = customTxt.innerHTML;
        if("Upload Images!"==temp || "<strong>No file chosen, yet.</strong>"==temp){
            customTxt.innerHTML = "";
        }
        
        console.log(this.files);
        for (let file of this.files) {
            if(count<3){
                let img = new Image;
                img.src = URL.createObjectURL(file);
                if(file.type=='image/jpeg' || file.type=='image/tiff' || file.type=='image/gif' || file.type=='image/png'){
                    if(file.size < 2097152){
                        customTxt.innerHTML += file.name + "<br>";
                        img.title = file.name;
                        img.name = "img"+count;
                        img.style = "margin-right: 1.5%; margin-left: 1.5%;";
                        img_sec.appendChild(img);
                        count += 1;
                    } else{
                        alert("File size exceeded 2MiB: " + file.name);
                    }
                } else{
                    alert("Invalid Image Chosen: " + file.name);
                }
                
            } else{
                alert("Max 3 images can be selected!");
                break;
            }
        }  
    } else if(count==0){
        customTxt.innerHTML = "<strong>No file chosen, yet.</strong>";
        return false;
    }
}

// func for 'choose files' button
realFileBtn.addEventListener("change", img_val);

// func for 'clear' button
function clrd(){
    document.getElementById('customFile').value = "";
    document.getElementById("txt").innerHTML = "Upload Images!";
    count = 0;
    count_label.value = 1;
    console.log(count_label.value);

    img_sec.innerHTML = "";
    // // Another way of removing al childs
    // var child = img_sec.lastElementChild; 
    // //e.firstElementChild can be used.  
    // while(child) { 
    //     img_sec.removeChild(child); 
    //     child = img_sec.lastElementChild;
    // } 
}