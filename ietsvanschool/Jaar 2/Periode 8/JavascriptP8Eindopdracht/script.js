$(document).ready(function () {
    let offset = 0;
    let limit = 20;
    function capitalize(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }
    function loadPage() {
        let endpoint = `https://pokeapi.co/api/v2/pokemon/?limit=${limit}&offset=${offset * limit}`;
        $.ajax({
            url: endpoint,
            success: function (result) {
                console.log(result);
                $("#test").empty();

                $.each(result.results, function (index, value) {
                    console.log(index);
                    let id = offset * limit + index + 1;
                    $('#test').append(`<div class="pokemons" id="${id}"></div>`);
                    $(`#${id}`).append(`<div> <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/${id}.png">`);
                    $(`#${id}`).append(`<div> ${id}. ${capitalize(result.results[index].name)} </div>`);
                })
            }
        })
    }
    loadPage();
    $('#next').on('click', function () {
        offset++;
        loadPage();
    });
    $('#previous').on('click', function () {
        if (offset >= 1) {
            offset--;
            loadPage();
        }
    });
    $(document).on('click', '.pokemons', function () {
        window.location.replace("detail.html?id=" + $(this)[0].id);
    });
});