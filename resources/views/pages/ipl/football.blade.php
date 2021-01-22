@extends('layouts.master')





@section('title')
  <title>Football Match Prediction</title>
@endsection


@section('body')
  <section class="content-header">
      <h1>
        Football
        <small>Match Prediction</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="/cost">Football</a></li>
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
                  <label for="description" class="col-sm-3 control-label">Winner</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="match" autocomplete="off">
                  </div>
                </div>

                <div class="form-group" id="amount_group">
                  <label for="amount" class="col-sm-3 control-label">Total Score</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="totalScore" autocomplete="off">
                    <span class="invalid-feedback"></span>
                  </div>
                </div>

                <div class="form-group" id="amount_group">
                  <label for="amount" class="col-sm-3 control-label">Team 1 Score</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="team1Score" autocomplete="off">
                    <span class="invalid-feedback"></span>
                  </div>
                </div>

                <div class="form-group" id="amount_group">
                  <label for="amount" class="col-sm-3 control-label">Team 2 Score</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="team2Score" autocomplete="off">
                    <span class="invalid-feedback"></span>
                  </div>
                </div>

                </form>
              </div>

          </div>

        <pre id="console"></pre>
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
          tie : 'Tie',
      };
      /*let score = {
          total : {
              1,2,3,4,5,6,7,8,9,10
          },
          team1score : {
              1,2,3,4,5,6,7,8,9,10
          },
          team2score : {
              1,2,3,4,5,6,7,8,9,10
          }
      }*/
      let itrations = 100000;
      let prediction = {
          itration : 0,
          winner : [],
          totalScore : [],
          team1score : [],
          team2score : []
      }
      
     $('#teamform').submit(function(e){
         e.preventDefault();
         teams.one = $('#team1').val();
         teams.two= $('#team2').val();
         for(let i = 0; i < itrations; i++){
             prediction.itration++;
             runMatchPrediction();
             //runScorePrediction();
             //runTeam1ScorePrediction();
             //runTeam2ScorePrediction();
         }
         
         calculatePrediction();
     });
     function randomTeam(){
         var keys = Object.keys(teams);
         var randomKey = keys[Math.floor(Math.random()*keys.length)];
         var value = teams[randomKey];
         return value;
     }
     
     function randomScore(item){
         var keys = Object.keys(item);
         var randomKey = keys[Math.floor(Math.random()*keys.length)];
         var value = item[randomKey];
         return value;
     }
     
     function runScorePrediction(){
         prediction.totalScore.push(randomTeam(score.total));
     }
     
     function runTeam1ScorePrediction(){
         prediction.team1score.push(randomTeam(score.team1score));
     }
     
     function runTeam2ScorePrediction(){
         prediction.team2score.push(randomTeam(score.team2score));
     }
      
     function runMatchPrediction(){
         prediction.winner.push(randomTeam());
     }
     
     function calculatePrediction(){
         let Team1 = 0;
         let Team2 = 0;
         let tie = 0;
         let totalScore = 0;
         let team1score = 0;
         let team2score = 0;
         
         for(let i = 0; i < prediction.winner.length; i++){
            if(prediction.winner[i] == teams.one){
                Team1++;
            } 
            if(prediction.winner[i] == teams.two){
                Team2++;
            } 
            if(prediction.winner[i] == teams.tie){
                tie++;
            } 
            
            /*if(prediction.totalScore[i] == teams.two){
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
            } */
         }
         
         if(Team1 > Team2 && Team1 > tie){
             $('#match').val(teams.one + ' ' + Team1 + '/' + prediction.itration);
         } else if(Team1 < Team2 && tie < Team2){
             $('#match').val(teams.two + ' ' + Team2 + '/' + prediction.itration);
         } else if(tie > Team1 && tie > Team2){
             $('#match').val(teams.tie + ' ' + tie + '/' + prediction.itration);
         }
     }
      
    });
  </script>

@endsection