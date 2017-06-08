'use strict';

var myApp = {};


myApp.alunos =undefined;

myApp.validar = function () {
    var matricula = form1.matricula.value;
    var re = /[0-9]{8}/;
    var OK = re.exec(matricula);
    if (matricula == "") {
        alert('Preencha o campo de matricula');
        form1.matricula.focus();
        return false;
    }else if (!OK){  
          window.alert(RegExp.input + " não é uma matrícula válida");
          form1.matricula.focus();
          return false;
         }else{
                window.alert("Obrigado, sua matricula é: " + OK[0]);
         }
}
 myApp.loadData = function(file)
    {
      d3.csv(file, function(d, i, columns) {
            Object.keys(d).forEach(function(key){
                if (!isNaN(+d[key])) d[key] = +d[key]
            })
            return d;
        }, function(error, data) {
        if (error) throw error;

            myApp.alunos=data;        

        });

    }

myApp.run = function()
{
    myApp.loadData("./datasets/alunos.csv");
    
    
}


window.onload = myApp.run;