const filtreTheme = document.getElementById("theme");
const filtreRegime = document.getElementById("regime");
const filtrePersonnes = document.getElementById("personnes");
const filtrePrixMin = document.getElementById("prix-min");
const filtrePrixMax = document.getElementById("prix-max");

const menuDelice = document.getElementById("menu-delice");

function filtrerMenus () {
    const themeCorrespond = filtreTheme.value === "" || filtreTheme.value === menuDelice.dataset.theme;
    const regimeCorrespond = filtreRegime.value === "" || filtreRegime.value === menuDelice.dataset.regime;
    // Number() convertit les chaînes en nombres pour comparer correctement (ex. "10" >= "4" sinon faux)
    const personnesCorrespond = filtrePersonnes.value === "" || Number(filtrePersonnes.value) >= Number(menuDelice.dataset.personnes);
    const prixMinCorrespond = filtrePrixMin.value === "" || menuDelice.dataset.prix >= filtrePrixMin.value;
    const prixMaxCorrespond = filtrePrixMax.value === "" || menuDelice.dataset.prix <= filtrePrixMax.value;

  if (themeCorrespond && regimeCorrespond && personnesCorrespond && prixMinCorrespond && prixMaxCorrespond) {
    menuDelice.style.display = "block";
} else {
    menuDelice.style.display = "none";
}
}

filtreTheme.addEventListener("change", filtrerMenus);
filtreRegime.addEventListener("change", filtrerMenus);
filtrePersonnes.addEventListener("input", filtrerMenus);
filtrePrixMin.addEventListener("input", filtrerMenus);
filtrePrixMax.addEventListener("input", filtrerMenus);