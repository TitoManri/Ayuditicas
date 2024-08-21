let etiquetas = [];
function listarEtiquetas() {
    $.ajax({
        url: '../controllers/etiquetasController.php?op=listar_etiquetas',
        type: 'GET',
        dataType: 'json',
        success: function (responseSelect) {
            $.each(responseSelect, function (index, etiqueta) {
                etiquetas[index] = etiqueta.nombre_etiqueta;
            });
            rellenarEtiquetas();
        },
        error: function (error) {
            console.error('Error al obtener las opciones:', error);
        }
    });
}

function rellenarEtiquetas() {
    var input = document.getElementById('tags');
    var tagify = new Tagify(input, {
        maxTags: 3,
        whitelist: etiquetas,
        delimiters: ",| ",
        dropdown: {
            position: "manual",
            maxItems: Infinity,
            enabled: 0,
            classname: "customSuggestionsList"
        },
        enforceWhitelist: true
    })

    tagify.on("dropdown:show", onSuggestionsListUpdate)
          .on("dropdown:hide", onSuggestionsListHide)
          .on('dropdown:scroll', onDropdownScroll)

    renderSuggestionsList()

    // ES2015 argument destructuring
    function onSuggestionsListUpdate({ detail:suggestionsElm }){
        console.log(  suggestionsElm  )
    }

    function onSuggestionsListHide(){
        console.log("hide dropdown")
    }

    function onDropdownScroll(e){
        console.log(e.detail)
      }

    // https://developer.mozilla.org/en-US/docs/Web/API/Element/insertAdjacentElement
    function renderSuggestionsList(){
        tagify.dropdown.show.call(tagify) // load the list
        tagify.DOM.scope.parentNode.appendChild(tagify.DOM.dropdown)
    }
}

$(function () {
    listarEtiquetas();
    console.log(etiquetas);
});

