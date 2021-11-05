/* jessicaabta */

function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("tabelaAnotacoes");
    switching = true;
    dir = "asc"; 
    while (switching) {
        switching = false;
        rows = table.getElementsByTagName("TR");
        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            } 
            else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount++;      
        } 
        else {
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}

function confirmaAlterar(id, anotacao) {
    if (confirm("Deseja realmente alterar os dados dessa anotação?")) {
        location.href = "alterar?id=" + id + "&anotacao=" + anotacao;
    }
}

function confirmaRemover(id, anotacao) {
    if (confirm("Deseja realmente remover essa anotação?")) {
        location.href = "remover?id=" + id + "&anotacao=" + anotacao;
    }
}