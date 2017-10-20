@extends('layouts.app')
@section('content')
<main class="main cart-item">
    <script src="https://dhtmlx.com/docs/products/dhtmlxScheduler/codebase/dhtmlxscheduler.js?v=4.1" type="text/javascript"></script>
    <link rel="stylesheet" href="https://dhtmlx.com/docs/products/dhtmlxScheduler/codebase/dhtmlxscheduler.css?v=4.1" type="text/css">

    <style type="text/css" media="screen">
        html, body{
            margin:0px;
            padding:0px;
            height:100%;
            overflow:hidden;
        }   
    </style>

    <script>
      scheduler.init('scheduler_here', new Date(),"month");
    </script>

    <div id="scheduler_here" class="dhx_cal_container" style='width:100%; height:100%;'>
      <div class="dhx_cal_navline">
          <div class="dhx_cal_prev_button">&nbsp;</div>
          <div class="dhx_cal_next_button">&nbsp;</div>
          <div class="dhx_cal_today_button"></div>
          <div class="dhx_cal_date"></div>
          <div class="dhx_cal_tab" name="day_tab" style="right:204px;"></div>
          <div class="dhx_cal_tab" name="week_tab" style="right:140px;"></div>
          <div class="dhx_cal_tab" name="month_tab" style="right:76px;"></div>
      </div>
      <div class="dhx_cal_header"></div>
      <div class="dhx_cal_data"></div>       
  </div>
</main>
@endsection