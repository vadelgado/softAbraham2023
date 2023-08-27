function handleSelectChange() {
    var select = document.getElementById("selectCurso");
    var generarPDFBtn = document.getElementById("generarPDFBtn");

    if (select.value) {
        generarPDFBtn.disabled = false;
        generarPDFBtn.href = "<?php echo base_url('GenerarPDF'); ?>/" + select.value;
    } else {
        generarPDFBtn.disabled = true;
        generarPDFBtn.removeAttribute("href");
    }
}