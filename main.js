function parsear(e){
    var datos = this.value.split("@");
    this.value="";

    var campoNombre=2;
    var campoApellido=1;
    var campoDni=4;

    var nom = datos[campoNombre];
    var ape = datos[campoApellido];
    var dn = datos[campoDni];

    console.log(nom, ape, dn);
    document.getElementById('txtnombre').value = nom;
    document.getElementById('txtapellido').value = ape;
    document.getElementById('txtdni').value = dn;

};

document.querySelectorAll("input")[0].addEventListener("change",parsear);
document.querySelectorAll("input")[0].focus();
