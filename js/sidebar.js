// Získáme postranní menu
var mySidebar = document.getElementById("my-sidebar");

// Získáme div, který bude fungovat jako efekt překrytí.
var overlayBg = document.getElementById("my-overlay");

// Přepínání mezi ukázáním a schováním postranního menu. Přidává efekt překrytí (overlay).
function w3_open() {
    if (mySidebar.style.display === 'block') {
        mySidebar.style.display = 'none';
        overlayBg.style.display = "none";
    } else {
        mySidebar.style.display = 'block';
        overlayBg.style.display = "block";
    }
}

// Zavře postranní menu.
function w3_close() {
    mySidebar.style.display = "none";
    overlayBg.style.display = "none";
}
