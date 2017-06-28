$(window).load( function(){

});

$(document).ready( function(){
console.log("Script cargado");
SameHeight();
slider('.jugadores-container-ranking','.contenido-1' );
slider('.menu-2','.jugadores-muchosjugadores' );
slider('.menu-anios','.cuerpo-tabla' );
});

$(window).bind('load', function()
{



});




function SameHeight(){
  var auxId=1;
  while($( "[hid="+auxId+"]" ).length||auxId<20){
    var hidHeight=0;
    $("[hid="+auxId+"]").each(function(){
      if($(this).innerHeight()>hidHeight){
        hidHeight= $(this).innerHeight();
      }

    });

    $("[hid="+auxId+"]").css("height",hidHeight+"px");
    auxId++;
  }
}

function unic_height(){

    var hidHeight=0;

    $(".listTercio").each(function(){
      if($(this).innerHeight()>hidHeight){
        hidHeight= $(this).innerHeight();
      }

    });

    $(".listTercio").css("height",hidHeight+"px");

}


function ResetHeight(){
  var id=1;
  while($( "[hid="+id+"]" ).length||id<20){

    $("[hid="+id+"]").css("height","auto");
    id++;
  }
}

function slider(padreMenu,padreContenedor ){

  //if(padreMenu==null && padreContenedor==null){padreMenu=''; padreContenedor='';}

    var index=0;
    $(padreContenedor+'.contenido-dinamico').eq(0).fadeIn();
    var currentIndex = 0,
      items = $(padreContenedor+'.contenido-dinamico'),
      itemAmt = items.length;

    function cycleItems() {
      var item = $(padreContenedor+'.contenido-dinamico').eq(currentIndex);
      items.hide();
      item.fadeIn("slow");
    }



    $(padreMenu+'.menu-dinamico nav p').click(function() {
      $(padreMenu+'.menu-dinamico nav p').removeClass('selected');
      $(this).addClass('selected');
      currentIndex=$(this).index();

      cycleItems();
    });


}
