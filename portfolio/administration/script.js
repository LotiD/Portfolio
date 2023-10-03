const banniere = document.querySelector("[data-banniere]"); // On récupère les données de la bannière pour stocker dans une constante
const btnFermetureBanniere = document.querySelector("[data-fermeture-banniere]"); // On récupère les données du bouton 'fermer' pour stocker dans une constante
//Dès que le bouton 'fermer' est actionné toutes les balises ayant la classe banniere se verront rajouter la classe cache 
btnFermetureBanniere.addEventListener("click", function () {
    banniere.classList.add('cache')
});