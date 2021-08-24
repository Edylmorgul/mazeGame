// Variables globales ==> LET + récup id DOM HTML
// querySelector ==> Récup automatiquement le type des éléments ==> Pas besoin de préciser getElementById() / getElementByTagName() / ...
// Beaucoup de let ==> Plusieurs fichier script par écrans aurait été mieux...
let textErrorLogin = document.querySelector("#textErrorLogin"); // document.getElementById()
let textErrorRegister = document.querySelector("#textErrorRegister");
let textErrorPseudo = document.querySelector("#textErrorPseudo");
let textErrorEmail = document.querySelector("#textErrorEmail");
let textErrorPassword = document.querySelector("#textErrorPassword");
let title = document.querySelector("#title");
let loginForm = document.querySelector("#loginForm");
let registerForm = document.querySelector("#registerForm");
let mazeGame = document.querySelector("#mazeGame");
let pseudoPlayer = document.querySelector("#pseudoPlayer");
let userPseudoLogin = document.querySelector("#userPseudoLogin");
let userPasswordLogin = document.querySelector("#userPasswordLogin");
let userPseudoRegister = document.querySelector("#userPseudoRegister");
let userPasswordRegister = document.querySelector("#userPasswordRegister");
let userPasswordVerificationRegister = document.querySelector("#userPasswordVerificationRegister");
let userMailRegister = document.querySelector("#userMailRegister");
let btnRegister = document.querySelector("#btnRegister");
let btnBack = document.querySelector("#btnBack");
let btnLogout = document.querySelector("#btnLogout");
let modal = document.querySelector(".modal");
let modalText = document.querySelector("#modal-text");
let canvas = document.querySelector("#canvas");
let ctx = canvas.getContext("2d");
let turnL = document.querySelector("#turnL");
let moveF = document.querySelector("#moveF");
let turnR = document.querySelector("#turnR");
let moveL = document.querySelector("#moveL");
let moveB = document.querySelector("#moveB");
let moveR = document.querySelector("#moveR");
let compN = document.querySelector("#compN");
let compS = document.querySelector("#compS");
let compE = document.querySelector("#compE");
let compW = document.querySelector("#compW");
let info = document.querySelector("#info");
let btnInfo = document.querySelector("#btnInfo");
let btnHome = document.querySelector("#btnHome");
let btnChat = document.querySelector("#btnChat");
let chatText = document.querySelector("#chatText");
let typeMsg = document.querySelector("#typeMsg");
let chat = document.querySelector("#chat");

// Paramètres de base
let defaultOrientation = "south"; // Orientation au sud par défaut
let defaultTheme = "BLUE"; // Theme par défaut ==> 1er niveau
let selectedTheme;
registerForm.style.display = "none";
mazeGame.style.display = "none";
info.style.display = "none";

// Tableau global des images correspondant au thème choisi
let tabImageBlue = [];
let tabImageGreen = [];
let tabImageBrick = [];
let tabImageDrow = [];
let tabImageXanatha = [];

// Fonctions
// Vérifier si pseudo valide
function checkPseudo(pseudo) {
    var regexPseudo = (/^[a-zA-Z\d]{4,20}$/);
    return regexPseudo.test(pseudo);
};

// Vérifier si email valide
function checkEmail(email) {
    var regexEmail = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return regexEmail.test(email);
};

// Vérifier si mot de passe valide ==> Une autre façon de faire regexp
function checkPassword(password){
    var regexPassword = new RegExp("^(?=.*[0-9])" // Doit contenir un chiffre
    + "(?=.*[a-z])(?=.*[A-Z])" // Doit contenir majuscule et minuscule
    + "(?=\\S+$).{4,20}$") // Pas d'espace permis + longueur mdp 4 - 20);
    return regexPassword.test(password);
};

// En javascript, plusieurs façon de faire des fontions
// 3 Types de fonctions : 

// function nomFonction(){} // Plusieurs fois dans le projet
// function (){} ==> Une seule fois dans le projet ==> Pas de nom
// () => {} ==> Fonction fléchée

