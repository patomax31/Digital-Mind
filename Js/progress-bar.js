window.addEventListener('load',() => {
    const progress = document.getElementById('progress');
    requestAnimationFrame(update);
})

function update(){
    progress.style.width = `${((window.scrollY) / (document.body.scrollHeight - window.innerHeight) * 100)}%`; /*Para comillas invertidas es alt + 96*/ 
    requestAnimationFrame(update);
}