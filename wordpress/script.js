$(window).load( function(){

});

$(document).ready( function(){
console.log("Script cargado");
SameHeight();
slider();
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

function slider(){

    var index=0;
    $('.tabla-anios-jugador .cuerpo-tabla').eq(0).fadeIn();
    var currentIndex = 0,
      items = $('.tabla-anios-jugador .cuerpo-tabla'),
      itemAmt = items.length;

    function cycleItems() {
      var item = $('.tabla-anios-jugador .cuerpo-tabla').eq(currentIndex);
      items.hide();
      item.fadeIn("slow");
    }



    $('.menu-anios nav p').click(function() {
      $('.menu-anios nav p').removeClass('selected');
      $(this).addClass('selected');
      currentIndex=$(this).index();

      cycleItems();
    });


}
