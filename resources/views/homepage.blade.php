@section('style')
  <style media="screen">
    @import url('https://fonts.googleapis.com/css?family=Raleway');
    .laptop {
  -webkit-perspective: 1800px;
  -moz-perspective: 1800px;
  perspective: 1800px;
  position: relative;
  top: 15em;
  margin: 0 auto;
  margin-top: -134px;
  width: 425px;
}

.laptop_a {
  position: relative;
  width: 100%;
  height: 269px;
  -webkit-transform-style: preserve-3d;
  -moz-transform-style: preserve-3d;
  transform-style: preserve-3d;
  -webkit-transition: -webkit-transform .20s;
  -moz-transition: -moz-transform .20s;
  transition: transform .20s;
  animation: spin 1.5s linear;
  -webkit-animation: spin 1.5s ease-in;
  -moz-animation: spin 1.5s linear;
  -o-animation: spin 1.5s linear;
  animation-fill-mode: forwards;
  transform-origin: 100% 100%;
  left: 12px;
}

.laptop_a>div, .front>div {
  display: inline-block;
  position: absolute;
}

.front {
  -webkit-transform-style: preserve-3d;
  -moz-transform-style: preserve-3d;
  transform-style: preserve-3d;
  -webkit-transform-origin: 0% 50%;
  -moz-transform-origin: 0% 50%;
  transform-origin: 0% 50%;
  -webkit-transition: -webkit-transform .20s;
  -moz-transition: -moz-transform .20s;
  transition: transform .20s;
  -webkit-transform: translate3d(0, 0, 1px);
  -moz-transform: translate3d(0, 0, 1px);
  transform: translate3d(0, 0, 1px);
  z-index: 10;
  -webkit-animation: bg_n 1.5s ease-in;
  -moz-animation: bg_n 1.5s ease-in;
  -animation: bg_n 1.5s ease-in;
  animation-fill-mode: forwards
}

.front>div {
  position: absolute;
  -webkit-backface-visibility: hidden;
  -moz-backface-visibility: hidden;
  backface-visibility: hidden;
  -webkit-transform-style: preserve-3d;
  -moz-transform-style: preserve-3d;
  transform-style: preserve-3d;
  top: 0;
  left: 0;
  background: #ccc;
}

.front, .back, .front {
  width: 400px;
  border: 2px solid #777;
  border-radius: 1em;
  padding: 1em;
}

.front iframe {
  width: 100%;
  -webkit-animation: opc 2.0s ease-in;
  -moz-animation: opc 2.0s ease-in;
  animation: opc 2.0s ease-in;
  animation-fill-mode: forwards;
  border: 1px solid rgba(0, 0, 0, 0.1);
}

.top {
  width: 434px;
  height: 2px;
  top: 11px;
}

.back {
  -webkit-transform: rotate3d(0, 1, 0, -180deg) translate3d(0, 0, 1px);
  -moz-transform: rotate3d(0, 1, 0, -180deg) translate3d(0, 0, 1px);
  transform: rotate3d(0, 1, 0, -180deg) translate3d(0, 0, 1px);
}

.top {
  -webkit-transform: rotate3d(1, 0, 0, 90deg);
  -moz-transform: rotate3d(1, 0, 0, 90deg);
  transform: rotate3d(1, 0, 0, 90deg);
}

.back {
  z-index: 1;
}

.front {
  background-color: #fff;
}

.back {
  background-color: #999;
}

.viewback {
  -webkit-transform-origin: center center;
  -webkit-transform: rotate3d(0, 1, 0, 180deg) translate3d(0, 0, 0px);
  -moz-transform: rotate3d(0, 1, 0, 180deg) translate3d(0, 0, 0px);
  transform: rotate3d(0, 1, 0, 180deg) translate3d(0, 0, 0px);
}

.bottom {
  background: #fff;
  border: 2px solid #777;
  border-radius: 0 0 1em 1em;
  content: " ";
  display: block;
  position: absolute;
  padding: 0.3em;
  left: -22px;
  top: 257px;
  z-index: 100;
  width: 465px;
  box-shadow: 0 3px 4px #DFDFDF;
}

