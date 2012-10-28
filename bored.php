 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta name="organization" content="Living Church of God - Kansas City" />
	<meta name="description" content="LCG Kansas City Regional Family Weekend (KC Weekend)" />
	
	<link rel="stylesheet" href="css/main.css" type="text/css" media="screen" />

	<title>The Living Church of God - Kansas City Regional Family Weekend</title>
	<style media="screen">
    
    .container {
      width: 200px;
      height: 200px;
      position: relative;
      margin: 0 auto 40px;
      border: 1px solid #CCC;
      -webkit-perspective: 1200;
         -moz-perspective: 1200;
          -ms-perspective: 1200;
           -o-perspective: 1200;
              perspective: 1200;
    }
    
    #cube {
      width: 100%;
      height: 100%;
      position: absolute;
      -webkit-transform-style: preserve-3d;
         -moz-transform-style: preserve-3d;
          -ms-transform-style: preserve-3d;
           -o-transform-style: preserve-3d;
              transform-style: preserve-3d;
      -webkit-transform: translateZ( -100px );
         -moz-transform: translateZ( -100px );
          -ms-transform: translateZ( -100px );
           -o-transform: translateZ( -100px );
              transform: translateZ( -100px );
    }

    #cube.spinning {
      -webkit-animation: spinCube 3s infinite;
    }
    
    @-webkit-keyframes spinCube {
        0% { -webkit-transform: translateZ( -100px ) rotateX(  -10deg ) rotateY(   0deg ); }
      50%  { -webkit-transform: translateZ( -100px ) rotateX(   10deg ) rotateY( 360deg ); }
      100% { -webkit-transform: translateZ( -100px ) rotateX(  -10deg ) rotateY(   0deg ); }
    }
    
    #cube figure {
      display: block;
      position: absolute;
      width: 196px;
      height: 196px;
      border: 2px solid black;
      line-height: 196px;
      font-size: 120px;
      font-weight: bold;
      color: white;
      text-align: center;
    }
    
    #cube.panels-backface-invisible figure {
      -webkit-backface-visibility: hidden;
         -moz-backface-visibility: hidden;
          -ms-backface-visibility: hidden;
           -o-backface-visibility: hidden;
              backface-visibility: hidden;
    }
    
    #cube .front  { background: hsla(   0, 100%, 50%, 0.7 ); }
    #cube .back   { background: hsla(  60, 100%, 50%, 0.7 ); }
    #cube .right  { background: hsla( 120, 100%, 50%, 0.7 ); }
    #cube .left   { background: hsla( 180, 100%, 50%, 0.7 ); }
    #cube .top    { background: hsla( 240, 100%, 50%, 0.7 ); }
    #cube .bottom { background: hsla( 300, 100%, 50%, 0.7 ); }

    #cube .front  {
      -webkit-transform: translateZ( 100px );
         -moz-transform: translateZ( 100px );
          -ms-transform: translateZ( 100px );
           -o-transform: translateZ( 100px );
              transform: translateZ( 100px );
    }
    #cube .back {
      -webkit-transform: rotateY(   180deg ) translateZ( 100px );
         -moz-transform: rotateY(   180deg ) translateZ( 100px );
          -ms-transform: rotateY(   180deg ) translateZ( 100px );
           -o-transform: rotateY(   180deg ) translateZ( 100px );
              transform: rotateY(   180deg ) translateZ( 100px );
    }
    #cube .right {
      -webkit-transform: rotateY(   90deg ) translateZ( 100px );
         -moz-transform: rotateY(   90deg ) translateZ( 100px );
          -ms-transform: rotateY(   90deg ) translateZ( 100px );
           -o-transform: rotateY(   90deg ) translateZ( 100px );
              transform: rotateY(   90deg ) translateZ( 100px );
    }
    #cube .left {
      -webkit-transform: rotateY(  -90deg ) translateZ( 100px );
         -moz-transform: rotateY(  -90deg ) translateZ( 100px );
          -ms-transform: rotateY(  -90deg ) translateZ( 100px );
           -o-transform: rotateY(  -90deg ) translateZ( 100px );
              transform: rotateY(  -90deg ) translateZ( 100px );
    }
    #cube .top {
      -webkit-transform: rotateX(   90deg ) translateZ( 100px );
         -moz-transform: rotateX(   90deg ) translateZ( 100px );
          -ms-transform: rotateX(   90deg ) translateZ( 100px );
           -o-transform: rotateX(   90deg ) translateZ( 100px );
              transform: rotateX(   90deg ) translateZ( 100px );
    }
    #cube .bottom {
      -webkit-transform: rotateX(  -90deg ) translateZ( 100px );
         -moz-transform: rotateX(  -90deg ) translateZ( 100px );
          -ms-transform: rotateX(  -90deg ) translateZ( 100px );
           -o-transform: rotateX(  -90deg ) translateZ( 100px );
              transform: rotateX(  -90deg ) translateZ( 100px );
    }
    
  </style>

	<? include ('google-analytics.php'); ?>
</head>
<body>

	<h1>Bored? Then think about how this was programmed only using CSS3...</h1>

	<section class="container">
	<div id="cube" class="spinning">
	  <figure class="front">1</figure>
	  <figure class="back">2</figure>
	  <figure class="right">3</figure>
	  <figure class="left">4</figure>
	  <figure class="top">5</figure>
	  <figure class="bottom">6</figure>
	</div>
	</section>

	<!-- End of Main Content Area -->

	<br/><br/><br/><br/><br/><br/>
	<!-- Add the header to each page -->
	<? include ('footer.php'); ?>

</body>
</html>