// Afficher formulaire enregistrement
// .onclick, onactive
btnRegister.addEventListener('click', () => {
    loginForm.style.display = "none";
    info.style.display = "none";
    registerForm.style.display = "block";
});

// Bouton retour vers login
btnBack.addEventListener('click', () => {
    loginForm.style.display = "block";
    info.style.display = "none";
    registerForm.style.display = "none";
});

// Bouton information
btnInfo.addEventListener('click', () => {
    loginForm.style.display = "none";
    registerForm.style.display = "none";
    info.style.display = "block";
});

// Bouton retour vers Accueil
btnHome.addEventListener('click', () => {
    info.style.display = "none";
    loginForm.style.display = "block";
    registerForm.style.display = "none";
});

// Vérifier formulaire login + envoi des données
loginForm.addEventListener('submit', (e) => {
    var pseudoError, passwordError;
    e.preventDefault(); // Ne pas recharger la page
    info.style.display = "none";

    // 1. Vérification des champs
    if(userPseudoLogin.value == ""){
        userPseudoLogin.style.borderColor = "red";
        pseudoError = 1;
    }

    else{       
        userPseudoLogin.style.borderColor = "black";
        pseudoError = 0;
    }

    if(userPasswordLogin.value == ""){
        userPasswordLogin.style.borderColor = "red";
        passwordError = 1;
    }

    else{
        userPasswordLogin.style.borderColor = "black";
        passwordError = 0;
    }

    // 2. Envoi des données vers login.php si aucun problème
    if(pseudoError == 0 && passwordError == 0){
        modalText.value = "";
        textErrorLogin.style.display = "none";
        textErrorPassword.style.display = "none";

        var xhr = new XMLHttpRequest(); /* Fonction ==> Préférence VAR */
        var param = "pseudoLog=" + encodeURIComponent(userPseudoLogin.value); /* value pour récup texte élément */
        param += "&passwordLog=" + encodeURIComponent(userPasswordLogin.value);

        // Préparation requête AJAX
        xhr.onreadystatechange = () => {
            if(xhr.readyState == 4 && xhr.status == 200){
                // Récupération chaine de caractère
                var tabChaine = (xhr.responseText);
                var chaine = tabChaine.split(","); // Diviser la chaine recue par le séparateur ","

                // Si utilisateur trouvé
                if(chaine[0] === "0"){
                    // Effacement des chmaps
                    userPseudoLogin.value = "";
                    userPasswordLogin.value = "";

                    // Affichage du pseudo
                    pseudoPlayer.innerHTML = "Bon jeu : " + chaine[2];

                    // Affichage écran jeu
                    loginForm.style.display = "none";
                    title.style.display = "none";
                    mazeGame.style.display = "block";
                    info.style.display = "none";

                    // Chargement du jeu (Actualisation)
                    startGame();

                    // Définir compass orientation
                    compassOrientation(defaultOrientation);
                }

                // Si compte non trouvé
                else if(chaine[0] === "1"){
                    textErrorPassword.style.display = "inline";
                }

                // Si erreur quelconque
                else{
                    // Effacement valeur des champs
                    userPseudoLogin.value = "";
                    userPasswordLogin.value = "";
                    // Affichage pop-up                   
                    modalText.innerHTML = "Une erreur est survenue durant la tentative de connexion à votre compte !";
                    modal.classList.toggle("show-modal");                  
       
                    // Cacher modal après un certain délai
                    setTimeout(() => {
                        modal.classList.remove("show-modal");                      
                    }, 3000);
                }
            }
        };
        xhr.open("POST", "login.php", true);
        xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        xhr.send(param);
    }

    // 3. Affichage message d'erreur globale si problème
    else{
        textErrorLogin.style.display = "inline";
    }
});

// Deconnexion du compte
btnLogout.addEventListener('click', () =>{
    var xhr=new XMLHttpRequest();

    xhr.onreadystatechange = () =>{
        if(xhr.readyState == 4 && xhr.status == 200){
            loginForm.style.display = "block";
            title.style.display = "block";
            mazeGame.style.display = "none";
        }
    };
    xhr.open("POST","logout.php");
    xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    xhr.send();
});

