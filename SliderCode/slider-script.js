let trav = 0;
slider(trav, 0);
function control(x){
    slider(trav, x);
}
function slider(num, x){
    let sliders = document.getElementsByClassName("slider");
    if(num == 0 && x == -1){
        sliders[num].style.display = "none";
        sliders[5].style.display = "block";
        trav = 5;
        return;
    }
    if(num == 5 && x == 1){
        sliders[num].style.display = "none";
        sliders[0].style.display = "block";
        trav = 0;
        return;
    }
    if(x == 0){
        sliders[num].style.display = "block";
        return;
    }
    sliders[num].style.display = "none";
    sliders[num + x].style.display = "block";
    trav = trav + x;
}
setInterval("slider(trav, 1)", 5000);
    

