$(window).load( function(){

});

$(document).ready( function(){


});

$(window).bind('load', function()
{



});




function SameHeight(){
  //console.log("entra same height");

  var auxId=1;
  while($( "[hid="+auxId+"]" ).length||auxId<20){
    var hidHeight=0;
    //ResetHeight();
    $("[hid="+auxId+"]").each(function(){
      if($(this).innerHeight()>hidHeight){
        hidHeight= $(this).innerHeight();
      }

    });
    //console.log(hidHeight);
    $("[hid="+auxId+"]").css("height",hidHeight+"px");
    auxId++;
  }
}

function unic_height(){
  //console.log("entra same height");

  // var auxId=1;
  // while($( ".listTercio" ).length){
    var hidHeight=0;
    //ResetHeight();
    $(".listTercio").each(function(){
      if($(this).innerHeight()>hidHeight){
        hidHeight= $(this).innerHeight();
      }

    });
    //console.log(hidHeight);
    $(".listTercio").css("height",hidHeight+"px");
    // auxId++;
  // }
}


function ResetHeight(){
  var id=1;
  while($( "[hid="+id+"]" ).length||id<20){

    $("[hid="+id+"]").css("height","auto");
    id++;
}
}


	var postOffset=10;
var postCategory=0;
