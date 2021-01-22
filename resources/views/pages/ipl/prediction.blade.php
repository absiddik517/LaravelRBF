@extends('layouts.master')



@section('title')
  <title>IPL Match Prediction</title>
@endsection


@section('body')
  <section class="content-header">
      <h1>
        IPL 2020
        <small>Match Prediction</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="/cost">IPL</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        

      <div class="row">

        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="box box-solid" style="">
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Teams</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>

            <div class="box-body border-radius-none">
              <form class="form-horizontal" id="teamform">
                <div class="form-group" id="refGroup">
                  <label for="ref" class="col-sm-3 control-label">Team 1</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="team1" autocomplete="off" placeholder="Team 1">
                    <span class="help-block" id="refMsg" style="transition: 0.5s;"></span>
                  </div>
                </div>
                
                <div class="form-group" id="refGroup">
                  <label for="ref" class="col-sm-3 control-label">Team 2</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="team2" autocomplete="off" placeholder="Team 2">
                    <span class="help-block" id="refMsg" style="transition: 0.5s;"></span>
                  </div>
                </div>


              
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right" id="nextStep">Next Step</button>
              </div>
              </form>
              <!-- /.box-footer -->
          </div>


          <div class="box box-solid" style="position: relative;">
            <div class="overlay" id="p_overlay"><img src="images/spinner.gif"></div>
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Winner</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>

            <div class="box-body border-radius-none" id="deleveryProductBody">
              <form class="form-horizontal" id="dueForm">
              
                <div class="form-group">
                  <label for="description" class="col-sm-3 control-label">Toss Winner</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="toss" autocomplete="off">
                  </div>
                </div>

                <div class="form-group" id="amount_group">
                  <label for="amount" class="col-sm-3 control-label">Match Winner</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="match" autocomplete="off">
                    <span class="invalid-feedback"></span>
                  </div>
                </div>

                <div class="form-group" id="amount_group">
                  <label for="amount" class="col-sm-3 control-label">Match Winner</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="conditional" autocomplete="off">
                    <span class="invalid-feedback"></span>
                  </div>
                </div>

                </form>
              </div>

          </div>

        </section>
        <!-- /.Left col -->
       </div>
    </section>    

@endsection


    
@section('script')
  <script>
    $(document).ready(function() {
      let teams = {
          one : undefined,
          two : undefined,
          bat : 'Bat First',
          ball : 'Ball First',
      };
      let itrations = 100000;
      let prediction = {
          itration : 0,
          toss : [],
          match : []
      }
      
     $('#teamform').submit(function(e){
         e.preventDefault();
         teams.one = $('#team1').val();
         teams.two= $('#team2').val();
         for(let i = 0; i < itrations; i++){
             prediction.itration++;
             runTossPrediction();
             runMatchPrediction();
         }
         
         calculatePrediction();
     });
     function randomTeam(){
         var keys = Object.keys(teams);
         var randomKey = keys[Math.floor(Math.random()*keys.length)];
         var value = teams[randomKey];
         return value;
     }
     function runTossPrediction(){
         prediction.toss.push(randomTeam());
     }
      
     function runMatchPrediction(){
         prediction.match.push(randomTeam());
     }
     
     function calculatePrediction(){
         tossTeam1 = 0;
         tossTeam2 = 0;
         matchTeam1 = 0;
         matchTeam2 = 0;
         batFirst = 0;
         ballFirst = 0;
         
         for(let i = 0; i < prediction.toss.length; i++){
            if(prediction.toss[i] == teams.one){
                tossTeam1++;
            } 
            if(prediction.toss[i] == teams.two){
                tossTeam2++;
            } 
            if(prediction.match[i] == teams.two){
                matchTeam2++;
            } 
            if(prediction.match[i] == teams.one){
                matchTeam1++;
            } 
            if(prediction.match[i] == teams.bat){
                batFirst++;
            } 
            if(prediction.match[i] == teams.ball){
                ballFirst++;
            } 
         }
         
         if(tossTeam1 > tossTeam2){
             $('#toss').val(teams.one + ' ' + tossTeam1 + '/' + prediction.itration);
         } else if(tossTeam1 < tossTeam2){
             $('#toss').val(teams.two + ' ' + tossTeam2 + '/' + prediction.itration);
         }
         
         
         if(matchTeam1 > matchTeam2){
             $('#match').val(teams.one + ' ' + matchTeam1 + '/' + prediction.itration);
         } else if(matchTeam1 < matchTeam2){
             $('#match').val(teams.two + ' ' + matchTeam2 + '/' + prediction.itration);
         }
         
         if(batFirst > ballFirst){
             $('#conditional').val(teams.bat + ' ' + matchTeam1 + '/' + prediction.itration);
         } else if(ballFirst < ballFirst){
             $('#conditional').val(teams.ball + ' ' + matchTeam2 + '/' + prediction.itration);
         }
     }
      
    });
  </script>

@endsection