// Vérifier formulaire register + envoi des données
registerForm.addEventListener('submit', (e) => {
    var pseudoError, passwordError, passwordVerifError, emailError;
    e.preventDefault(); // Eviter recharge de la page quand submit valider

    // 1. Vérification des champs
    if(userPseudoRegister.value == "" || checkPseudo(userPseudoRegister.value) == false){
        userPseudoRegister.style.borderColor = "red";
        pseudoError = 1;
    }

    else{       
        userPseudoRegister.style.borderColor = "black";
        pseudoError = 0;
    }

    if(userMailRegister.value == "" || checkEmail(userMailRegister.value) == false){
        userMailRegister.style.borderColor = "red";
        emailError = 1;
    }

    else{
        userMailRegister.style.borderColor = "black";
        emailError = 0;
    }

    if(userPasswordRegister.value == "" || checkPassword(userPasswordRegister.value) == false){
        userPasswordRegister.style.borderColor = "red";
        passwordError = 1;
    }

    else{       
        userPasswordRegister.style.borderColor = "black";
        passwordError = 0;
    }

    if(userPasswordVerificationRegister.value == "" || userPasswordVerificationRegister.value != userPasswordRegister.value){
        userPasswordVerificationRegister.style.borderColor = "red";
        passwordVerifError = 1;
    }

    else{
        userPasswordVerificationRegister.style.borderColor = "black";
        passwordVerifError = 0;
    }

    // 2. Envoi des données vers createUser.php si aucun problème
    if(pseudoError == 0 && emailError == 0 && passwordError == 0 && passwordVerifError == 0){
        modalText.value = "";
        textErrorRegister.style.display = "none";
        textErrorPseudo.style.display = "none";
        textErrorEmail.style.display = "none";

        var xhr = new XMLHttpRequest();
        var param = "pseudoReg=" + encodeURIComponent(userPseudoRegister.value);
        param += "&passwordReg=" + encodeURIComponent(userPasswordRegister.value);
        param += "&emailReg=" + encodeURIComponent(userMailRegister.value);

        xhr.onreadystatechange = () => {
            if(xhr.readyState == 4 && xhr.status == 200){                           
                // Si compte joueur créé
                if((xhr.responseText) === "0"){
                    // Effacement valeur des champs
                    userPseudoRegister.value = "";
                    userPasswordRegister.value = "";
                    userPasswordVerificationRegister.value = "";
                    userMailRegister.value = "";

                    // Affichage ecran login
                    loginForm.style.display = "block";
                    registerForm.style.display = "none";                   

                    // Affichage pop-up ==> A améliorer si temps possible 
                    modalText.innerHTML = "Enregistrement réussi !";
                    modal.classList.toggle("show-modal");
       
                    // Cacher modal après un certain délai
                    setTimeout(() => {
                        modal.classList.remove("show-modal"); // On supprime la classe qui permet l'affichage du modal
                    }, 3000);
                }

                // Si pseudo déjà présent
                else if((xhr.responseText) === "1"){
                    userPseudoRegister.value = "";
                    textErrorPseudo.style.display = "inline";
                }

                // Si email déjà présent
                else if((xhr.responseText) === "2"){
                    userMailRegister.value = "";
                    textErrorEmail.style.display = "inline";
                }

                // Si erreur quelconque
                else {
                    // Effacement valeur des champs
                    userPseudoRegister.value = "";
                    userPasswordRegister.value = "";
                    userPasswordVerificationRegister.value = "";
                    userMailRegister.value = "";

                    // Affichage ecran login
                    loginForm.style.display = "block";
                    registerForm.style.display = "none";
                    info.style.display = "none";

                    // Affichage pop-up                   
                    modalText.innerHTML = "Une erreur est survenue durant la création de votre compte !";
                    modal.classList.toggle("show-modal");                  
       
                    // Cacher modal après un certain délai
                    setTimeout(() => {
                        modal.classList.remove("show-modal");                      
                    }, 3000);
                }
            }
        };
        xhr.open("POST", "createUser.php", true);
        xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        xhr.send(param);
    }

    // 3. Affichage message d'erreur globale si problème
    else{
        textErrorRegister.style.display = "inline";
    }
});

