function submitForm(){

    var voornaam = document.getElementById("voornaam").value;

    var achternaam = document.getElementById("achternaam").value;

    var rol = document.querySelector('input[name="rol"]:checked').value;

    var wachtwoord = document.getElementById("password").value;



    alert("Naam: " + voornaam + " " + achternaam + "\nRol: " + rol);

 

    switch(rol) {

      case "Klant":

        if(wachtwoord === "Klant"){

          alert("Welkom Klant!");

        }else{

          alert("Je bent niet welkom!");

        }

        break;

      case "administrator":

        alert("Welkom administrator!");

        break;

      default:

        alert("Je bent niet welkom!");

        break;

    }

  }