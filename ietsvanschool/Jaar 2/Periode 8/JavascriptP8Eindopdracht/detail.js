$(document).ready(function () {
    let getHref = (new URL(window.location.href)).searchParams;
    let id = parseInt(getHref.get('id'));
    function loadPage() {
    let endpoint = `https://pokeapi.co/api/v2/pokemon/${id}`;
    function capitalize(string){
        return string.charAt(0).toUpperCase() + string.slice(1);
    }
    $.ajax({
        url : endpoint,
        success: function (result) {
            console.log(result);

            $('#main').html(`<p>${id}. ${capitalize(result.name)}</p>`);
            $('#ima').html(`<img src="${result.sprites.front_default}">`);
            $("#type").empty();
            $.each(result.types, function (i) {                
                $('#type').append(`${capitalize(result.types[i].type.name)}<br>`);
            })            
            $("#ability").empty();
            $.each(result.abilities, function (i) {                
                $('#ability').append(`${capitalize(result.abilities[i].ability.name)}<br>`);
            })
            $('#hp').html(`Hp: ${result.stats[0].base_stat}`);
            $('#def').html(`Defence: ${result.stats[1].base_stat}`);
            $('#spdef').html(`Special Defence: ${result.stats[2].base_stat}`);
            $('#atk').html(`Attack: ${result.stats[3].base_stat}`);
            $('#spatk').html(`Special Attack: ${result.stats[4].base_stat}`);
            $('#spd').html(`Speed: ${result.stats[5].base_stat}`);

        }
    })
}
loadPage();
    $('#next').on('click', function(){
        id++;
        loadPage();
    }); 
    $('#previous').on('click', function(){
        id--;
        loadPage();
    }); 
});
$(document).on('click', '#home', function () {
    window.location.replace("pokeapi.html");
});