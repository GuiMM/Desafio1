'use strict';

var myApp = {};


myApp.alunos =undefined;

myApp.validar = function () {
    var matricula = form1.matricula.value;
    var re = /[0-9]{6}$/;
    var OK = re.exec(matricula);
    if (matricula == "") {    
        alert("Preencha o campo de matricula");
        form1.matricula.focus();
        return false;
    }else if (!OK){  
          window.alert(RegExp.input + " não é uma matrícula válida");
          form1.matricula.focus();
          return false;
         }
}
myApp.run = function()
{
   myApp.validar();
    
}


window.onload = myApp.run;

