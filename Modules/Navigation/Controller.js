(function (skillet, undefined) {
    //Private Property
    var isHot = true;

    //Public Property
    skillet.ingredient = 'Bacon Strips';

    //Public Method
    skillet.fry = function () {
        var oliveOil;

        addItem('tn Butter nt');
        addItem(oliveOil);
        console.log('Frying ' + skillet.ingredient);
    };

    //Private Method
    function addItem(item) {
        if (item !== undefined) {
            console.log('Adding ' + item);
        }
    }

}(window.skillet = window.skillet || {}));

//Public Properties
console.log(skillet.ingredient); //Bacon Strips

//Public Methods
skillet.fry(); //Adding Butter & Fraying Bacon Strips

//Adding a Public Property
skillet.quantity = "12";
console.log(skillet.quantity); //12