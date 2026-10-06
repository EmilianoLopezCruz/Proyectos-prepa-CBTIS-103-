document.addEventListener('DOMContentLoaded', () => {
    var form = document.querySelector('form');
    var resultadosContainer = document.getElementById('galeria');
    form.addEventListener('submit', (event) => {
        event.preventDefault(); // Evita que el formulario se envíe de la manera tradicional

        var formData = new FormData(form);
        fetch('sistemaBusqueda.php?timestamp=' + new Date().getTime(), {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            resultadosContainer.innerHTML="";
            console.log(data);        
            resultadosContainer.innerHTML=data;
        })       
    });
});