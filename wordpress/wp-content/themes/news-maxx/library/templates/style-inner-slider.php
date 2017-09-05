 <style media="screen">
    .custom-post-template .nombre-categoria{
      color:#00b643;
      border-bottom: 2px solid #00b643;
      padding: 5px 0;
      font-family: 'Roboto-regular';
      font-size: 1.2em;
      margin: 30px 0;
    }

    .custom-post-template .subtitulo{
      color:#00b643;
      font-family: 'Condensed-regular';
      font-size: 1.2em;
      margin: 10px 0;
    }

    .custom-post-template h1{
      color:black;
      font-size: 3em;
      font-family: 'Condensed-bold-italic';
      margin: 20px 0 40px 0;
	  margin-bottom:20px;
	  margin-top:20px;
    }

    .custom-post-template .thumbnail-container{
      /*background-image: repeating-linear-gradient( -45deg,   #e4e4e4,   #e8e8e8 5px,   #dcdcdc 5px,   #dcdcdc 10px );*/
	  background-image:url("<?php echo get_template_directory_uri(); ?>/img/fondo-post-cuna.jpg");
	  background-size:cover;
      position: relative;
      
      overflow: hidden;
      border: 2px solid black;
	  text-align:center;
    }

    .custom-post-template .thumbnail-container img{
      /*position: absolute;*/
      left: 0;
      right: 0;
      margin:auto;
	  max-width:100%;
    }

    .custom-post-template .post-content-text{
      color:#5c585d;
      font-family: 'Roboto-regular';
	  font-size:1.2em;
    }
	
	.custom-post-template .post-content-text p{
		margin-bottom:0;
		text-indent:15px;
	}
	
	.custom-post-template .post-content-text a{
		font-family:Roboto-bold;
		text-decoration:underline !important;
		transition:0.5s;
	}
	.custom-post-template .post-content-text a:hover{
		color:#00b643;
		transition:0.5s;
	}
	
	.custom-post-template .post-content-text p b,.custom-post-template .post-content-text p strong{
		font-weight:100;
		font-family:Roboto-bold;
	}

    .custom-post-template .post-left-colum > div{
      padding: 20px 0;
    }
    .custom-post-template .post-left-colum .fuente img{
      max-width: 30px;
    }

    .custom-post-template .post-left-colum .fuente p{
      color:#006443;
      font-family: 'Condensed-bold-italic';
    }

    .custom-post-template .post-left-colum .title-left-colum{
      /*border: 1px solid black;*/
	  border-bottom: #b2b2b2 1px solid;
      font-family: 'Condensed-bold-italic';
      color:#b2b2b2;
      font-size: 13px;
    }

    .custom-post-template .post-left-colum .tags label a {
      color:#a43c93;
      font-family: 'Roboto-regular';
      display: inline;
	  font-size:14px;
	  font-weight:initial;
    }

    .custom-post-template .post-left-colum .related p.relacionados{
      color:#a43c93;
      font-size: 'Roboto-regular';
      border-bottom: 1px solid #5c585d;
    }

      .custom-post-template .post-left-colum .related p.relacionados:last-child{
        border: none;
      }

    .custom-post-template .post-left-colum .related p.relacionados span{
      font-size: .8em;
    }

    .custom-post-template .widget{
      padding: 50px 20px 0 20px;
    }

    .custom-post-template .thumbnail-title{
      padding: 10px 0;
    }

    .custom-post-template .thumbnail-title p{
      color:black;
      font-family: 'Condensed-bold-italic';
      font-size: 1.1em;
    }
	
	.gallery-caption{
		width:100%; background-color:black;color:white;		
		padding:10px;
		margin-top:5px;
	}
	.owl-wrapper-outer{
		padding-left:0;		
	}
	
	.owl-carousel .owl-wrapper {
  display: table !important;
}
.main-section .owl-carousel .owl-item {
  display: table-cell;
  float: none;
  vertical-align: center;
  padding-bottom:20px;
}

.gallery-caption{position:absolute;bottom:-20px;}
.gallery-item{margin:0;}

.gallery-icon{padding-bottom:20px;padding-top:10px;}

.gallery{display:none;}
.gallery~ul{display:none;}

  </style>
