$(window).load( function(){
  // SameHeight();
});

$(document).ready( function(){
  console.log("Script cargado");
  SameHeight();

  _square();


  copy_size();
  get_post();close_modal();
});


$(window).on('load', function(){
	ResetHeight();
	SameHeight();
	slider('.jugadores-container-ranking','.contenido-1' );
  slider('.menu-2','.jugadores-muchosjugadores' );
  slider('.menu-anios','.cuerpo-tabla' );
  // slider_get_post();

  // slider('.img-sector-padre', "nada");
  _square();
  gallerie_swipe();
  menu();
  copy_size();
  NotaCarousel();
});



$(window).on('resize', function(){

   _square();
   copy_size();
})


function _openmodal(){


  $('.container-gallery  div.max-box-gallery').on('click', function(){

    cursor=0;
    // console.log($(this));
    //
    // return;
    var indx=$(".container-gallery  div.max-box-gallery").index(this);


    var element = ListElements[indx];

    $('.modal-gallery .info-sector .title').html(element.title);
    $('.modal-gallery .info-sector .volanta').html(element.volanta);
    // $('.modal-gallery .info-sector .content').empty();
    $('.modal-gallery .info-sector .content').html(element.content);
    $('.modal-gallery .info-sector .notas').html(element.category+" / "+element.notes);
    $('.modal-gallery .info-sector title').html(element.title);
    $('.modal-gallery .img-sector img').attr('src',  element.images[cursor]);
    $('.modal-gallery .img-sector .prev-image').attr('id',  indx);
    $('.modal-gallery .img-sector .next-image').attr('id',  indx);


    $('.next-image').on("click", function(){

        var elem = $(this).attr('id');
        console.log(elem);
        console.log(ListElements[elem].images);
      if(cursor < ListElements[elem].images.length-1){

        cursor++;
        console.log(cursor);
        a=cursor;
        a++;
        $('.modal-gallery .img-sector img').fadeOut();
        $('.modal-gallery .img-sector .nro-image').html(a);
        $('.modal-gallery .img-sector img').attr('src', ListElements[elem].images[cursor]);
        $('.modal-gallery .img-sector img').fadeIn();
      }

    })

    $('.prev-image').on("click", function(){

      var elem = $(this).attr('id');
      console.log(elem);
      console.log(ListElements[elem].images);

      if(cursor>0){

        cursor--;
        console.log(cursor);
        a=cursor;
        a++;
        $('.modal-gallery .img-sector img').fadeOut();
        $('.modal-gallery .img-sector img').attr('src', ListElements[elem].images[cursor]);
        $('.modal-gallery .img-sector .nro-image').text(a);
        $('.modal-gallery .img-sector img').fadeIn();

        }
      })


      $('.prev-post').on("click", function(){
        cursor=0;
        if(indx > 0){
          indx--;

          element = ListElements[indx];
          $('.modal-gallery .img-sector .nro-image').text('1');
          $('.modal-gallery .info-sector .title').html(element.title);
          $('.modal-gallery .info-sector .volanta').html(element.volanta);

          $('.modal-gallery .info-sector .content').html(element.content);
          $('.modal-gallery .info-sector .notas').html(element.category+" / "+element.notes);
          $('.modal-gallery .info-sector title').html(element.title);
          $('.modal-gallery .img-sector img').attr('src',  element.images[0]);
          $('.modal-gallery .img-sector .prev-image').attr('id',  indx);
          $('.modal-gallery .img-sector .next-image').attr('id',  indx);

          }
        })

      $('.next-post').on("click", function(){
        cursor=0;
        if(indx < ListElements.length-1 ){
          indx++;
          //mostrar los siguientes articulos

          element = ListElements[indx];
          $('.modal-gallery .img-sector .nro-image').text('1');
          $('.modal-gallery .info-sector .title').html(element.title);
          $('.modal-gallery .info-sector .volanta').html(element.volanta);
          $('.modal-gallery .info-sector .content').html(element.content);
          $('.modal-gallery .info-sector .notas').html(element.category+" / "+element.notes);
          $('.modal-gallery .info-sector title').html(element.title);
          $('.modal-gallery .img-sector img').attr('src',  element.images[0]);
          $('.modal-gallery .img-sector .prev-image').attr('id',  indx);
          $('.modal-gallery .img-sector .next-image').attr('id',  indx);

          }
        })



    $('.modal-gallery').fadeIn();

  })

  $("#close-modal").on("click", function(){
    $('.modal-gallery').fadeOut();
    $('.modal-gallery .info-sector .title').html('');
    $('.modal-gallery .info-sector .volanta').html('');
    $('.modal-gallery .info-sector .content').html('');
    $('.modal-gallery .info-sector .notas').html('');
    $('.modal-gallery .info-sector title').html('');
    $('.modal-gallery .img-sector img').attr('src',  '');
    $('.modal-gallery .img-sector img').attr('src',  '');
    $('.modal-gallery .img-sector .nro-image').text('');
  })



}



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