// Chargement des images selon le thème
function loadImage(theme){
    var xhr=new XMLHttpRequest();
    var param = "theme=" + encodeURIComponent(theme);

    xhr.onreadystatechange = () =>{
        if(xhr.readyState == 4 && xhr.status == 200){
            var tab = (xhr.responseText);

            switch(theme){
                case "BLUE":
                    tabImageBlue = tab.split(";");
                    break;
                case "GREEN":
                    tabImageGreen = tab.split(";");
                    break;
                case "BRICK":
                    tabImageBrick = tab.split(";");
                    break;
                case "DROW":
                    tabImageDrow = tab.split(";");
                    break;
                case "XANATHA": 
                    tabImageXanatha = tab.split(";");
            }
        }
    };
    xhr.open("POST","theme.php");
    xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    xhr.send(param);
};

function test(source, callback){
    var images = {};
    var loadedImg = 0;
    var numImg = 0;

    for(var src in source){
        numImg++;
    }

    for(var src in source){
        images[src] = new Image();
        images[src].onload = function() {
            if(++loadedImg >= numImg){
                callback(images);
            }
        };
        images[src].src = source[src];
        console.log(images[src]);
    }  
};

// void ctx.drawImage(image, dx, dy);
// void ctx.drawImage(image, dx, dy, dLargeur, dHauteur);
// void ctx.drawImage(image, sx, sy, sLargeur, sHauteur, dx, dy, dLargeur, dHauteur);
// Fonction permettant de récupérer l'image via sa source
function defineImageSource(theme, letter = null, typeImage = null, tabImageS = null, tabImageF = null){
    // Background
    if(letter === null && typeImage === null){
        var chaine = theme + ".BACK.png";

        var img = new Image();
        img.src = chaine;   
        img.onload = () =>{
            ctx.drawImage(img, 0, 0, 1400, 800);
            /*ctx.fillStyle = 'WHITE';
            ctx.fillRect(0, 0, 1400, 800 );*/
        }    
    }

    // Autre
    else {
        var typeOrientation;
        var x, y;

        switch(letter){
            case 'A':
                typeOrientation = 'S';
                x = 133;
                y = 150;
            break;
            case 'B':
                typeOrientation = 'SF';
                x = 150;
                y = 150;
            break;
            case 'C':
                typeOrientation = 'SF';
                x = 170;
                y = 150;
            break;
            case 'D':
                typeOrientation = 'F';
                x = 170;
                y = 150;
            break;
            case 'E':
                typeOrientation = 'SF';
                x = 170;
                y = 150;
            break;
            case 'F':
                typeOrientation = 'SF';
                x = 10 +375;
                y = 150;
            break;
            case 'G':
                typeOrientation = 'S';
                x = 10 +600;
                y = 150;
            break;
            case 'H':
                typeOrientation = 'S'; 
                x = 150;
                y = 150;
            break;
            case 'I':
                typeOrientation = 'SF'; 
                x = 170;
                y = 150;
            break;
            case 'J':
                typeOrientation = 'F'; 
                x = 170;
                y = 150;
            break;
            case 'K':
                typeOrientation = 'SF'; 
                x = 170;
                y = 150;
            break;
            case 'L':
                typeOrientation = 'S';
                x = 10 +375;
                y = 150;
            break;
            case 'M':
                typeOrientation = 'SF';
                x = 170;
                y = 150;
            break;
            case 'N':
                typeOrientation = 'F';
                x = 170;
                y = 150;
            break;
            case 'O':
                typeOrientation = 'SF';
                x = 170;
                y = 150;
            break;
            case 'P':
                typeOrientation = 'S';
                x = 170;
                y = 150;
            break;
            case 'Q':
                typeOrientation = 'S';
                x = 170;
                y = 150;
            break;           
        }

        if(typeOrientation == 'SF'){    
            tabImageF[tabImageF.length] = new Array(
                theme + "." + letter + 'F' + typeImage +".png",
                x,
                y
            );

            tabImageS[tabImageS.length] = new Array(
                theme + "." + letter + 'S' + typeImage +".png",
                x,
                y
            );         
        }

        else{
            if(typeOrientation == 'F'){
                tabImageF[tabImageF.length] = new Array(
                    theme + "." + letter + 'F' + typeImage +".png",
                    x,
                    y
                );
            }

            else{
                tabImageS[tabImageS.length] = new Array(
                    theme + "." + letter + 'S' + typeImage +".png",
                    x,
                    y
                );
            }              
        }
    }  
};

