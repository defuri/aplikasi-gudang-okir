const mata = document.getElementById("mata");
const pw = document.getElementById("password");

function dipencet() {
    if (pw.type === "password") {
        pw.type = "text"; // Ubah menjadi text
        mata.setAttribute("name", "eye-outline"); // Ganti ikon menjadi mata terbuka
    } else {
        pw.type = "password"; // Ubah kembali menjadi password
        mata.setAttribute("name", "eye-off-outline"); // Ganti ikon menjadi mata tertutup
    }
}
