
window.onload = function(){
    var a = document.querySelector(".js--wp-4");
    a.classList.add("animate__animated");
     a.classList.add("animate__fadeIn");
}
window.onscroll = function(){
   var mybutton = document.getElementById("myBtn");
   if(document.body.scrollTop > 1000 || document.documentElement.scrollTop > 1000){
      mybutton.style.display = "block";
   }
   else{
          mybutton.style.display = "none";
   }

   if((document.body.scrollTop > 1700 || document.documentElement.scrollTop > 1700)){
    var x = document.querySelectorAll(".js--wp-1");
     for(var i=0; i<x.length; i++){
        x[i].classList.add("animate__animated");
        x[i].classList.add("animate__lightSpeedInLeft");
    }
   }
   
    if(document.body.scrollTop > 2200 || document.documentElement.scrollTop > 2200){
    var y = document.querySelectorAll(".js--wp-2");
     for(var i=0; i<y.length; i++){
        y[i].classList.add("animate__animated");
        y[i].classList.add("animate__fadeInDown");
     }
    }
     if(document.body.scrollTop > 2200 || document.documentElement.scrollTop > 2200){
     var z = document.querySelectorAll(".js--wp-3");
     for(var i=0; i<z.length; i++){
        z[i].classList.add("animate__animated");
        z[i].classList.add("animate__swing");
       } 
     }   
}
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}