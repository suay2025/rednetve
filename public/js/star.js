// script.js
var pE
var p
var nE
var n
var container
var container1
var contar = 0;
        
    var m = 0;
            document.querySelectorAll('.starV').forEach( elem => {
                
                elem.addEventListener('click', function(elem, e) {
                    
                    gfg(elem)
                });
            });

        // Funtion to update rating
        // function gfg(e, n) {
        function gfg(elem) {
            // console.log(elem.srcElement.attributes.product);
            // console.log(elem.srcElement.attributes.star);
            pE = elem.srcElement.attributes.product
            p = pE.value

            // console.log(p.value)
            nE = elem.srcElement.attributes.star
            n = nE.value
            container1 = document.querySelectorAll(`span[product='${p}']`);
            container = document.querySelectorAll(`.starV`);
            
            // let container = document.querySelector(".star");

            remove(container);
            for (let i = 0; i < n; i++) {
                // console.log(i)
                if (n == 1) cls = "one";
                else if (n == 2) cls = "two";
                else if (n == 3) cls = "three";
                else if (n == 4) cls = "four";
                else if (n == 5) cls = "five";
                // stars[i].className = "star " + cls;
                
                container[i].className = "starV " + cls;
            }
            let output = document.querySelector(`h5[output='${p}']`);
            output.innerText = "Valoracion: " + n + "/5";
        }

        // To remove the pre-applied styling
        function remove(container) {
            let i = 0;
            while (i < 5) {
                container[i].className = "starV";
                i++;
            }
        }