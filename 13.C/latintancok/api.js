function betolt1(){
            fetch("index.php", {
            method:"POST",
            headers:{"Content-Type":"application/json"},
            body: JSON.stringify({feladat:"2"})
        })
        .then(r => r.text())
        .then(t => {
            console.log("PHP válasz:", t);
            let d = JSON.parse(t);
            document.getElementById("betolt1").innerHTML = d.message;
        })
    }

function feladat2() {
    fetch("index.php", {
        method: "POST",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify({feladat: "2"})
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById("e2").innerHTML = 
            "<p>Első: " + data.elso + "<br>" +
            "Utolsó: " + data.utso + "</p>";
    })
    .catch(error => {
        document.getElementById("e2").innerHTML = "Hiba történt";
    });
}
function feladat3()
{
    
}
function feladat4()
{
    
}
function feladat5()
{
    
}
function feladat6()
{
    
}
function feladat7()
{
    
}