// google
function array_column(list, column, indice){
    var result;

    if(typeof indice != "undefined"){
        result = {};

        for(key in list)
            result[list[key][indice]] = list[key][column];
    }else{
        result = [];

        for(key in list)
            result.push( list[key][column] );
    }

    return result;
}

// Fonction permettant l'affichage du jeu
function displayMaze(theme){
    // Afin d'avoir un ordre d'affichage logique
    var tabRowF1 = [];
    var tabRowS1 = [];
    var tabRowF2 = [];
    var tabRowS2 = [];
    var tabRowF3 = [];
    var tabRowS3 = [];
    var tabRowF4 = [];
    var tabRowS4 = [];

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        // 1. Reception tableau des données point de vue joueur
        if(xhr.readyState == 4 && xhr.status == 200){           
            var tabData = (xhr.responseText);
            var data = tabData.split(";");
            var letter = 'A';
            theme = data[17];
            var orientation = data[18];
            // Changement orientation boussole
            compassOrientation(orientation);
            console.log(data);

            defineImageSource("imgMaze/" + theme, null, null, null, null);
            for(var i = 0; i<7; i++){
                typeImage = data[i];
                console.log(typeImage);
                if(typeImage > 0)defineImageSource("imgMaze/" + theme, String.fromCharCode(letter.charCodeAt(0)+i), typeImage - 1, tabRowS1, tabRowF1);
            }

            test(array_column(tabRowS1, 0), (images) => {
                for(var i = 0; i< tabRowS1.length; i++){
                    ctx.drawImage(images[i], tabRowS1[i][1], tabRowS1[i][2], 640, 400);  
                    console.log(images);                 
                }
            });
            
            test(array_column(tabRowF1, 0), (images) => {
                for(var i = 0; i< tabRowF1.length; i++){
                    ctx.drawImage(images[i], tabRowF1[i][1], tabRowF1[i][2], 640, 400);                   
                }
            });

            for(var i = 7; i<12; i++){
                typeImage = data[i];
                console.log(typeImage);
                if(typeImage > 0)defineImageSource("imgMaze/" + theme, String.fromCharCode(letter.charCodeAt(0)+i), typeImage - 1, tabRowS2, tabRowF2);
            }

            test(array_column(tabRowS2, 0), (images) => {
                for(var i = 0; i< tabRowS2.length; i++){
                    ctx.drawImage(images[i], tabRowS2[i][1], tabRowS2[i][2], 640, 400);  
                    console.log(images);                 
                }
            });
            
            test(array_column(tabRowF2, 0), (images) => {
                for(var i = 0; i< tabRowF2.length; i++){
                    ctx.drawImage(images[i], tabRowF2[i][1], tabRowF2[i][2], 640, 400);                   
                }
            });

            for(var i = 12; i<15; i++){
                typeImage = data[i];
                console.log(typeImage);
                if(typeImage > 0)defineImageSource("imgMaze/" + theme, String.fromCharCode(letter.charCodeAt(0)+i), typeImage - 1, tabRowS3, tabRowF3);
            }

            test(array_column(tabRowS3, 0), (images) => {
                for(var i = 0; i< tabRowS3.length; i++){
                    ctx.drawImage(images[i], tabRowS3[i][1], tabRowS3[i][2], 640, 400);  
                    console.log(images);                 
                }
            });

            test(array_column(tabRowF3, 0), (images) => {
                for(var i = 0; i< tabRowF3.length; i++){
                    ctx.drawImage(images[i], tabRowF3[i][1], tabRowF3[i][2], 640, 400);                   
                }
            });

            for(var i = 15; i<17; i++){
                typeImage = data[i];
                console.log(typeImage);
                if(typeImage > 0)defineImageSource("imgMaze/" + theme, String.fromCharCode(letter.charCodeAt(0)+i), typeImage - 1, tabRowS4, tabRowF4);
            }

            test(array_column(tabRowS4, 0), (images) => {
                for(var i = 0; i< tabRowS4.length; i++){
                    ctx.drawImage(images[i], tabRowS4[i][1], tabRowS4[i][2], 640, 400);  
                    console.log(images);                 
                }
            });

            test(array_column(tabRowF4, 0), (images) => {
                for(var i = 0; i< tabRowF4.length; i++){
                    ctx.drawImage(images[i], tabRowF4[i][1], tabRowF4[i][2], 640, 400);                   
                }
            });
        }
    };
    xhr.open("POST","maze.php");
    xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    xhr.send(null);
};

