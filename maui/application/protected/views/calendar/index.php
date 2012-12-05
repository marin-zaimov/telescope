
<style>
  #selectInt {
    width: 300px;
    color: #00FF00;
  }
  #randomDiv {
    width: 500px;
    height: 200px;
    background-color: #000;
    
  }



  #moon-filter {
    font-weight: bolder;
    background-color: <?php echo $colors['Moon'] ?>;
    background-image: -webkit-gradient(linear,0 0,0 100%,from( white),to( <?php echo $colors['Moon'] ?>));
    background-image: -webkit-linear-gradient(top, white, <?php echo $colors['Moon'] ?>);
    background-image: -o-linear-gradient(top, white, <?php echo $colors['Moon'] ?>);
    background-image: linear-gradient(to bottom, white, <?php echo $colors['Moon'] ?>);
    background-image: -moz-linear-gradient(top, white, <?php echo $colors['Moon'] ?>);


  }
  #jupiter-filter {
    font-weight: bolder;
    background-color: <?php echo $colors['Jupiter'] ?>;
    background-image: -webkit-gradient(linear,0 0,0 100%,from( white),to( <?php echo $colors['Jupiter'] ?>));
    background-image: -webkit-linear-gradient(top, white, <?php echo $colors['Jupiter'] ?>);
    background-image: -o-linear-gradient(top, white, <?php echo $colors['Jupiter'] ?>);
    background-image: linear-gradient(to bottom, white, <?php echo $colors['Jupiter'] ?>);
    background-image: -moz-linear-gradient(top, white, <?php echo $colors['Jupiter'] ?>);


  }
  #saturn-filter {
    font-weight: bolder;
    background-color: <?php echo $colors['Saturn'] ?>;
    background-image: -webkit-gradient(linear,0 0,0 100%,from( white),to( <?php echo $colors['Saturn'] ?>));
    background-image: -webkit-linear-gradient(top, white, <?php echo $colors['Saturn'] ?>);
    background-image: -o-linear-gradient(top, white, <?php echo $colors['Saturn'] ?>);
    background-image: linear-gradient(to bottom, white, <?php echo $colors['Saturn'] ?>);
    background-image: -moz-linear-gradient(top, white, <?php echo $colors['Saturn'] ?>);


  }
  #m13-filter, #m15-filter, #m31-filter, #m42-filter, #m57-filter, #m81-filter {
    font-weight: bolder;
    background-color: #FFFFCA;
    background-image: -webkit-gradient(linear,0 0,0 100%,from( white),to( #FFFFCA));
    background-image: -webkit-linear-gradient(top, white, #FFFFCA);
    background-image: -o-linear-gradient(top, white, #FFFFCA);
    background-image: linear-gradient(to bottom, white, #FFFFCA);
    background-image: -moz-linear-gradient(top, white, #FFFFCA);
  }



</style>

<h3 class="page-header">Calendar</h1>
<p>Select a day to see the available reservations</h1>


<div class="highlight-filters">


  <div class="accordion" id="accordion2">

    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse1">
        Add Highlight Filters
      </a>
    </div>
    <div id="collapse1" class="accordion-body collapse"> <!-- add "in" to class to open at load -->
      <div class="accordion-inner">


        <div class="highlight-btns">
          <div class="btn-group" data-toggle="buttons-checkbox">
            <button type="button" class="btn" id="moon-filter">Moon</button>
            <button type="button" class="btn" id="jupiter-filter">Jupiter</button>
            <button type="button" class="btn" id="saturn-filter">Saturn</button>
            <button type="button" class="btn" id="m13-filter">M13</button>
            <button type="button" class="btn" id="m15-filter">M15</button>
            <button type="button" class="btn" id="m31-filter">M31</button>
            <button type="button" class="btn" id="m42-filter">M42</button>
            <button type="button" class="btn" id="m57-filter">M57</button>
            <button type="button" class="btn" id="m81-filter">M81</button>
          </div>
        </div>



      </div>
    </div>


  </div>


</div>



<div id="calendar"></div>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/calendarManager.js"></script>