var index_post_slider;

function slider_get_post(){



      var index=0;
      $('.img-sector-padre > img').eq(0).fadeIn();
      var currentIndex = 0,
      index_post_slider=0,
        items = $('.img-sector-padre > img'),
        itemAmt = items.length;

        if(itemAmt==1){
          $(".button-img-post").css("opacity", "0.5").css("user-select", "none");
            $(".button-img-post").removeClass('next-image prev-image');
        }



      function cycleItems() {

        // console.log(currentIndex);
        var item = $('.img-sector-padre > img').eq(index_post_slider);
        items.hide();
        item.fadeIn("slow");


      }



      // $(padreMenu+'.menu-dinamico nav p').click(function() {
      //   $(padreMenu+'.menu-dinamico nav p').removeClass('selected');
      //   $(this).addClass('selected');
      //   currentIndex=$(this).index();
      //
      //   cycleItems();
      // });

  // });

      $('body').on("click", ".next-image", function() {



  	index_post_slider += 1;

    if (index_post_slider > itemAmt - 1) {

    index_post_slider = 0;

    }
    cycleItems();
  });

  $('body').on("click", ".prev-image",function() {
    // console.log("prev-psot");

    index_post_slider -= 1;
    if (index_post_slider < 0) {

      index_post_slider = itemAmt - 1;
    }
    cycleItems();


  });


}


function gallerie_swipe(){


  var initPhotoSwipeFromDOM = function(gallerySelector) {

    // parse slide data (url, title, size ...) from DOM elements
    // (children of gallerySelector)
    var parseThumbnailElements = function(el) {
        var thumbElements = el.childNodes,
            numNodes = thumbElements.length,
            items = [],
            figureEl,
            linkEl,
            size,
            item;

        for(var i = 0; i < numNodes; i++) {

            figureEl = thumbElements[i]; // <figure> element

            // include only element nodes
            if(figureEl.nodeType !== 1) {
                continue;
            }

            linkEl = figureEl.children[0]; // <a> element

            size = linkEl.getAttribute('data-size').split('x');

            // create slide object
            item = {
                src: linkEl.getAttribute('href'),
                w: parseInt(size[0], 10),
                h: parseInt(size[1], 10)
            };



            if(figureEl.children.length > 1) {
                // <figcaption> content
                item.title = figureEl.children[1].innerHTML;
            }

            if(linkEl.children.length > 0) {
                // <img> thumbnail element, retrieving thumbnail url
                item.msrc = linkEl.children[0].getAttribute('src');
            }

            item.el = figureEl; // save link to element for getThumbBoundsFn
            items.push(item);
        }

        return items;
    };

    // find nearest parent element
    var closest = function closest(el, fn) {
        return el && ( fn(el) ? el : closest(el.parentNode, fn) );
    };

    // triggers when user clicks on thumbnail
    var onThumbnailsClick = function(e) {
      console.log("asdasd");
        e = e || window.event;
        e.preventDefault ? e.preventDefault() : e.returnValue = false;

        var eTarget = e.target || e.srcElement;

        // find root element of slide
        var clickedListItem = closest(eTarget, function(el) {
            return (el.tagName && el.tagName.toUpperCase() === 'FIGURE');
        });

        if(!clickedListItem) {
            return;
        }

        // find index of clicked item by looping through all child nodes
        // alternatively, you may define index via data- attribute
        var clickedGallery = clickedListItem.parentNode,
            childNodes = clickedListItem.parentNode.childNodes,
            numChildNodes = childNodes.length,
            nodeIndex = 0,
            index;

        for (var i = 0; i < numChildNodes; i++) {
            if(childNodes[i].nodeType !== 1) {
                continue;
            }

            if(childNodes[i] === clickedListItem) {
                index = nodeIndex;
                break;
            }
            nodeIndex++;
        }



        if(index >= 0) {
            // open PhotoSwipe if valid index found
            openPhotoSwipe( index, clickedGallery );
        }
        return false;
    };

    // parse picture index and gallery index from URL (#&pid=1&gid=2)
    var photoswipeParseHash = function() {
        var hash = window.location.hash.substring(1),
        params = {};

        if(hash.length < 5) {
            return params;
        }

        var vars = hash.split('&');
        for (var i = 0; i < vars.length; i++) {
            if(!vars[i]) {
                continue;
            }
            var pair = vars[i].split('=');
            if(pair.length < 2) {
                continue;
            }
            params[pair[0]] = pair[1];
        }

        if(params.gid) {
            params.gid = parseInt(params.gid, 10);
        }

        return params;
    };

    var openPhotoSwipe = function(index, galleryElement, disableAnimation, fromURL) {
        var pswpElement = document.querySelectorAll('.pswp')[0],
            gallery,
            options,
            items;

        items = parseThumbnailElements(galleryElement);

        // define options (if needed)
        options = {

            // define gallery index (for URL)
            galleryUID: galleryElement.getAttribute('data-pswp-uid'),

            getThumbBoundsFn: function(index) {
                // See Options -> getThumbBoundsFn section of documentation for more info
                var thumbnail = items[index].el.getElementsByTagName('img')[0], // find thumbnail
                    pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
                    rect = thumbnail.getBoundingClientRect();

                return {x:rect.left, y:rect.top + pageYScroll, w:rect.width};
            }

        };

        // PhotoSwipe opened from URL
        if(fromURL) {
            if(options.galleryPIDs) {
                // parse real index when custom PIDs are used
                // http://photoswipe.com/documentation/faq.html#custom-pid-in-url
                for(var j = 0; j < items.length; j++) {
                    if(items[j].pid == index) {
                        options.index = j;
                        break;
                    }
                }
            } else {
                // in URL indexes start from 1
                options.index = parseInt(index, 10) - 1;
            }
        } else {
            options.index = parseInt(index, 10);
        }

        // exit if index not found
        if( isNaN(options.index) ) {
            return;
        }

        if(disableAnimation) {
            options.showAnimationDuration = 0;
        }

        // Pass data to PhotoSwipe and initialize it
        gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
        gallery.init();
    };

    // loop through all gallery elements and bind events
    var galleryElements = document.querySelectorAll( gallerySelector );

    for(var i = 0, l = galleryElements.length; i < l; i++) {
        galleryElements[i].setAttribute('data-pswp-uid', i+1);
        galleryElements[i].onclick = onThumbnailsClick;
    }

    // Parse URL and open gallery if it contains #&pid=3&gid=1
    var hashData = photoswipeParseHash();
    if(hashData.pid && hashData.gid) {
        openPhotoSwipe( hashData.pid ,  galleryElements[ hashData.gid - 1 ], true, true );
    }
};

// execute above function
initPhotoSwipeFromDOM('.my-gallery');

}