// Fonction permettant d'effectuer les déplacements dans le jeu
// Gauche
turnL.addEventListener('click', () => {
    var move = 1;
    var xhr=new XMLHttpRequest();
    var param = "move=" + encodeURIComponent(move);

    xhr.onreadystatechange = () => {
        if(xhr.readyState==4 && xhr.status==200){
            displayMaze(defaultTheme);
       }
    };
    xhr.open("POST", "shifting.php", true);
    xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    xhr.send(param);
});

// Droite
turnR.addEventListener('click', () => {
    var move = 2;
    var xhr=new XMLHttpRequest();
    var param = "move=" + encodeURIComponent(move);

    xhr.onreadystatechange = () => {
        if(xhr.readyState==4 && xhr.status==200){
            displayMaze(defaultTheme);
       }
    };
    xhr.open("POST", "shifting.php", true);
    xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    xhr.send(param);
});

// Avancer
moveF.addEventListener('click', () => {
    var move = 3;
    var xhr=new XMLHttpRequest();
    var param = "move=" + encodeURIComponent(move);

    xhr.onreadystatechange = () => {
        if(xhr.readyState==4 && xhr.status==200){
            displayMaze(defaultTheme);
       }
    };
    xhr.open("POST", "shifting.php", true);
    xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    xhr.send(param);
});

// Reculer
moveB.addEventListener('click', () => {
    var move = 4;
    var xhr=new XMLHttpRequest();
    var param = "move=" + encodeURIComponent(move);

    xhr.onreadystatechange = () => {
        if(xhr.readyState==4 && xhr.status==200){
            displayMaze(defaultTheme);
       }
    };
    xhr.open("POST", "shifting.php");
    xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    xhr.send(param);
});

// Basculer à gauche
moveL.addEventListener('click', () => {
    var move = 5;
    var xhr=new XMLHttpRequest();
    var param = "move=" + encodeURIComponent(move);

    xhr.onreadystatechange = () => {
        if(xhr.readyState==4 && xhr.status==200){          
            displayMaze(defaultTheme);        
       }
    };
    xhr.open("POST", "shifting.php");
    xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    xhr.send(param);
});

// Basculer à droite
moveR.addEventListener('click', () => {
    var move = 6;
    var xhr=new XMLHttpRequest();
    var param = "move=" + encodeURIComponent(move);

    xhr.onreadystatechange = () => {
        if(xhr.readyState==4 && xhr.status==200){
            displayMaze(defaultTheme);
       }
    };
    xhr.open("POST", "shifting.php");
    xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    xhr.send(param);
});

