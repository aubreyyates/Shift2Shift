<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Quicksand&display=swap" rel="stylesheet" />
<div class="section-1">


  <div class="section-1-overlay">
    <div style="height:50px;">

      <?php
          include "widgets/signup-error-alerts.php";
      ?>
      
  </div>

    <div style="height:30px;"></div>

    <!-- <div class="area warning_info">
      <h3>Important Read!!!</h3>
      <div class="divider black"></div>
      <p>
        This is only demo of Shift2Shift. All of your data may be deleted if you
        use this right now! It is also possible that there are still bugs on the
        site. You have been warned. Use the Chrome browser for the best
        experience. This is a work in progress and the the pages do not adjust
        to fit all screen sizes yet, such as mobile.
      </p>
    </div> -->

    <div style="height:10px;"></div>
    <h1 id="company-name">
      <img id="sign" src="images/shift2shift-sign.png" />
    </h1>
    <div style="height:70px;"></div>
    <div id="grid-1">
      <div class="image1"></div>
      <div class="image1-words">
        <p id="home-page-words">
          Shift2Shift is a simple online solution to keeping track of employee's clocked time at work. Keeping track of every employee,
          project, and event is easy and intuitive. You will gain valuable insight into how your employees work and use their
          time.
        </p>
      </div>
    </div>
    <div style="height:130px;"></div>
    <!-- <div class='box1'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut tellus risus, tristique ac pharetra ac, blandit sed nunc.
            Maecenas a vestibulum nisi, ut rutrum lacus. Maecenas efficitur erat in magna rutrum iaculis. Phasellus ut scelerisque
            erat. Cras suscipit tincidunt ipsum eget finibus. Maecenas sodales ipsum id diam venenatis rhoncus. Donec suscipit
            mi at orci venenatis, in varius arcu sollicitudin. Nullam id dolor eleifend, lobortis tellus ac, suscipit est.
            Etiam eu cursus quam. Nunc sit amet erat sed lectus ultricies gravida. Aenean efficitur suscipit dui vitae auctor.</div> -->
  </div>

  <div id="triangle-1"></div>
</div>
<div class="section-2">
  <div style="height:100px;"></div>
  <div style="float:right; margin-top:0px;margin-right:150px; width:200px;">
    <div class="clock">
      <div class="top"></div>
      <div class="right"></div>
      <div class="bottom"></div>
      <div class="left"></div>
      <div class="center"></div>
      <div class="shadow-2"></div>
      <div class="hour"></div>
      <div class="minute"></div>
      <div class="second"></div>
    </div>
  </div>
  <div id="image2-area">
    <div class="image2">
      <p id="home-page-words2">
        Try the Shift2Shift Demo!
      </p>
    </div>
  </div>
</div>
<div class="section-3">
  <div id="triangle-4"></div>

  <!-- <div id="demo-area">
    <h6 id="demo-words">You can start a demo by clicking this button.</h6>
    <form id="account_admin" action="includes/login.inc.php" method="POST">
      <button id="demo-button" type="submit">Start Demo!</button>
      <input value="demo@demo.com" type="text" name="uid" placeholder="Username/email" hidden />
      <input value="demotest" type="password" name="pwd" placeholder="Password" hidden />
    </form>
  </div> -->
</div>

<footer id="section-7">
  <div>
    <h6 class="fws-section">
      Coded by
      <a href="https://www.futurewebservice.com" style="color:#ffffff">Future Web</a>
      <a href="https://www.futurewebservice.com" style="color:#283b62">Service</a>
    </h6>
  </div>
</footer>

<div id='full-screen-demo-modal-container'>

  <div id='demo-modal' style='text-align:center'>
    <div class='fa fa-times' id='exit-demo-modal' class='close-demo-modal' style='height:20px;'></div>
    <div style='height:26px;'></div>
    <div>
      <p style='font-family:Overpass; font-size:40px;'>Important!</p>
    </div>
    <div style='height:12px;'></div>
    <div class='divider' style='background-color:rgb(233, 233, 233);'></div>
    <div style='height:18px;'></div>
    <div style='padding: 0px 40px 0px 40px'>
      <p id='words-demo-modal'>This is a demo of Shift2Shift. Any data that is entered will not be permanent. Anything that you save will be periodically cleaned out of the database. 
        <!-- You can either create your own account, or you can try some demo accounts by clicking
        the buttons below. -->
      </p>
    </div>
    <div style='width:80%;margin: 0 auto;'>

      <!-- <div style=''>
        <form id="account_admin" action="includes/login.inc.php" method="POST">
          <button id="demo-button-2" type="submit">Try Demo Admin!</button>
          <input value="demo@demo.com" type="text" name="uid" placeholder="Username/email" hidden />
          <input value="demotest" type="password" name="pwd" placeholder="Password" hidden />
        </form>
      </div>
      <div style=''>
        <form id="account_employee" action="includes/elogin.inc.php" method="POST">
          <button id="demo-button-2" type="submit">Try Demo Employee!</button>
          <input value="demoemployee@demo.com" type="text" name="uid" placeholder="Username/email" hidden />
          <input value="demotest" type="password" name="pwd" placeholder="Password" hidden />
        </form>
      </div> -->


    </div>

    <div style='height:15px;'></div>

    <div>
      <button id='ok-demo' class='close-demo-modal'>Got it!</button>
    </div>

    <div style='height:20px;'></div>

  </div>
</div>


<script>
  $(document).ready(function () {



    var width = screen.width;
    var check = localStorage.getItem("seen-modal");
    $("#triangle-1").css("border-left-width", width);
    $("#triangle-4").css("border-right-width", width);

    setTimeout(make_modal_appear, 5000)


    function make_modal_appear() {

      if (check != "true") {
        $("#full-screen-demo-modal-container").css("display", "block");
      }
      localStorage.setItem("seen-modal", "true");
    }

    // $("#full-screen-demo-modal-container").click(function () {
    //   $("#full-screen-demo-modal-container").css("display", "none");
    // });

    $("#ok-demo").click(function () {
      $("#full-screen-demo-modal-container").css("display", "none");
    });
    $("#exit-demo-modal").click(function () {
      $("#full-screen-demo-modal-container").css("display", "none");
    });

    
  });
</script>