.bottom:before {
  background: #777;
  border-radius: 0 0 0.3em 0.3em;
  content: " ";
  display: block;
  position: absolute;
  padding: 0.15em 2.45em;
  left: 43%;
  z-index: 101;
  top: 0px;
}

/* ANIM */

@keyframes spin {
  from {
    transform: rotateX(-81deg);
  }
  to {
    transform: rotateX(0deg);
  }
}

@-webkit-keyframes spin {
  from {
    -webkit-transform: rotateX(-79deg);
  }
  to {
    -webkit-transform: rotateX(0deg);
  }
}

@-moz-keyframes spin {
  from {
    -moz-transform: rotateX(-81deg);
  }
  to {
    -moz-transform: rotateX(0deg);
  }
}

@-ms-keyframes spin {
  from {
    -o-transform: rotateX(-81deg);
  }
  to {
    -o-transform: rotateX(0deg);
  }
}

@-webkit-keyframes bg_n {
  from {
    background-color: #ccc;
  }
  to {
    background-color: #fff;
  }
}

@-moz-keyframes bg_n {
  from {
    background-color: #ccc;
  }
  to {
    background-color: #fff;
  }
}

@keyframes bg_n {
  from {
    background-color: #ccc;
  }
  to {
    background-color: #fff;
  }
}

@keyframes opc {
  0% {
    opacity: 0;
  }
  25% {
    opacity: 0;
  }
  50% {
    opacity: 0;
  }
  85% {
    opacity: 0;
  }
  100% {
    topacity: 1;
  }
}

@-moz-keyframes opc {
  0% {
    opacity: 0;
  }
  25% {
    opacity: 0;
  }
  50% {
    opacity: 0;
  }
  85% {
    opacity: 0;
  }
  100% {
    topacity: 1;
  }
}

@-webkit-keyframes opc {
  0% {
    opacity: 0;
  }
  25% {
    opacity: 0;
  }
  50% {
    opacity: 0;
  }
  85% {
    opacity: 0;
  }
  100% {
    topacity: 1;
  }
}

/* button div */

#buttons {
  /*padding-top: 235px;*/
  text-align: center;
  align-items: center;
  position: relative;
}

.backgg h4 {
  text-align: center;
  align-items: center;
  position: relative;
}

.backgg h2 {
  padding-top: 235px;
  text-align: center;
  align-items: center;
  position: relative;
}

/* start da css for da buttons */

.butn {
  border-radius: 5px;
  padding: 15px 25px;
  font-size: 22px;
  text-decoration: none;
  margin: 20px;
  color: #fff !important;
  position: relative;
  display: inline-block;
}

.butn:hover {
  text-decoration: none;
  color: #fff !important;
}

.butn:active {
  transform: translate(0px, 5px);
  -webkit-transform: translate(0px, 5px);
  box-shadow: 0px 1px 0px 0px;
  color: #fff !important;
}

.green {
  background-color: #2ecc71;
  box-shadow: 0px 5px 0px 0px #15B358;
}

.green:hover {
  background-color: #48E68B;
}

.orange {
  background-color: #e67e22;
  box-shadow: 0px 5px 0px 0px #CD6509;
}

.orange:hover {
  background-color: #FF983C;
}

