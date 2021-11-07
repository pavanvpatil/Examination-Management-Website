let container = document.querySelector('.flex-child1');
let slider = document.querySelector('.s_slide');

let images = document.querySelectorAll('.img');
let width = images[0].clientWidth;
var counter = 1;
container.style.width = width;
function slide(){
    if(counter>=images.length+2){
        return;
    }
    counter++;
    slider.style.transition = 'transform 1s ease-in-out';
    slider.style.transform = 'translateX('+(-counter*width)+'px)';
}
setInterval("slide()", 5000);
slider.addEventListener('transitionend', ()=>{
    if(images[counter].id == 'lastclone'){
        slider.style.transition = 'none';
        counter = images.length - 2;
        slider.style.transform = 'translateX('+(-counter*width)+'px)';
    }
    if(images[counter].id == 'firstclone'){
        slider.style.transition = 'none';
        counter = 1;
        slider.style.transform = 'translateX('+(-counter*width)+'px)';
    }
})

