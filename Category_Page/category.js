// for background color of particular sidebar section
window.onload = function(){
    const urlParams = new URLSearchParams(window.location.search);
    const myParam = urlParams.get('val');
    if(myParam){
        console.log(myParam);
        var cat = document.getElementById(myParam);
        console.log(typeof cat);
        cat.style.backgroundColor = '#54595d';
    }
}

// for sidebar toggle
$(document).ready(function(){
    $('#sidebar-btn').click(function(){
        $('#sidebar').toggleClass('visible');
    });
});