.backgg {
  position: relative;
  background-image: url(http://blog.visme.co/wp-content/uploads/2017/07/50-Beautiful-and-Minimalist-Presentation-Backgrounds-08.jpg);
  background-size: cover;
  background-repeat: no-repeat;
  height: 659px;
}

.howto {
  padding: 2em;
  background: #FFFFFF;
  min-height: 100vh;
}

.howto h2 {
  text-align: center;
  text-rendering: optimizeLegibility;
  font-size: 3em;
}

.square p {
  margin-top: 0.375rem;
  margin-bottom: 1.8rem;
  font-weight: 700;
  font-size: 1.4rem;
}

.square, .info {
  text-align: center;
}

.info i {
  margin-right: 10px;
  opacity: 0.5;
}

.info i:hover {
  cursor: pointer;
}

.info {
  padding-top: 15px;
  margin-bottom: 15px;
  color: #2242a4;
}

i {
  color: #243f8a;
}

.square:hover img {
  transform: rotate(15deg);
}

body {
  font-size: 14px;
  line-height: 1.5;
  color: #333;
  min-height: 100%;
  position: relative;
  width: 100%;
  height: 100%;
}

label {
  margin-bottom: 0;
}

a {
  color: #e1e1e1;
}

a:focus, a:hover {
  color: #008080;
}

.checkbox-inline+.checkbox-inline, .radio-inline+.radio-inline {
  margin-top: 6px;
}

body.login {
  background: rgba(255, 255, 255, 1);
}

.relative {
  position: relative;
}

.switcher {
  margin-bottom: 70px;
}

ul.switcher li {
  list-style-type: none;
  width: 50%;
  position: absolute;
  top: 0;
}

.first {
  left: 0;
}

.second {
  right: 0;
}

.login-container-wrapper {
  max-width: 400px;
  margin: 2% auto 5%;
  padding: 40px;
  box-sizing: border-box;
  background: rgba(57, 89, 116, 0.8);
  position: relative;
  box-shadow: 0px 30px 60px -5px #000;
  /* background-image:url('http://www.planwallpaper.com/static/images/colorful-triangles-background_yB0qTG6.jpg');
*/
  background-size: cover;
  background: #3C5668;
  background-blend-mode: saturation;
  align-items: center;
}

.login-container-wrapper .logo, .login-container-wrapper .welcome {
  font-size: 16px;
  letter-spacing: 1px;
}

.login-container-wrapper li {
  text-align: center;
  padding: 0 15px;
  background-color: #283443;
  height: 50px;
  line-height: 50px;
  box-shadow: inset 0 -2px 0 0 #ccc;
  cursor: pointer;
}

.login-container-wrapper li a {
  color: #fff !important;
}

.login-container-wrapper li a:hover {
  color: #ccc;
  text-decoration: none;
}

.login-container-wrapper li a:active, .login-container-wrapper li a:focus {
  color: #fff !important;
  text-decoration: none;
}

.login-container-wrapper li.active {
  background-color: transparent;
  box-shadow: none;
}

.login-container-wrapper li.active a {
  border-bottom: 2px solid #fff;
  padding-bottom: 5px;
}

.login-form input:focus+.fa {
  color: #25a08d;
}

.login-form .form-group {
  margin-right: 0;
  margin-left: 0;
}

.login-form i {
  position: absolute;
  top: 0;
  left: 19px;
  line-height: 52px;
  color: rgba(40, 52, 67, 1);
  z-index: 100;
  font-size: 16px;
}

.login-form .input-lg {
  font-size: 16px;
  height: 52px;
  padding: 10px 25px;
  border-radius: 0;
}

.login-form input[type="email"], .login-form input[type="password"], .login-form input[type="text"], .login-form input:focus {
  background-color: rgba(40, 52, 67, 0.75);
  border: 0px solid #4a525f;
  color: #eee;
  border-left: 45px solid #93a5ab;
  border-radius: 40px;
}

.login-form input:focus {
  border-left: 45px solid #eee;
}

input:-webkit-autofill, textarea:-webkit-autofill, select:-webkit-autofill {
  background-color: rgba(40, 52, 67, 0.75) !important;
  background-image: none;
  color: rgb(0, 0, 0);
  border-color: #FAFFBD !important;
}

.login-form .checkbox label, .login-form .checkbox a {
  color: #ddd;
  vertical-align: top;
}

input[type="checkbox"]:checked+label::before, .checkbox-success input[type="radio"]:checked+label::before {
  background-color: #25a08d !important;
}

.btn-success {
  background-color: #25a08d;
  background-image: none;
  padding: 8px 50px;
  margin-top: 20px;
  border-radius: 40px;
  border: 1px solid #25a08d;
  -webkit-transition: all ease 0.8s;
  -moz-transition: all ease 0.8s;
  transition: all ease 0.8s;
}

.btn-success:focus, .btn-success:hover, .btn-success.active, .btn-success.active:hover, .btn-success:active:hover, .btn-success:active:focus, .btn-success:active {
  background-color: #25a08d;
  border-color: #25a08d;
  box-shadow: 0px 5px 35px -5px #25a08d;
  text-shadow: 0 0 8px #fff;
  color: #FFF !important;
  outline: none;
}

.info img {
  margin-right: 10px;
  opacity: 0.5;
}

.info {
  padding-top: 15px;
  margin-bottom: 15px;
  color: #2242a4;
}

i {
  color: #243f8a;
}
</style>
@endsection
@extends('layouts.app')


@section('content')
<!-- Modal -->


<div class="backgg animated fadeInUpBig">
  	<div class="laptop">
		<div class="laptop_a laptop_def">
			<div class="front">
				<iframe width="400" height="225" src="https://www.youtube.com/embed/6RSmq2qV1bg?rel=0&amp;autoplay=1&amp;showinfo=0&amp;start=2" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
			</div>
			<div class="back"></div>
			<div class="top"></div>
		</div>
		<div class="bottom"></div>
	</div>
	<h2>What's hireITS?</h2>
	<h4>hireITS adalah website yang blablablablablablablablab untuk anak ITS yang ingin mencari uang hajajaj</h4>
</div>

<div class="howto animated fadeInDownBig">
	<h2>How to use hireITS?</h2>
	<div class="">
      <div class="info">
      	<div id="buttons">
    		<a class="butn green" val="maker" >I'm a job maker</a>
			<a class="butn orange" val="seeker">I'm a job seeker</a>
		</div>
         <!--  <i class="" val="maker" style="font-size:60px;" data-toggle="tooltop" title="Job Maker"></i>
          <i class="fa fa-user" val="seeker" style="font-size:60px;" data-toggle="tooltop" title="Students"></i> -->
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="square">
        	<h3>Sign Up</h3>
          <img src="followers.png" alt="" width="170">
          <p>Apply for a legitible account to start.</p>
        </div>
      </div>
      <div class="col-md-4 maker" >
        <div class="square">
        	<h3>Post</h3>
          	<img src="invoice.png" alt="" width="170">
          	<p>Post your projects so freelancers will be able to browse.</p>
        </div>
      </div>
      <div class="col-md-4 seeker" style="display:none">
        <div class="square">
        	<h3>Search</h3>
        	<img class="fa fa-search" aria-hidden="true" src="search.png" alt="" width="170">
          <!-- <i class="fa fa-search" aria-hidden="true" style="font-size:89px;"></i> -->
          <p>Browse freely through many projects available accustomed to your likings.</p>
        </div>
      </div>
      <div class="col-md-4 ">
        <div class="square">
        	<h3>Discuss</h3>
          <img src="chat.png" alt="" width="170">
          <p>Negotiate bids, ideas and requirements with end user.</p>
        </div>
      </div>
  </div>
</div>


@endsection

@section('script')
<script type="text/javascript">

  $('[data-toggle="tooltip"]').tooltip();

  $(".info a.green").css('opacity','1');

  $('.info a').click(function(){
  var role = $(this).attr('val');

  $('.row').animateCss('fadeIn');

  if(role == "seeker"){
    $(".info a.orange").css('opacity','1');
    $(".info a.green").css('opacity','0.5');
    $(".howto .maker").css('display','none');
    $(".howto .seeker").css('display','block');

  }else{
    $(".info a.orange").css('opacity','0.5');
    $(".info a.green").css('opacity','1');
    $(".howto .maker").css('display','block');
    $(".howto .seeker").css('display','none');

  }
});



</script>
@endsection