// Changer l'orientation de la boussole selon le point de vue
function compassOrientation(orientation){
    switch(orientation){
        case "north" :
            compN.style.display = "block";
            compS.style.display = "none";
            compE.style.display = "none";
            compW.style.display = "none";
            break;
        case "south" :
            compN.style.display = "none";
            compS.style.display = "block";
            compE.style.display = "none";
            compW.style.display = "none";
            break;
        case "east" :
            compN.style.display = "none";
            compS.style.display = "none";
            compE.style.display = "block";
            compW.style.display = "none";
            break;

        case "west" :
            compN.style.display = "none";
            compS.style.display = "none";
            compE.style.display = "none";
            compW.style.display = "block";
            break;
    }
}

// Chat
// Fonction pour envoi du message
btnChat.addEventListener('click', () =>{
    var messageError;

    // 1. Vérification des champs
    if(chatText.value == ""){
        messageError = 1;
    }

    else{       
        messageError = 0;
    }

    if(messageError == 0){
        xhr = new XMLHttpRequest();
        var param = "message=" + encodeURIComponent(chatText.value);
        param += "&typeMessage=" + encodeURIComponent(typeMsg.value);

        xhr.onreadystatechange = () => {
            // Si pas de problème ==> Effacement du chat
            if(xhr.readyState==4 && xhr.status==200)
            {
                chatText.value="";
            }
        };
        xhr.open("POST","chat.php");
        xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        xhr.send(param);
    }
});

// Fonction pour charger les messages à intervalle régulier
function loadChat(){
    var xhr=new XMLHttpRequest();
    chat.innerHTML = "";

    xhr.onreadystatechange = () =>{
        if(xhr.readyState==4 && xhr.status==200)
        {
            var message = xhr.responseXML.getElementsByTagName("playerMsg");
            for(var i= message.length - 1; i>=0; i--){
                var login = message[i].getElementsByTagName("playerLogin")[0].firstChild.nodeValue;
                var content = message[i].getElementsByTagName("content")[0].firstChild.nodeValue;
                var time = message[i].getElementsByTagName("time")[0].firstChild.nodeValue;
                displayMessage(login, content, time);
            }
        }
    };
    setTimeout(loadChat,3000);                            
    xhr.open("POST","chatbox.php");
    xhr.send(null);
}

// Fonction pour afficher les messages chat
function displayMessage(login ,content, time)
{
  var divMessage = document.createElement("div");
  var divChatMessage = document.createElement("div");

  time = new Date(time*1000);
  divMessage.innerHTML="["+time.getHours()+":"+time.getMinutes()+"] "+"<em>"+login+"</em>"+" a dit : " + content;

  divChatMessage.appendChild(divMessage);
  chat.appendChild(divChatMessage); 
}

// Fonction pour activer le jeu 
function startGame(){
    // Chargement des images
    loadImage(defaultTheme);
    displayMaze(defaultTheme);
    
};

// S'assurer du chargement de certains éléments
window.onload = () =>{
    loadChat();
};

// NOTE COURS ET DIVERS
/*
Alors déjà Ajax qu’est-ce que ça signifie ?
C’est un acronyme, qui veut dire Asynchonous JavaScript And XML, ça veut dire communication entre JavaScript et XML de façon asynchrone, sans attendre la réponse.
En d'autres termes : 
Ajax permet de modifier partiellement la page affichée par le navigateur sans avoir besoin de recharger la page entière. 
Avec cette technique l’envoi des données se fait silencieusement et Javascript permet de manipuler l’interface et d’afficher les données de manière dynamique

An Ajax http request has 5 states as your reference documents:

0   UNSENT  open() has not been called yet.
1   OPENED  send() has been called.
2   HEADERS_RECEIVED    send() has been called, and headers and status are available.
3   LOADING Downloading; responseText holds partial data.
4   DONE    The operation is complete.

Attention :
Ajax est une technique largement répondu mais les nouvelles technologies de développement frontend comme React & Angular, 
qui sont basées sur les Websockets , rendent son utilisation de moins en moins importante
*/

