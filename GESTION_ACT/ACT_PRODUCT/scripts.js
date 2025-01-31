let panier = [];

function updatePanier() {
    const panierItems = document.getElementById('panier-items');
    const panierTotal = document.getElementById('panier-total');
    const panierVide = document.getElementById('panier-vide');
    const panierTable = document.getElementById('panier-table');
    const totalPrix = document.getElementById('total-prix');

    panierItems.innerHTML = '';
    let total = 0;

    if (panier.length === 0) {
        panierTable.style.display = 'none';
        panierTotal.style.display = 'none';
        panierVide.style.display = 'block';
    } else {
        panierTable.style.display = 'table';
        panierTotal.style.display = 'block';
        panierVide.style.display = 'none';

        panier.forEach((item, index) => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${item.nom}</td>
                <td>
                    <input type="number" value="${item.quantite}" min="1" onchange="changerQuantite(${index}, this.value)">
                </td>
                <td>${item.prix} MAD</td>
                <td>${(item.prix * item.quantite).toFixed(2)} MAD</td>
                <td><button onclick="supprimerProduit(${index})">Supprimer</button></td>
            `;
            panierItems.appendChild(tr);
            total += item.prix * item.quantite;
        });

        totalPrix.innerText = total.toFixed(2);
    }
}

function ajouterAuPanier(nom, prix) {
    const produitExiste = panier.find(item => item.nom === nom);
    if (produitExiste) {
        produitExiste.quantite++;
    } else {
        panier.push({ nom, prix, quantite: 1 });
    }
    updatePanier();
}

function changerQuantite(index, quantite) {
    panier[index].quantite = quantite;
    updatePanier();
}

function supprimerProduit(index) {
    panier.splice(index, 1);
    updatePanier();
}

// Example products in the cart
ajouterAuPanier("Miel Montagne", 100);
ajouterAuPanier("Amlou Acajou", 150);