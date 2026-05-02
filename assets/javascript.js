
    console.log("javascript.js chargé");
document.addEventListener('DOMContentLoaded', function () {
    if (document.getElementById('create_id')) {
        initTableSelection();
        initDeleteConfirmation();
    }

    if (document.getElementById('id')) {
        editUser();
    }

    if (document.getElementById('d_create_id')) {
        initDashboardSelection();
    }

});
function initTableSelection() {
    
    let idSelect = null;
    let ligneSelect = null;

    const lignes = document.querySelectorAll('#table tbody tr');
    const inputId = document.getElementById('create_id');

    if (!lignes.length || !inputId) {
        return;
    }

    lignes.forEach(ligne => {
        ligne.addEventListener('click', function () {
            if (ligneSelect) {
                ligneSelect.classList.remove('selected');
            }

            this.classList.add('selected');
            ligneSelect = this;
            idSelect = this.dataset.id;
            

            if (inputId) {
                inputId.value = idSelect;
            }
        });
    });
}


function initDeleteConfirmation() {

    const confirm_box = document.getElementById('confirm_box');
    const btn_delete = document.getElementById('btn_delete');
    const btn_confirm = document.getElementById('btn_confirm');
    const btn_cancel = document.getElementById('btn_cancel');
    const confirm_delete = document.getElementById('confirm_delete');
    const inputId = document.getElementById('create_id');

    if (!btn_delete || !confirm_box || !confirm_delete || !inputId) {
        return;
    }

    btn_delete.addEventListener('click', function (event) {
        if (!inputId.value) {
            alert("Sélectionne une ligne avant de supprimer");
            event.preventDefault();
            return;
        }

        if (confirm_delete.value !== "1") {
            event.preventDefault();
            confirm_box.style.display = 'flex';
        }
    });

    if (btn_confirm) {
        btn_confirm.addEventListener('click', function () {
            confirm_box.style.display = 'none';
            confirm_delete.value = "1";
            btn_delete.click();
        });
    }

    if (btn_cancel) {
        btn_cancel.addEventListener('click', function () {
            confirm_box.style.display = 'none';
            confirm_delete.value = "0";
        });
    }
}
function editUser() {
    let ligneSelect = null;
    const lignes = document.querySelectorAll('#table tbody tr');
    if (!lignes.length) {
        return;
    }
    lignes.forEach(ligne => {
        ligne.addEventListener('click', function () {

            if (ligneSelect) {
                ligneSelect.classList.remove('selected');
            }

            this.classList.add('selected');
            ligneSelect = this;

            document.getElementById('id').value = this.dataset.id || "";
            document.getElementById('name').value = this.dataset.name || "";
            document.getElementById('surname').value = this.dataset.surname || "";
            document.getElementById('mail').value = this.dataset.mail || "";
            document.getElementById('login').value = this.dataset.login || "";

            const roleSelect = document.getElementById('role');
            if (roleSelect) {
                roleSelect.value = this.dataset.role || "";
            }

            console.log(this.dataset);

            /*for (let key in ligneSelect.dataset) {
                let input = document.getElementById(key);
                if (input) {
                    input.value = ligneSelect.dataset[key];
                }
            }*/
        });
    });
}

function initDashboardSelection() {
    let ligneSelect = null;
    const lignes = document.querySelectorAll('#table tbody tr');
    const inputId = document.getElementById('d_create_id');
    const inputLogin = document.getElementById('d_login');

    if (!lignes.length || !inputId || !inputLogin) {
        return;
    }

    lignes.forEach(ligne => {
        ligne.addEventListener('click', function () {
            if (ligneSelect) {
                ligneSelect.classList.remove('selected');
            }

            this.classList.add('selected');
            ligneSelect = this;

            inputId.value = this.dataset.id || "";
            inputLogin.value = this.dataset.login || "";
        });
    });
}


