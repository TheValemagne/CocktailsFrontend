
function modifierRecette($this){ // index_recette
  let index_recette = $this.attr('id');
  $.get("Fonctions/modifierRecette.php?recette=" + index_recette); // modifie la recette voulue

  if($this.attr('class') === "heart heartFilled"){
    $this.attr('class', "heart heartNotFilled");

    if(window.location.href.indexOf("index.php?page=recettes") > 0){
      $this.parents('.card').remove(); // div .card

      if($('.card-deck').children().length === 0){
        $('.card-deck').remove();
        $('main').append( "<p>Aucune recette préférée pour l'instant</p>" );
      }
    }
  } else {
    $this.attr('class', "heart heartFilled");
  }
}

$(document).ready(function() {
  $('svg').click(function(){
    modifierRecette($(this));
  });
});