function _square(){
	//edit by fran, preguntar porque
	$(".square").each(function(){
		if($(this).attr("onlymobile")=="true"&&!isMobile){
			//console.log("entra poyo");
			 $(this).css('height', "auto");
		}else{
		var ancho = $(this).outerWidth();
		//console.log("ancho "+ancho);
	  $(this).css('height', ancho+"px");
		}
	});
	$(".rectangle").each(function(){
		if($(this).attr("onlymobile")=="true"&&!isMobile){
			//console.log("entra poyo");
			 $(this).css('height', "auto");
		}else{
		var ancho = $(this).outerWidth();
		//console.log("ancho "+ancho);
	  $(this).css('height', ancho*1.2+"px");

/*
	   $(".box-producir-2 > div > div > p" ).each(function( index ) {
		 var alto_div = ancho;
		 var alto_parrafo = $(this).height();
		 var alto=((alto_div/2)-(alto_parrafo/2));
		 console.log("alto "+alto);
		$(this).css("margin-top", alto+"px" );
	  });
	  */


	}
	});


}


function menu(){


  $("#open-menu").on("click", function(){
    // $(".menu-despegable").fadeIn();
    $(".menu-despegable").addClass( "menu-despegable-active" );
  })

  $("#close-menu").on("click", function(){
    // $(".menu-despegable").fadeOut();
    $(".menu-despegable").removeClass( "menu-despegable-active" );
  })
}

function copy_size(){

  $(".img-g-j").each(function() {

  var w=   $( this ).width();
  var h=   $( this ).height();

    $( this ).siblings(".cover-green-gallery").css("width", w+'px').css("height", h+'px');
});

  // console.log(w+"  "+h);
  //
  // $(".cover-green-gallery").css("width", w+'px');
  // $(".cover-green-gallery").css("height", h+'px');

}

function get_post(){



  $("body").on("click", ".get-post", function(){

    // $('.img-sector-padre img').eq(0).fadeIn();
    // // var currentIndex = 0,
    // index_post_slider=0;


    $('.modal-gallery').empty();
    console.log("asdasd");

  	 id_post=$(this).attr('id-post');

  	$.post( urlBase+'/ajax/',{id:id_post},function(data){

    $('.modal-gallery').append(data);

    $('.modal-gallery').fadeIn();

      slider_get_post();


  });

});


}

function NotaCarousel(){
	if($(".trio-cuna-cajon").length>0){
	try{
					console.log("entra?");
					$("trio-cuna-cajon#gallery-2 br").remove(); $("#gallery-2").owlCarousel({
						margin:50,
						loop:true,
						autoWidth:true,
						items:3
					});
	}catch(error)		{
		setTimeout(function(){NotaCarousel();},300);
	}
	}
}

function close_modal(){
  $("body").on("click", "#close-modal",function(){
    $('.modal-gallery').empty();
    $('.modal-gallery').fadeOut();

  })
};
